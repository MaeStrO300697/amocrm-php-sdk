<?php
/**
 * Created by PhpStorm.
 * User: artemiy
 * Date: 30.05.2020
 * Time: 10:03
 */

namespace maestro300697\amocrmSdk\Entity;


class ListEntity
{
    protected $entities;

    public function add(IEntity $entity){
        $this->entities[] = $entity;
    }

    public function getList(){
        return $this->entities;
    }

}