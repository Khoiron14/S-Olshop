@extends('layouts.app') @section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 offset-1">
            <div class="card">

                <div class="card-header bg-primary text-white mb-3">
                    <h3 class="d-inline">Profile</h3>

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
                    <h4 class="d-inline" style="margin-left: 8px">{{ auth()->user()->name }}</h4>

                    <hr>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">
                                    Email :</th>
                                <td>{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">No. Telepon :</th>
                                <td>{{ auth()->user()->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Alamat :</th>
                                <td>{{ auth()->user()->address }}</td>
                            </tr>
                            @if (auth()->user()->hasRole('seller'))
                            <tr>
                                <th scope="row">Toko :</th>
                                <td>
                                    <a href="{{ route('store.show', auth()->user()->store) }}">{{ auth()->user()->store->name }}</a>
                                    <a href="{{ route('store.edit', auth()->user()->store) }}" class="btn btn-sm btn-light">Edit</a>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    @if (auth()->user()->hasRole('user') && !(auth()->user()->hasRole('seller')))
                    <p class="text-center">Want to sell something?
                        <a href="{{ route('store.create') }}">Sign up now!</a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection