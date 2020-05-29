<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.05.2020
 * Time: 11:34
 */

namespace maestro300697\amocrmSdk\EntitiesService;

use GuzzleHttp\Psr7\Response;
use maestro300697\amocrmSdk\Entity\IEntity;

class ContactService extends BaseEntityService
{

    protected $contacts;

    protected $link = '/contacts';


    public function create(IEntity $entity)
    {
        //$this->contacts['add'] = $entity;
    }

    public function update(IEntity $entity)
    {
        // TODO: Implement update() method.
    }

    public function list($query,$limit = 500)
    {
        // TODO: Implement list() method.
        $this->contacts = null;
        $this->link = $this->link . '?limit=500';
    }


    public function getLink()
    {
        return $this->link;
    }

    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

    public function getEntity()
    {
        return $this->contacts;
    }

    public function getContactByField(Response $response, $field, $value){

    }

}