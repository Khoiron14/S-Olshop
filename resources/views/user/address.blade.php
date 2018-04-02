@extends('layouts.app') @section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 offset-1">
            @if ($addresses->count() != null)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td scope="col">Phone</td>
                        <td scope="col">Location</td>
                        <td scope="col">Option</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($addresses as $address)
                    <tr>
                        <td>{{ $address->phone }}</td>
                        <td>{{ $address->location }}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-light"
                                data-toggle="modal"
                                data-target="#editAddress">
                                Edit
                            </button>

                            <!-- Edit Address -->
                            <div
                                class="modal fade"
                                id="editAddress"
                                tabindex="-1"
                                role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Edit Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('address.update', $address) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="#phone">Phone</label>
                                                    <input
                                                        type="text"
                                                        value="{{ $address->phone }}"
                                                        class="form-control"
                                                        name="phone"
                                                        id="phone">
                                                </div>

                                                <div class="form-group">
                                                    <label for="#location">Location</label>
                                                    <input
                                                        type="text"
                                                        value="{{ $address->location }}"
                                                        class="form-control"
                                                        name="location"
                                                        id="location">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Delete Address -->
                            <form
                                action="{{ route('address.destroy', $address) }}"
                                method="post"
                                class="d-inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" name="delete">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>You have not added the address, add it by clicking the add button</p>
            @endif 
            
            @if ($addresses->count() < 3)
            <button
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#addAddress">
                Add
            </button>

            <!-- Add Address -->
            <div
                class="modal fade"
                id="addAddress"
                tabindex="-1"
                role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Add Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('address.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="#phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone">
                                </div>

                                <div class="form-group">
                                    <label for="#location">Location</label>
                                    <input type="text" class="form-control" name="location" id="location">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection