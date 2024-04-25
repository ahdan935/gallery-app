@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4">My Comments</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Content</th>
                    <th scope="col">Created</th>
                    <th scope="col">Photo</th>
                </tr>
            </thead>
            <tbody>
                @php
                    if(isset($_GET['page'])){
                        $i = $_GET['page'];
                    } else {
                        $i = 1;
                    }
                @endphp
                @forelse ($comments as $comment)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->created_at->format('d-m-Y') }}</td>
                        <td><a href="{{ route('photos.show', $comment->photo->id) }}">View</a></td>
                    </tr>

                @empty
                    <tr>
                        <th colspan="4">No Comment</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $comments->links() }}
    </div>
@endsection
