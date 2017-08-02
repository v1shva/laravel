<?php

namespace App\Http\Controllers;

use App\Entities\SongEntity;
use Doctrine\ORM\EntityManagerInterface;

use Illuminate\Http\Request;
use Log;
use Validator;

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

    public function index(EntityManagerInterface $em)
    {
        $songs = $em->getRepository(SongEntity::class)->findAll();
        return view('song.songs', ['songs' => $songs]);
        /*return view('song.songs', ['songs' => Song::all()]);*/

    }



    public function addSong()

    {
        return view('song.songRegister');
    }




    protected function create(Request $request, EntityManagerInterface $em)
    {


        $data = $request->input();
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'url' => 'required|string|url|unique:App\Entities\SongEntity',
        ]);

        $song = new SongEntity(
            $data['title'],
            $data['artist'],
            $data['url']
        );

        $em->persist($song);
        $em->flush();


       /* Song::create([
            'title' => $data['title'],
            'artist' => $data['artist'],
            'url'=> $data['url']
        ]);*/

        return redirect('song');

    }
}
