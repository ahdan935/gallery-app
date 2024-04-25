@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Photo</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('albums.index') }}">Album</a></li>
            <li class="breadcrumb-item"><a href="{{ route('albums.show', $album->id) }}">{{ $album->name }}</a></li>
            <li class="breadcrumb-item active">Edit Photo</li>
        </ol>
        <form action="{{ route('albums.photos.update', ['album' => $album->id, 'photo' => $photo->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="title" class="form-label">Photo title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title', $photo->title) }}" required>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="3" required>{{ old('description', $photo->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Select File</label>
                <input class="form-control  @error('photo') is-invalid @enderror" type="file" id="image"
                    name="photo" onchange="previewImage()">
                @error('photo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <img src="{{ asset($photo->path) }}" class="img-preview img-thumbnail" style="max-width: 300px">
            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </form>
    </div>
@endsection
