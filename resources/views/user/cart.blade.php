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
                                <th scope="col">id</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <th scope="row">{{ $cart->item->id }}</th>
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
                                            <button type="submit" class="btn btn-light" name="cart">+</button>
                                        </form>
                                        <form action="{{ route('cart.destroy', $cart->item) }}" class="d-inline" method="post">
                                            {{ csrf_field() }}
                                            @if ($cart->quantity == 1)
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-light" name="cart">-</button>
                                            @else
                                                <button type="submit" class="btn btn-light" name="cart">-</button>
                                            @endif
                                        </form>
                                        <a href="#" class="btn btn-light">Buy</a>
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
