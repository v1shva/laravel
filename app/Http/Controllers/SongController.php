<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;
use Log;

class SongController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('song.songs', ['songs' => Song::all()]);

    }

    public function addSong()

    {
        Log::info('here');
        return view('song.songRegister');
    }




    protected function create(Request $request)
    {
        $data = $request->input();
/*        $this->validate($request, [
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'url' => 'required|string|url|unique:songs',
        ]);*/


        Song::create([
            'title' => $data['title'],
            'artist' => $data['artist'],
            'url'=> $data['url']
        ]);
        return redirect('song');

    }
}
