<?php

namespace App\Http\Controllers\Shops;

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
        $this->middleware('store.owner')->only('edit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!(auth()->user()->hasRole('user'))) {
            return redirect()->back();
        } elseif (auth()->user()->hasRole('seller')) {
            return redirect()->route('store.show', auth()->user()->store);
        }

        return view('store.register');
    }

    /**
     *
     * @param  \App\Http\Requests\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if (!(auth()->user()->hasRole('user'))) {
            return redirect()->back();
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
     * Show the form for editing the specified resource.
     *
     * @param  Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        return view('store.edit', compact('store'));
    }

    /**
     *
     * @param  \App\Http\Requests\StoreRequest  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Store $store)
    {
        if (!auth()->user()->hasRole('seller')) {
            return redirect()->back();
        }

        $store->update($request->all());
        event(new Updated($store));

        alert()->success('Store has been updated!');

        return redirect()->route('store.show', $store);
    }

    /**
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        if (!auth()->user()->can('delete seller')) {
            return redirect()->back();
        }

        $store->delete();
        event(new Deleted($store));

        alert()->success('Store has been deleted!');

        return redirect()->route('admin.index');
    }

    public function showPurchase(Store $store)
    {
        if (!auth()->user()->hasRole('seller')) {
            return redirect()->back();
        }

        $purchases = $store->purchases()->latest()->get();

        return view('store.purchase', compact('purchases'));
    }
}
