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
 * @ORM\Table(name="ranks")
 */

class RankEntity
{


    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="SongEntity")
     */
    private $rankedSong;


    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="UserEntity")
     */
    private $rankedUser;

    /**
     * @ORM\Column(type="float")
     */
    private $value;


    public function __construct($song, $user, $rank)
    {
        $this->rankedSong = $song;
        $this->rankedUser = $user;
        $this->value = $rank;
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

    public function getValue(){
        return $this->value;
    }

    public function setRankedSong($rankedSong)
    {
        $this->rankedSong = $rankedSong;
    }

    public function setRankedUser($rankedUser)
    {
        $this->rankedUser = $rankedUser;
    }

    public function setValue($newValue){
        $this->value = $newValue;
    }
    
}
