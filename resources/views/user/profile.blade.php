@extends('layouts.app') @section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 offset-1">
            <div class="card mb-5">

                <div class="card-header bg-primary text-white">
                    <h4 class="d-inline">Profile</h4>

                    <div class="float-right">
                        <a href="{{ route('user.edit') }}" class="btn btn-sm btn-light">Edit</a>
                    </div>
                </div>

                <div class="card-body">
                    <img
                        class="rounded"
                        src="{{ auth()->user()->getImage() }}"
                        alt="avatar"
                        height="64px"
                        width="64px"
                        style="object-fit: cover; background-color: #ddd">
                    <h4 class="ml-2 d-inline">{{ auth()->user()->name }}</h4>
                    <br>

                    <label for="email" class="mt-3 font-weight-bold">Email :</label>
                    <p id="email">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header bg-primary text-white">
                    <h5 class="d-inline">Address</h5>

                    <div class="float-right">
                        <a href="{{ route('address.index') }}" class="btn btn-sm btn-light">Edit</a>
                    </div>
                </div>

                <div class="card-body text-center">

                    <div class="row">
                        @foreach (auth()->user()->addresses()->get() as $address)
                        <div class="card border-primary col-md-4 mb-3">
                            <div class="card-header bg-transparent">{{ $address->phone }}</div>
                            <div class="card-body text-primary">
                                <p class="card-text">{{ $address->location }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

            @if (auth()->user()->hasRole('seller'))
            <div class="card mb-5">
                <div class="card-header bg-primary text-white">
                    <h4 class="d-inline">Store</h4>

                    <div class="float-right">
                        <a
                            href="{{ route('store.edit', auth()->user()->store) }}"
                            class="btn btn-sm btn-light">Edit</a>
                    </div>
                </div>

                <div class="card-body">
                    <img
                        class="rounded"
                        src="{{ auth()->user()->store->getImage() }}"
                        alt="store avatar"
                        height="64px"
                        width="64px"
                        style="object-fit: cover; background-color: #ddd">
                    <a class="ml-2" href="{{ route('store.show', auth()->user()->store) }}">{{ auth()->user()->store->name }}</a>
                </div>
            </div>

            @else
            <p class="text-center">Want to sell something?
                <a href="{{ route('store.create') }}">Sign up now!</a>
            </p>
            @endif
        </div>
    </div>
</div>
@endsection