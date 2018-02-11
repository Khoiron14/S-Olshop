@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 offset-1">
            <div class="card ">
                <div class="card-header bg-primary text-white mb-3">

                    {{-- image & name --}}
                    <img class="rounded" src="{{ $store->getAvatar() }}" alt="avatar" height="64px" width="64px" style="object-fit: cover; background-color: #ddd">
                    <h4 class="d-inline" style="margin-left: 8px">{{ $store->name }}</h4>

                    {{-- option button --}}
                    @if (Auth::user()->id == $store->user->id)
                        <div class="float-right">
                            <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#addItem">Add Item</button>

                            {{-- modal form for add item --}}
                            <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title">Add item</h5>
                                            <button type="button" class="close" style="color: white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form role="form" method="POST" class="text-dark" action="{{ route('item.store', $store) }}" enctype="multipart/form-data">
                                                {!! csrf_field() !!}
                                                <div class="form-group">
                                                    <label>Item Name :</label>
                                                    <input
                                                        type="text"
                                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                        name="name"
                                                        value="{{ old('name') }}"
                                                        placeholder="input item name."
                                                        required
                                                    >
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Category :</label>
                                                    @foreach ($categories as $category)
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" name="categoryId[]" type="checkbox" value="{{ $category->id }}">
                                                                {{ $category->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="form-group">
                                                    <label>Price :</label>
                                                    <input
                                                        type="text"
                                                        class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                                        name="price"
                                                        value="{{ old('price') }}"
                                                        aria-describedby="priceHelp"
                                                        placeholder="price for this item."
                                                        required
                                                    >
                                                    @if ($errors->has('price'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('price') }}</strong>
                                                        </div>
                                                    @endif
                                                    <small class="form-text text-muted">Input only numbers.</small>
                                                </div>

                                                <div class="form-group">
                                                    <label>Stock :</label>
                                                    <input
                                                        type="text"
                                                        class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}"
                                                        name="stock"
                                                        value="{{ old('stock') }}"
                                                        aria-describedby="stockHelp"
                                                        placeholder="total amount of this item."
                                                        required
                                                    >
                                                    @if ($errors->has('stock'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('stock') }}</strong>
                                                        </div>
                                                    @endif
                                                    <small class="form-text text-muted">Input only numbers.</small>
                                                </div>

                                                <div class="form-group">
                                                    <label>Image :</label>
                                                    <input type="file" class="form-control-file" name="image" required>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- store description --}}
                <div class="card-body">
                    <label>Description :</label>
                    <p>{{ $store->description }}</p>
                </div>

                @if ($items->count() == null)
                    <hr>
                    <p class="text-center">There are no items in this store.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td><a href="{{ route('item.show',  [$store, $item]) }}">{{ $item->name }}</a></td>
                                    <td>
                                        @foreach ($item->categories as $category)
                                            <button class="btn btn-sm btn-secondary" disabled>{{ $category->name }}</button>
                                        @endforeach
                                    </td>
                                    <td>Rp {{ number_format($item->price) }}</td>
                                    <td>{{ $item->stock }}</td>
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
