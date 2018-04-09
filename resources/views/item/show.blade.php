@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 offset-1">

            {{-- Item --}}
            <div class="card">
                <div class="card-header bg-primary text-white">
                    {{-- image & name --}}
                    <img class="rounded" src="{{ asset( $item->getImage()) }}" alt="avatar" height="64px" width="64px" style="object-fit: cover; background-color: #ddd">
                    <h4 class="d-inline ml-2">{{ $item->name }}</h4>

                    {{-- option button --}}
                    <div class="float-right">
                        @if (auth()->user() == $item->store->user)
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
                                                {{ csrf_field() }}
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
                                                    <input type="file" class="ml-2" name="images[]" multiple>
                                                    @if ($errors->has('images.*'))
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <strong class="text-danger"><li>{{ $error }}</li></strong>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Description :</label>
                                                    <textarea
                                                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                        name="description"
                                                        rows="3"
                                                        placeholder="add description.">{{ $item->description }}</textarea>
                                                    @if ($errors->has('description'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </div>
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
                                <td>
                                    <a href="{{ route('store.show', $item->store) }}">
                                        <img class="rounded mr-1" src="{{ asset( $item->store->getImage()) }}" alt="avatar" height="32px" width="32px" style="object-fit: cover; background-color: #ddd">
                                        {{ $item->store->name }}
                                    </a>
                                </td>
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

                    <b>Description :</b>
                    <p class="{{ $item->description ? '' : 'text-muted' }}">
                        {{ $item->description ?: 'No description...' }}
                    </p>
                </div>
            </div>

            {{-- Create Comment --}}
            <div class="card mt-3">
                <div class="card-header bg-primary text-white">Write Comment</div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('comment.store', [$item->store, $item]) }}" method="post">
                        {{ csrf_field() }}
                        <textarea name="message" class="form-control" rows="5" cols="30" placeholder="Your comment ..." style="resize: none;"></textarea>
                        <br>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>

                {{-- Show Comments --}}
                @foreach ($item->comments()->get() as $comment)
                    <div class="card-body bg-light">
                        <img class="rounded" src="{{ asset( $comment->user->getImage()) }}" alt="avatar" height="40px" width="40px" style="object-fit: cover; background-color: #ddd">
                        <h5 class="d-inline ml-2"><b>{{ $comment->user->name }}</b></h5>
                        @if ($item->isSellBy($comment->user))
                            <span class="badge badge-primary">Seller</span>
                        @elseif ($item->isPurchaseBy($comment->user))
                            <span class="badge badge-success">Purchaser</span>
                        @endif
                        <p><small>{{ $comment->created_at->diffForHumans() }}</small></p>
                        <p>{{ $comment->message }}</p>
                        <hr>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
