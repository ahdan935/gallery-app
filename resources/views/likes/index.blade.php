@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4">Liked Photos</h1>
        <div class="row">
            @forelse ($likes as $like)
                <div class="col-xl-3 col-md-6">
                    <div class="card mb-4">
                        <img src="{{ asset($like->photo->path) }}" class="card-img-top">
                        <div class="card-body">{{ $like->photo->title }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small stretched-link" href="{{ route('photos.show', $like->photo->id) }}">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No Liked Photo</p>
            @endforelse
        </div>
        {{ $likes->links() }}
    </div>
@endsection
