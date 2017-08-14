<?php

namespace App\Http\Controllers;

use App\Entities\RankEntity;
use App\Entities\SongEntity;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        //$this->middleware(['web','auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(EntityManagerInterface $em)
    {
        //$songs = $em->getRepository(SongEntity::class)->findBy(array("uploadedUser" => Auth::user()));
        //$query = $em->createQuery("Select r.value, FROM App\Entities\RankEntity r WHERE EXISTS (SELECT s FROM App\Entities\SongEntity s WHERE (s.uploadedUser= :user AND s = r.rankedSong))");
        $query = $em->createQuery("Select s FROM App\Entities\SongEntity s LEFT JOIN s.rank r WHERE s.uploadedUser= :user");
        $query->setParameter('user', Auth::user());
        $results = $query->getResult();
        $songs = $results;
        $songsAll = $em->getRepository(SongEntity::class)->findAll();
        //$songsAll = $em->getRepository(SongEntity::class)->findAll();
        return view('song.songs', ['songs' => $songs, 'songsAll'=> $songsAll]);
        /*return view('song.songs', ['songs' => Song::all()]);*/

    }



    public function addSong()

    {
        return view('song.songRegister');
    }


    protected function create(Request $request, EntityManagerInterface $em)
    {
        $user = Auth::user();
        //\Log::info($user);
        $data = $request->input();
        $file = file_get_contents($request['file']);
        $songID = $em->createQueryBuilder()
            ->select('MAX(s.id)')
            ->from(' App\Entities\SongEntity', 's')
            ->getQuery()
            ->getSingleScalarResult();
        $songID++;
        Storage::disk('songs')->put($songID.'_upload.mp3', $file);
/*        $this->validate($request, [
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'url' => 'required|string|url|unique:App\Entities\SongEntity',
        ]);*/
        $data['url'] = Storage::disk('songs')->url($songID.'_upload.mp3');
        $song = new SongEntity(
            $data['title'],
            $data['artist'],
            $data['url'],
            $user
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

    public function getSongs(EntityManagerInterface $em)
    {
        $songs = $em->getRepository(SongEntity::class)->findAll();
        $songList = [];
        \Log::info($songs);
        foreach ($songs as $song){
            $currentSong["artist"] = $song->getArtist();
            $currentSong["title"] = $song->getTitle();
            $currentSong["url"] = $song->getUrl();
            array_push($songList, $currentSong);
        }
        return $songList;
        /*return view('song.songs', ['songs' => Song::all()]);*/

    }

    public function rankSong (Request $request, EntityManagerInterface $em){
        $data = $request->input();
        $user = Auth::user();
        $song = $em->getRepository(SongEntity::class)->find($data['song']);
        $rank = new RankEntity(
            $song,
            $user,
            $data['rating']
        );
        $em->merge($rank);
        $em->flush();
        return redirect('song');
    }

    public function searchSongs(EntityManagerInterface $em, Request $keyword)
    {
        $songs = $em->getRepository(SongEntity::class)->createQueryBuilder('s')
            ->where('s.title LIKE :keyword')
            ->setParameter('keyword', '%'.$keyword->get('keywords').'%')
            ->getQuery()
            ->getResult();
        return response([
            'msg' => 'Login Successfull',
            'markup' => (String) View::make('templates.songTable')->with('songsAll', $songs)
        ], 200);

    }
}
