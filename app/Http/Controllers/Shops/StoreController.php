<?php

namespace App\Http\Controllers\Shops;

use Storage;
use App\Events\Stores\Created;
use App\Events\Stores\Updated;
use App\Events\Stores\Deleted;
use App\Models\Users\User;
use App\Models\Shops\Store;
use App\Models\Shops\Items\Item;
use App\Models\Shops\Items\Category;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;

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
        event(new Created($store));

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
        event(new Updated($store));

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

        $store->delete();
        event(new Deleted($store));

        alert()->success('Store has been deleted!');

        return redirect()->route('admin.index');
    }
}
