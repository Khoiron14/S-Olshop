<?php

namespace App\Http\Controllers;

use Storage;
use App\Store;
use App\Item\Item;
use App\Item\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Store $store)
    {
        if (!$request->user()->hasPermissionTo('post item')) {
            return redirect()->back();
        }

        $this->validate(request(), [
            'name' => 'required|string|max:40',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'required',
        ]);

        $item = Item::create([
            'store_id' => $store->id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->file('image')->store('items'),
        ]);

        foreach (request('categoryId') as $categoryId) {
            $category = Category::find($categoryId);
            $item->categories()->attach($category);
        }

        return redirect()->route('store.show', $request->store)->withSuccess('Item has been added!');
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @param  \App\Item\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store, Item $item)
    {
        if (!$request->user()->can('edit item')) {
            return redirect()->back();
        }

        $this->validate(request(), [
            'name' => 'required|string|max:40',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        if ($request->file('image')) {
            if ($item->image) {
                Storage::delete($item->image);
            }

            $item->update([
                'image' => $request->file('image')->store('items'),
            ]);
        }

        $item->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        $item->categories()->sync(request('categoryId'));

        return redirect()->route('item.show', [$store, $item])->withInfo('Item has been updated!');
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
        if (!request()->user()->can('delete item')) {
            return redirect()->back();
        }

        $item->delete();

        return redirect()->route('store.show', $store)->withDanger('Item has been deleted!');
    }
}
