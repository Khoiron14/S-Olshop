<?php

namespace App\Http\Controllers\Shops;

use App\Events\Items\Purchased;
use App\Models\Shops\Store;
use App\Models\Process\Status;
use App\Models\Process\StatusBy;
use App\Models\Shops\Items\Item;
use App\Models\Process\Purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            'status_id' => Status::PENDING,
            'status_by_id' => StatusBy::SYSTEM
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
    public function show()
    {
        $purchases = auth()->user()->purchases()->get()->sortByDesc('created_at');

        return view('user.purchase', compact('purchases'));
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

    public function confirm(Purchase $purchase)
    {
        if (!auth()->user()->hasRole('seller')) {
            return redirect()->back();
        }

        $purchase->update([
            'status_id' => Status::CONFIRMED,
            'status_by_id' => StatusBy::SELLER
        ]);

        return redirect()->back();
    }

    public function cancel(Purchase $purchase)
    {
        if (auth()->user()->hasRole('seller')) {
            $statusBy = StatusBy::SELLER;
        } elseif (auth()->user()->hasRole('user')) {
            $statusBy = StatusBy::USER;
        } else {
            $statusBy = StatusBy::SYSTEM;
        }

        $purchase->update([
            'status_id' => Status::CANCELLED,
            'status_by_id' => $statusBy
        ]);

        return redirect()->back();
    }
}
