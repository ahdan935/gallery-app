@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">My Albums</h1>
        <div class="row justify-between mb-2">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Album</li>
                </ol>
            </div>
            <div class="col">
                <a href="{{ route('albums.create') }}" class="btn btn-primary float-end">Create Album</a>
            </div>
        </div>
        <div class="row">
            @forelse ($albums as $album)
                <div class="col-xl-3 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">{{ $album->name }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small stretched-link" href="{{ route('albums.show', $album) }}">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No Album</p>
            @endforelse
        </div>
        {{ $albums->links() }}
    </div>
@endsection
