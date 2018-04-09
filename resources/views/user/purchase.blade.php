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
                                <th scope="col">Receiver</th>
                                <th scope="col">Item</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td>
                                        <button class="btn btn-light" data-toggle="modal" data-target="#receiver">{{ $purchase->address->receiver }}</button>

                                        <div class="modal fade" id="receiver" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Receiver</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <b>Name :</b>
                                                <p>{{ $purchase->address->receiver }}</p>
                                                <b>Phone :</b>
                                                <p>{{ $purchase->address->phone }}</p>
                                                <b>Location :</b>
                                                <p>{{ $purchase->address->location }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('item.show',  [$purchase->item->store, $purchase->item]) }}">
                                            <img class="rounded mr-1" src="{{ asset( $purchase->item->getImage()) }}" alt="avatar" height="32px" width="32px" style="object-fit: cover; background-color: #ddd">
                                            {{ $purchase->item->name }}
                                        </a>
                                    </td>
                                    <td>Rp {{ number_format($purchase->quantity * $purchase->item->price) }}</td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td class="{{ $purchase->status->getColor() }}">{{ $purchase->status->name }}</td>
                                    <td>
                                        @if ($purchase->status->isType('pending'))
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
