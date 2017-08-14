<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/10/2017
 * Time: 4:08 PM
 */


namespace App\Repository;
use Doctrine\ORM\EntityRepository;

class  SongRepo extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('username' => 'ASC'));
    }
}