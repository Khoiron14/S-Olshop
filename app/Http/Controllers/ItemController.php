<?php

namespace App\Http\Controllers;

use Storage;
use App\Store;
use App\Item\Item;
use App\Item\Category;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ItemRequest  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request, Store $store)
    {
        if (!auth()->user()->hasPermissionTo('post item')) {
            return redirect()->back();
        }

        $item = $store->items()->create($request->all());

        foreach ($request->file('images') as $image) {
            $item->images()->create(['path' => $image->store('items')]);
        }

        $item->categories()->sync(request('categoriesId'));

        alert()->success('Item has been added!');

        return redirect()->route('store.show', $request->store);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item\Item  $item
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store, Item $item)
    {
        $categories = Category::all();

        return view('item.show', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
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

        if ($request->file('images')) {
            foreach ($item->images()->get() as $image) {
                Storage::delete($image->path);
            }

            $item->images()->delete();

            foreach ($request->file('images') as $image) {
                $item->images()->create(['path' => $image->store('items')]);
            }
        }

        $item->update($request->all());
        $item->categories()->sync(request('categoryId'));

        alert()->success('item has been updated!');

        return redirect()->route('item.show', [$store, $item]);
    }

    /**
     * Remove the specified resource from storage.
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

        foreach ($item->images()->get() as $image) {
            Storage::delete($image->path);
        }

        $item->images()->delete();
        $item->delete();

        alert()->success('item has been deleted!');

        return redirect()->route('store.show', $store);
    }
}
