@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Edit Store</h3>
                </div>
                <div class="card-body">
                    <form
                        role="form"
                        method="POST"
                        class="text-dark"
                        action="{{ route('store.update', $store) }}"
                        enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label>Name :</label>
                            <input
                                type="text"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                name="name"
                                value="{{ $store->name }}"
                                placeholder="input store name."
                                required="required">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Avatar :</label><br>
                            <img
                                class="rounded"
                                src="{{ $store->getImage() }}"
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

                        <div class="form-group">
                            <label>Description :</label>
                            <textarea
                                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                name="description"
                                rows="3"
                                placeholder="input description."
                                required="required">{{ $store->description }}</textarea>
                            @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </div>
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