@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Store Register</h3>
                </div>
                <div class="card-body">
                    <form
                        method="POST"
                        action="{{ route('store.store') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Name</label>
                            <div class="col-lg-6">
                                <input
                                    type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name"
                                    value="{{ old('name') }}"
                                    autofocus="autofocus"
                                    required="required">
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
                                <span>{{ request()->root() }}/</span>
                                <input
                                    type="text"
                                    class="form-control{{ $errors->has('domain') ? ' is-invalid' : '' }}"
                                    name="domain"
                                    value="{{ old('domain') }}"
                                    autofocus="autofocus"
                                    required="required">
                                @if ($errors->has('domain'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('domain') }}</strong>
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
                    <small>
                        <ul>
                            <li>Can't change, please check again!</li>
                            <li>You can edit avatar and description in store edit page after registered.</li>
                        </ul>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection