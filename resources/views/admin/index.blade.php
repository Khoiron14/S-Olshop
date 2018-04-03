@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 offset-1">
            <h1>Admin Page</h1>
            <br>
            <div class="card">
                <div class="card-header bg-primary text-white mb-3"><h4>Store List</h4></div>

                <div class="card-body">
                    <p>Store list in this application.</p>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Store Name</th>
                            <th scope="col">Userid</th>
                            <th scope="col">Username</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                            <tr>
                                <th scope="row">{{ $store->id }}</th>
                                <td><a href="{{ route('store.show', $store) }}">{{ $store->name }}</a></td>
                                <td>{{ $store->user_id }}</td>
                                <td>{{ $store->user->name }}</td>
                                <td>
                                    <form action="{{ route('store.destroy', $store) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-sm btn-danger" name="delete">delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
