@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 offset-1">
                @if ($carts->count() == null)
                    <hr>
                    <p class="text-center">No items in the cart yet.</p>
                @else

                    {{-- item list in cart --}}
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td>
                                        <a href="{{ route('item.show',  [$cart->item->store, $cart->item]) }}">
                                            {{ $cart->item->name }}
                                        </a>
                                    </td>
                                    <td>Rp {{ number_format($cart->quantity * $cart->item->price) }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td>
                                        <form action="{{ route('cart.store', $cart->item) }}" class="d-inline" method="post">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-light">+</button>
                                        </form>

                                        <form action="{{ route('cart.destroy', $cart->item) }}" class="d-inline" method="post">
                                            {{ csrf_field() }}
                                            @if ($cart->quantity == 1)
                                                <button type="submit" class="btn btn-light" name="delete">-</button>
                                            @else
                                                <button type="submit" class="btn btn-light">-</button>
                                            @endif
                                        </form>

                                        @if (auth()->user()->hasAddress())
                                        <button type="button" class="btn btn-light" data-toggle="modal" data-target="#selectAddress">
                                            Purchase
                                        </button>

                                        <div
                                            class="modal fade"
                                            id="selectAddress"
                                            tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">Select Address</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form
                                                        action="{{ route('purchase.store', $cart->item) }}"
                                                        class="d-inline"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
                                                            @foreach (auth()->user()->addresses as $address)
                                                            <div class="form-check">
                                                                <input
                                                                    class="form-check-input"
                                                                    type="radio"
                                                                    name="address"
                                                                    value="{{ $address->id }}">
                                                                    <div class="card border-primary form-check-label col-md-4 mb-3">
                                                                        <div class="card-header bg-transparent">{{ $address->receiver }}</div>
                                                                        <div class="card-body text-primary">
                                                                            <p class="card-text">{{ $address->phone }}</p>
                                                                            <p class="card-text">{{ $address->location }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Purchase</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <form action="{{ route('purchase.store', $cart->item) }}" class="d-inline" method="post">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-light">Purchase</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
