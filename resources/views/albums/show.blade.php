@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ $album->name }}</h1>
        <div class="row justify-between mb-2">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('albums.index') }}">Album</a></li>
                    <li class="breadcrumb-item active">{{ $album->name }}</li>
                </ol>
            </div>
            <div class="col">
                @auth()
                    @if ($album->user_id == Auth::user()->id)
                        <a href="{{ route('albums.photos.create', $album->id) }}" class="btn btn-primary float-end">Add Photo</a>
                        <form action="{{ route('albums.destroy', $album->id) }}" method="post">
                            @method('delete')
                            @csrf

                            <button type="submit" class="btn btn-danger float-end me-1"
                                onclick="return confirm('Photos will be deleted, are you sure?')">Delete</button>
                        </form>
                        <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-success float-end me-1">Edit</a>
                    @endif
                @endauth
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <p class="mb-0">
                    {{ $album->description }}
                </p>
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
