@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form
                        role="form"
                        method="POST"
                        class="text-dark"
                        action="{{ route('user.update') }}"
                        enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label>Name :</label>
                            <input
                                type="text"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                name="name"
                                value="{{ auth()->user()->name }}"
                                placeholder="input your name."
                                {{ auth()->user()->isNameDefault() ? 'required' : 'disabled' }}>
                            <small class="form-text text-muted">
                                Only one change, please check again!
                            </small>
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
                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email"
                                value="{{ auth()->user()->email }}"
                                placeholder="input your email."
                                required="required">
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
                                value="{{ auth()->user()->phone }}"
                                placeholder="input your phone number."
                                required="required">
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
                                value="{{ auth()->user()->address }}"
                                placeholder="input your address."
                                required="required">
                            @if ($errors->has('address'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('address') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Avatar :</label><br>
                            <img
                                class="rounded"
                                src="{{ auth()->user()->getImage() }}"
                                alt="avatar"
                                height="64"
                                style="object-fit: cover; background-color: #ddd">
                            <input type="file" class="ml-2" name="image">
                            @if ($errors->has('image'))
                            <ul>
                                @foreach ($errors->get('image') as $error)
                                <strong class="text-danger">
                                    <li>{{ $error }}</li>
                                </strong>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary float-right">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection