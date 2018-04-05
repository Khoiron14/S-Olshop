<?php

namespace App\Http\Controllers\Shops;

use App\Events\Items\Purchased;
use App\Models\Shops\Store;
use App\Models\Process\Status;
use App\Models\Shops\Items\Item;
use App\Models\Process\Purchase;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.hasAddress')->only('store');
    }

    public function store(Item $item)
    {
        if (!auth()->user()->can('purchase item')) {
            return redirect()->back();
        }

        if (!$item->isEnough(request()->quantity)) {
            alert()->warning('not enough stock');

            return redirect()->back();
        }

        $purchase = auth()->user()->purchases()->create([
            'item_id' => $item->id,
            'quantity' => request()->quantity,
            'price' => $item->price * request()->quantity,
            'status_id' => Status::SYSTEM_PENDING,
        ]);

        event(new Purchased($purchase));

        return redirect()->back();
    }

    public function show()
    {
        $purchases = auth()->user()->purchases()->latest()->get();

        return view('user.purchase', compact('purchases'));
    }

    public function confirm(Purchase $purchase)
    {
        if (!auth()->user()->can('confirm purchase')) {
            return redirect()->back();
        }

        $purchase->update(['status_id' => Status::SELLER_CONFIRM]);

        return redirect()->back();
    }

    public function cancel(Purchase $purchase)
    {
        if (!auth()->user()->can('cancel purchase')) {
            return redirect()->back();
        }

        if (auth()->user()->hasRole('seller')) {
            $status = Status::SELLER_CANCEL;
        } elseif (auth()->user()->hasRole('user')) {
            $status = Status::USER_CANCEL;
        } else {
            $status = Status::SYSTEM_CANCEL;
        }

        $purchase->update(['status_id' => $status]);

        return redirect()->back();
    }
}
