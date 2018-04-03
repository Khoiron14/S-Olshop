@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 offset-1">
                @if ($purchases->count() == null)
                    <hr>
                    <p class="text-center">No items in here...</p>
                @else

                    {{-- item list in purchases --}}
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <th scope="row">{{ $purchase->id }}</th>
                                    <td>
                                        <a href="{{ route('item.show',  [$purchase->item->store, $purchase->item]) }}">
                                            {{ $purchase->item->name }}
                                        </a>
                                    </td>
                                    <td>Rp {{ number_format($purchase->quantity * $purchase->item->price) }}</td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td class="{{ $purchase->status->getColor() }}">{{ $purchase->status->name }}</td>
                                    <td>
                                        @if ($purchase->status->isType('pending'))
                                            <form action="{{ route('purchase.confirm', $purchase) }}" class="d-inline" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <button type="submit" class="btn btn-sm btn-success" name="confirm">Confirm</button>
                                            </form>

                                            <form action="{{ route('purchase.cancel', $purchase) }}" class="d-inline" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <button type="submit" class="btn btn-sm btn-danger" name="delete">Cancel</button>
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
