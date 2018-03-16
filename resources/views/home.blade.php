@extends('layouts.app')

@section('content')
<div class="container">

    <form class="mt-5" action="{{ route('home.search') }}" method="get">
        <div class="input-group">
            <input class="form-control" type="search" name="q" placeholder="Search item here...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit"><i class="ion-ios-search ion-sm"></i> Search</button>
            </div>
        </div>
    </form>

    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-md-4 col-sm-6" style="margin-bottom: 35px">
                        <div class="card" style="box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.15)">
                            <img class="card-img-top rounded" src="{{ $item->getImage() }}" alt="Card image cap" height="200px" style="object-fit: cover">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('item.show', [$item->store, $item]) }}">{{ $item->name }}</a>
                                </h5>
                                <h6 class="card-subtitle text-muted">Rp {{ number_format($item->price) }}</h6>
                            </div>
                            <div class="card-footer text-muted">
                                Dijual oleh : <a href="{{ route('store.show', $item->store) }}" class="card-link">{{ $item->store->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {!! $items->render() !!}
        </div>
    </div>
</div>
@endsection
