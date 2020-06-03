<?php
/**
 * Created by PhpStorm.
 * User: artemiy
 * Date: 30.05.2020
 * Time: 10:03
 */

namespace maestro300697\amocrmSdk\Entity;


/**
 * Class ListEntity
 *
 * @package maestro300697\amocrmSdk\Entity
 */
class ListEntity
{
    /**
     * @var
     */
    protected $entities = [];

    /**
     * @param IEntity $entity
     */
    public function add(IEntity $entity)
    {
        $this->entities[] = $entity;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->entities;
    }

    /**
     * @return mixed
     */
    public function getListHowArray()
    {
        $array = [];
        foreach ($this->entities as $key => $entity){
            $array = $entity->toArray();
        }
        return $array;
    }


}
