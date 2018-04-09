<?php

namespace App\Http\Controllers\Shops;

use App\Events\Items\Created;
use App\Events\Items\Updated;
use App\Events\Items\Deleted;
use App\Models\Shops\Store;
use App\Models\Shops\Items\Item;
use App\Models\Shops\Items\Category;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     *
     * @param  \App\Http\Requests\ItemRequest  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request, Store $store)
    {
        if (!auth()->user()->can('sell item')) {
            return redirect()->back();
        }

        $item = $store->items()->create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        event(new Created($item));

        alert()->success('Item has been added!');

        return redirect()->route('store.show', $request->store);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @param  \App\Item\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store, Item $item)
    {
        $categories = Category::all();

        return view('item.show', compact('item', 'categories'));
    }

    /**
     *
     * @param  \App\Http\Requests\ItemRequest  $request
     * @param  \App\Store  $store
     * @param  \App\Item\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, Store $store, Item $item)
    {
        if (!auth()->user()->can('edit item')) {
            return redirect()->back();
        }

        $item->update([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description
        ]);

        event(new Updated($item));

        alert()->success('item has been updated!');

        return redirect()->route('item.show', [$store, $item]);
    }

    /**
     *
     * @param  \App\Store  $store
     * @param  \App\Item\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store, Item $item)
    {
        if (!auth()->user()->can('delete item')) {
            return redirect()->back();
        }

        $item->delete();

        event(new Deleted($item));

        alert()->success('item has been deleted!');

        return redirect()->route('store.show', $store);
    }
}
