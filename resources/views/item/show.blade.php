@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header bg-primary text-white mb-3">
                    {{-- image & name --}}
                    <img class="rounded" src="{{ asset( $item->getImage()) }}" alt="avatar" height="64px" width="64px" style="object-fit: cover; background-color: #ddd">
                    <h4 class="d-inline" style="margin-left: 8px">{{ $item->name }}</h4>

                    {{-- option button --}}
                    <div class="float-right">
                        @if (Auth::user()->id == $item->store->user->id)
                            {{-- edit item --}}
                            <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#editForm">Edit</button>

                            <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title">Edit item</h5>
                                            <button type="button" class="close" style="color: white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form role="form" method="POST" class="text-dark" action="{{ route('item.update', [$item->store, $item]) }}" enctype="multipart/form-data">
                                                {!! csrf_field() !!}
                                                {{ method_field('PATCH') }}
                                                <div class="form-group">
                                                    <label>Item Name :</label>
                                                    <input
                                                        type="text"
                                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                        name="name"
                                                        value="{{ $item->name }}"
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
                                                                <input
                                                                    class="form-check-input"
                                                                    name="categoriesId[]"
                                                                    type="checkbox"
                                                                    value="{{ $category->id }}"
                                                                    @foreach ($item->categories as $itemCategory)
                                                                        @if ($itemCategory->id == $category->id)
                                                                            checked
                                                                        @endif
                                                                    @endforeach
                                                                >
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
                                                        value="{{ $item->price }}"
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
                                                        value="{{ $item->stock }}"
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
                                                    <label>Image :</label><br>
                                                    @foreach ($item->images()->get() as $image)
                                                        <img class="rounded" src="{{ asset('images/' . $image->path) }}" alt="images[]" height="64" style="object-fit: cover; background-color: #ddd">
                                                    @endforeach
                                                    <input type="file" class="form-control-file" name="images[]" multiple>
                                                    @if ($errors->has('images.*'))
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <strong class="text-danger"><li>{{ $error }}</li></strong>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- delete item --}}
                            <form action="{{ route('item.destroy', [$item->store, $item]) }}" class="d-inline" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger" name="delete">Delete</button>
                            </form>

                        @else
                            {{-- add to cart for other user --}}
                            <form action="{{ route('cart.store', $item) }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-sm btn-light" name="cart"><i class="ion-ios-cart ion-sm"></i> Cart</button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Id :</th>
                                <td>{{ $item->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Category :</th>
                                <td>
                                    @foreach ($item->categories as $category)
                                        <button class="btn btn-sm btn-secondary" disabled>{{ $category->name }}</button>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Price :</th>
                                <td>Rp {{ number_format($item->price) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Stock :</th>
                                <td>{{ $item->stock }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Sold by :</th>
                                <td><a href="{{ route('store.show', $item->store) }}">{{ $item->store->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Images :</th>
                                <td>
                                    @foreach ($item->images()->get() as $image)
                                        <img src="{{ asset('images/' . $image->path) }}" alt="image" height="100" style="object-fit: cover; background-color: #ddd">
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
