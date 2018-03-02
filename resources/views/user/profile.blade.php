@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 offset-1">
            <div class="card">

                <div class="card-header bg-primary text-white mb-3">
                    <h3 class="d-inline">Profile</h3>

                    <div class="float-right">
                        @if (Auth::user()->hasRole('user'))
                            <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#editProfile">Edit</button>

                            {{-- modal form edit profile --}}
                            <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title">Edit Profile</h5>
                                            <button type="button" class="close" style="color: white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form role="form" method="POST" class="text-dark" action="{{ route('user.update') }}" enctype="multipart/form-data">
                                                {!! csrf_field() !!}
                                                {{ method_field('PATCH') }}
                                                <div class="form-group">
                                                    <label>Name :</label>
                                                    <input
                                                        type="text"
                                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                        name="name"
                                                        value="{{ Auth::user()->name }}"
                                                        placeholder="input your name."
                                                        required
                                                    >
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Email :</label>
                                                    <input
                                                        type="email"
                                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                        name="email"
                                                        value="{{ Auth::user()->email }}"
                                                        placeholder="input your email."
                                                        required
                                                    >
                                                    @if ($errors->has('email'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Phone Number :</label>
                                                    <input
                                                        type="text"
                                                        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                        name="phone"
                                                        value="{{ Auth::user()->phone }}"
                                                        placeholder="input your phone number."
                                                        required
                                                    >
                                                    @if ($errors->has('phone'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Address :</label>
                                                    <input
                                                        type="text"
                                                        class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                        name="address"
                                                        value="{{ Auth::user()->address }}"
                                                        placeholder="input your address."
                                                        required
                                                    >
                                                    @if ($errors->has('address'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Avatar :</label><br>
                                                    <img class="rounded" src="{{ auth()->user()->getImage() }}" alt="avatar" height="64" style="object-fit: cover; background-color: #ddd">
                                                    <input type="file" class="form-control-file d-inline" name="image">
                                                    @if ($errors->has('image'))
                                                        <ul>
                                                            @foreach ($errors->get('image') as $error)
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
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <img class="rounded" src="{{ auth()->user()->getImage() }}" alt="avatar" height="64px" width="64px" style="object-fit: cover; background-color: #ddd">
                    <h4 class="d-inline" style="margin-left: 8px">{{ Auth::user()->name }}</h4>

                    <hr>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row"> Email :</th>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">No. Telepon :</th>
                                <td>{{ Auth::user()->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Alamat :</th>
                                <td>{{ Auth::user()->address }}</td>
                            </tr>
                            @if (Auth::user()->hasRole('seller'))
                                <tr>
                                    <th scope="row">Toko :</th>
                                    <td>
                                        <a href="{{ route('store.show', Auth::user()->store) }}">{{ Auth::user()->store->name }}</a>

                                        {{-- edit store --}}
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#editStore">Edit</button>

                                        {{-- modal form for edit store --}}
                                        <div class="modal fade" id="editStore" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white">Store Edit</h5>
                                                        <button type="button" class="close" style="color: white" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form role="form" method="POST" class="text-dark" action="{{ route('store.update', Auth::user()->store) }}" enctype="multipart/form-data">
                                                            {!! csrf_field() !!}
                                                            {{ method_field('PATCH') }}
                                                            <div class="form-group">
                                                                <label>Name :</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                    name="name"
                                                                    value="{{ Auth::user()->store->name }}"
                                                                    placeholder="input store name."
                                                                    required
                                                                >
                                                                @if ($errors->has('name'))
                                                                    <div class="invalid-feedback">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Avatar :</label><br>
                                                                <img class="rounded" src="{{ auth()->user()->store->getImage() }}" alt="avatar" height="64px" width="64px" style="object-fit: cover; background-color: #ddd">
                                                                <input type="file" class="form-control-file d-inline" name="image">
                                                                @if ($errors->has('image'))
                                                                    <ul>
                                                                        @foreach ($errors->get('image') as $error)
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
                                                                        placeholder="input description."
                                                                        required
                                                                >{{ auth()->user()->store->description }}</textarea>
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
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @if (Auth::user()->hasRole('user') && !(Auth::user()->hasRole('seller')))
                        <p class="text-center">Ingin menjual sesuatu? <a href="{{ route('store.create') }}">Daftar sekarang!</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
