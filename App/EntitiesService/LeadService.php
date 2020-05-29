<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 26.05.2020
 * Time: 12:07
 */

namespace maestro300697\amocrmSdk\EntitiesService;


use maestro300697\amocrmSdk\Entity\IEntity;

class LeadService extends BaseEntityService
{

    protected $lead;

    protected static $entity = 'leads';

    public function create(IEntity $lead)
    {
        $this->lead['add'] = $lead;
    }

    public function update(IEntity $lead)
    {
        // TODO: Implement update() method.
    }


    public function list($query,$limit = 250)
    {
        // TODO: Implement list() method.
    }


    public function getEntity()
    {
        return $this->lead;
    }

    public function getLink()
    {
        return parent::getLink() . self::$entity;
    }

    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }
}
