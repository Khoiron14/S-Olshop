<?php

namespace App\Http\Controllers\Shops;

use App\Events\Items\Purchased;
use App\Models\Shops\Store;
use App\Models\Process\Status;
use App\Models\Shops\Items\Item;
use App\Models\Process\Purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Item $item)
    {
        if ($item->stock < $request->quantity) {
            alert()->warning('not enough stock');

            return redirect()->back();
        }

        $purchase = auth()->user()->purchases()->create([
            'item_id' => $item->id,
            'quantity' => $request->quantity,
            'price' => $item->price * $request->quantity,
            'status_id' => Status::PENDING
        ]);

        event(new Purchased($purchase));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
