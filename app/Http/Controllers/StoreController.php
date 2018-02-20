<?php

namespace App\Http\Controllers;

use Storage;
use App\User;
use App\Store;
use App\Item\Item;
use App\Item\Category;
use App\Http\Requests\StoreRequest;

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
    public function create()
    {
        if (!(auth()->user()->hasRole('user'))) {
            return redirect('/');
        } elseif (auth()->user()->hasrole('seller')) {
            return redirect()->route('store.show', auth()->user()->store);
        }

        return view('store.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if (!(auth()->user()->hasRole('user'))) {
            return redirect('/');
        }

        $store = auth()->user()->store()->create($request->all());
        $image = $request->file('image')->store('avatars/stores');
        $store->image()->create(['path' => $image]);
        auth()->user()->assignRole('seller');

        alert()->success('You successfully registered store!');

        return redirect()->route('store.show', $store);
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
     * @param  \App\Http\Requests\StoreRequest  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Store $store)
    {
        $store->update($request->all());

        if ($request->file('image')) {
            Storage::delete($store->image()->first()->path);
            $image = $request->file('image')->store('avatars/stores');
            $store->image()->update(['path' => $image]);
        }

        alert()->success('Store has been updated!');

        return redirect()->route('store.show', $store);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        if (!auth()->user()->hasPermissionTo('delete seller')) {
            return redirect()->back();
        }

        $store->user->removeRole('seller');
        Storage::delete($store->image()->first()->path);
        $store->image()->delete();
        $store->delete();

        alert()->success('Store has been deleted!');

        return redirect()->route('admin.index');
    }
}
