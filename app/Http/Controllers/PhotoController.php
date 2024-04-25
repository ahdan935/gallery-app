<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Album $album)
    {
        return view('albums.photos.create', compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Album $album)
    {
        if (!Gate::allows('album-owner', $album)) {
            return redirect()->back();
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:755',
            'photo' => 'image|mimes:jpeg,jpg,png'
        ]);

        $path = $request->file('photo')->store('gallery/' . $album->id);

        Photo::create([
            ...$validated,
            'path' => $path,
            'album_id' => $album->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('albums.show', $album->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return view('photos.show', [
            'photo' => $photo,
            'album' => $photo->album,
            'likes' => $photo->likes,
            'comments' => $photo->comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album, Photo $photo)
    {
        return view('albums.photos.edit', compact('album', 'photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album, Photo $photo)
    {
        if (!Gate::allows('album-owner', $album)) {
            return redirect()->back();
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:755',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png'
        ]);

        $path = '';

        if($request->file('photo') == null){
            $path = $photo->path;
        } else {
            unlink(storage_path('app/' . $photo->path));

            $path = $request->file('photo')->store('gallery/' . $album->id);
        }


        $photo->update([
            ...$validated,
            'path' => $path,
            'album_id' => $album->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('photos.show', $photo->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album, Photo $photo)
    {
        $photo->delete();

        return redirect()->route('albums.show', $album->id);
    }
}
