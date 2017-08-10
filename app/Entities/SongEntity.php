<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/2/2017
 * Time: 3:28 PM
 */

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Entities\RankEntity;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="songs")
 */
class SongEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")

     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $artist;

    /**
     * @ORM\Column(type="string")
     */
    private $url;



    /**
     * @ORM\ManyToOne(targetEntity="UserEntity")
     */
    private $uploadedUser;

    /**
     * @ORM\OneToMany(targetEntity="RankEntity", mappedBy="rankedSong", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="rankedSong")
     */
    private $rank;

    public function __construct($title, $artist, $url, $userID)
    {
        $this->rank = new ArrayCollection();
        $this->title = $title;
        $this->artist = $artist;
        $this->url = $url;
        $this->uploadedUser = $userID;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getUploadedUser()
    {
        return $this->uploadedUser;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    public function setUrl($url)
    {
        $this->url = $url;

    }
    public function setUploadedUser($user)
    {
        $this->uploadedUser = $user;

    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        $ranks = $this->rank;
        $total = 0;
        if(sizeof($ranks)===0){
            return 0;
        }
        foreach ($ranks as $rank){
            $total += $rank->getValue();
        }
        $value =  $total/sizeof($ranks);
        return round($value * 2) / 2;;
    }
}
