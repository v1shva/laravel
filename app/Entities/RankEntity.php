<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/4/2017
 * Time: 3:52 PM
 */

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="songs")
 */

class RankEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="SongEntity")
     */
    private $rankedSong;


    /**
     * @ORM\ManyToOne(targetEntity="UserEntity")
     */
    private $rankedUser;


    public function __construct($song, $user)
    {
        $this->rankedSong = $song;
        $this->rankedUser = $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRankedSong()
    {
        return $this->rankedSong;
    }

    public function getRankedUser()
    {
        return $this->rankedUser;
    }
    
    public function setRankedSong($rankedSong)
    {
        $this->rankedSong = $rankedSong;
    }

    public function setRankedUser($rankedUser)
    {
        $this->rankedUser = $rankedUser;
    }
    
}
