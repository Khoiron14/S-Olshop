@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register Store</div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('store.store') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Name</label>
                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        name="name"
                                        value="{{ old('name') }}"
                                        autofocus
                                        required
                                >
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Domain</label>

                            <div class="col-lg-6">
                                <span>{{ substr(request()->url(), 7, -14) }}</span>
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('domain') ? ' is-invalid' : '' }}"
                                        name="domain"
                                        value="{{ old('domain') }}"
                                        autofocus
                                        required
                                >
                                @if ($errors->has('domain'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('domain') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Avatar</label>

                            <div class="col-lg-6">
                                <input type="file" class="form-control-file" name="image" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Description</label>

                            <div class="col-lg-6">
                                <textarea
                                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        name="description"
                                        value="{{ old('description') }}"
                                        rows="3"
                                        required
                                ></textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
