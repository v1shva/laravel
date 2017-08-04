<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/2/2017
 * Time: 3:28 PM
 */

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class UserEntity implements Authenticatable
{
    use \LaravelDoctrine\ORM\Auth\Authenticatable;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $email;



    /**
     * @ORM\Column(type="string")
     */
    private $userlevel;



    public function __construct($name, $email, $password, $userlevel)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password= $password;
        $this->userlevel= $userlevel;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

/*    public function getPassword()
    {
        return $this->password;
    }*/

    public function getUserLevel()
    {
        return $this->userlevel;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

/*    public function setPassword($password)
    {
       $this->password = $password;
    }*/

    public function setUserLevel($userlevel)
    {
        $this->userlevel = $userlevel;
    }





}