<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AlbumController extends Controller
{
    private $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:755'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(8);

        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);

        Album::create([
            ...$validated,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return view('albums.show', [
            'album' => $album,
            'photos' => Photo::where('album_id', $album->id)->orderBy('updated_at', 'desc')->paginate(8),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $validated = $request->validate($this->rules);

        $album->update($validated);

        return redirect()->route('albums.show', $album->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        File::deleteDirectory(storage_path('app\\gallery\\' . $album->id));

        $album->delete();

        return redirect()->route('albums.index');
    }
}
