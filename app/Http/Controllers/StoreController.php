<?php

namespace App\Http\Controllers;

use Storage;
use App\User;
use App\Store;
use App\Item\Item;
use App\Item\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Store\UploadStore;
use App\Http\Requests\Store\UpdateStore;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!($request->user()->hasRole('user'))) {
            return redirect('/');
        } elseif ($request->user()->hasrole('seller')) {
            return redirect()->route('store.show', $request->user()->store);
        }

        return view('store.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadStore $request)
    {
        if (!($request->user()->hasRole('user'))) {
            return redirect('/');
        }

        $store = Store::create([
            'name' => $request->name,
            'domain' => $request->domain,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);

        $image = $request->file('image')->store('avatars/stores');
        $store->image()->create(['path' => $image]);
        $request->user()->assignRole('seller');

        return redirect()->route('store.show', $store)->withSuccess('You successfully registered store!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $items = $store->items()->get();
        $categories = Category::all();

        return view('store.index', compact('store', 'items', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStore $request, Store $store)
    {
        if ($request->file('image')) {
            if ($store->image()) {
                Storage::delete($store->image()->first()->path);
            }

            $image = $request->file('image')->store('avatars/stores');
            $store->image()->update(['path' => $image]);
        }

        $store->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('store.show', $store)->withInfo('Store has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        if (!request()->user()->hasPermissionTo('delete seller')) {
            return redirect()->back();
        }

        $store->user->removeRole('seller');
        Storage::delete($store->image()->first()->path);
        $store->image()->delete();
        $store->delete();

        return redirect()->route('admin.index')->withDanger('Store has been deleted!');
    }
}
