@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ $photo->title }}</h1>
        <div class="row justify-between mb-2">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('albums.index') }}">Album</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('albums.show', $album->id) }}">{{ $album->name }}</a></li>
                    <li class="breadcrumb-item active">{{ $photo->title }}</li>
                </ol>
            </div>
            <div class="col">
                @auth()
                    @if ($album->user_id == Auth::user()->id)
                        <form action="{{ route('albums.photos.destroy', ['album' => $album->id, 'photo' => $photo->id]) }}"
                            method="post">
                            @method('delete')
                            @csrf

                            <button type="submit" class="btn btn-danger float-end me-1"
                                onclick="return confirm('Comments and Likes will be deleted, are you sure?')">Delete</button>
                        </form>
                        <a href="{{ route('albums.photos.edit', ['album' => $album->id, 'photo' => $photo->id]) }}"
                            class="btn btn-success float-end me-1">Edit</a>
                    @endif
                @endauth
            </div>
        </div>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset($photo->path) }}" class="img-fluid rounded-start" width="100%">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $photo->title }}</h5>
                        <p class="card-text">{{ $photo->description }}</p>
                        @auth()
                            @if ($likes->contains('user_id', Auth::user()->id))
                                <form
                                    action="{{ route('likes.destroy', $likes->where('user_id', Auth::user()->id)->first->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-primary">{{ $likes->count() }} Unlike</button>
                                </form>
                            @else
                                <form action="{{ route('likes.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                                    <button type="submit" class="btn btn-primary">{{ $likes->count() }} Like</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                Add Comment
            </div>
            <div class="card-body">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-primary float-end mt-2">Submit</button>
                </form>
            </div>
        </div>
        <h1 class="mt-4">Comments</h1>
        @forelse ($comments as $comment)
            <div class="card mt-4">
                <div class="card-header">
                    {{ $comment->user->name }}
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $comment->content }}</p>
                    @auth()
                        @if ($comment->user_id == Auth::user()->id)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                @method('delete')
                                @csrf

                                <button type="submit" class="btn btn-danger float-end me-1"
                                    onclick="return confirm('Comment will be deleted, are you sure?')">Delete</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        @empty
            <p>No Comment</p>
        @endforelse
    </div>
@endsection
