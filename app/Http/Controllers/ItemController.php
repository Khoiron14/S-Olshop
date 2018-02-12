<?php

namespace App\Http\Controllers;

use Storage;
use App\Store;
use App\Item\Item;
use App\Item\Image;
use App\Item\Category;
use Illuminate\Http\Request;
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function store(UploadItem $request, Store $store)
    {
        if (!$request->user()->hasPermissionTo('post item')) {
            return redirect()->back();
        }

        $item = Item::create([
            'store_id' => $store->id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        foreach ($request->file('images') as $image) {
            Image::create([
                'item_id' => $item->id,
                'name' => $image->store('items')
            ]);
        }

        $item->categories()->sync(request('categoriesId'));

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
    public function update(ItemRequest $request, Store $store, Item $item)
    {
        if (!$request->user()->can('edit item')) {
            return redirect()->back();
        }

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
