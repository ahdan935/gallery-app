@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="row justify-between mb-4">
            <div class="col-md-8 mb-2">
                <h1 class="mt-4">Photos</h1>
            </div>
            <div class="col-md-4">
                <form action="">
                    <div class="input-group mt-4">
                        <input type="text" class="form-control" name="search" placeholder="Search here..."
                            value="{{ $_GET['search'] ?? '' }}">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse ($photos as $photo)
                <div class="col-xl-3 col-md-6">
                    <div class="card mb-4">
                        <img src="{{ asset($photo->path) }}" class="card-img-top">
                        <div class="card-body">{{ $photo->title }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small stretched-link" href="{{ route('photos.show', $photo->id) }}">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No Photo</p>
            @endforelse
        </div>

        {{ $photos->links() }}
    </div>
@endsection
