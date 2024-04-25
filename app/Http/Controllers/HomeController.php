<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = '';
        if(isset($_GET['search'])) $search = $_GET['search'];

        $photos = Photo::where('title', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%')->orderBy('updated_at', 'desc')->paginate(8)->withQueryString();


        return view('home', compact('photos'));
    }
}
