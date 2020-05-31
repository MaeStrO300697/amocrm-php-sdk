<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.05.2020
 * Time: 14:52
 */

namespace maestro300697\amocrmSdk\EntitiesService;


use maestro300697\amocrmSdk\Client;
use maestro300697\amocrmSdk\Entity\IEntity;
use maestro300697\amocrmSdk\Entity\ListEntity;
use maestro300697\amocrmSdk\QueryGenerator;

/**
 * Class BaseEntityService
 * @package maestro300697\amocrmSdk\EntitiesService
 */
abstract class BaseEntityService implements IEntityService
{
    /**
     * Класс выполняющий авторизацию + задает базовое поведение клиента Guzzle
     *
     * @var $client Client
     */
    protected $client;

    /**
     * Класс выполняющий запросы к AmoCRM
     *
     * @var $queryGenerator QueryGenerator
     */
    protected $queryGenerator;

    protected $apiLink = '/api/v4/';

    protected $listEntity;

    public function __construct(ListEntity $listEntity,Client $client,QueryGenerator $queryGenerator){
        $this->listEntity = $listEntity;
        $this->client = $client;
        $this->queryGenerator = $queryGenerator;
    }

    public abstract function getById(int $id);
    public function create(){
        return $this->queryGenerator->request('add',$this);
    }
    public abstract function update();
    public abstract function list($query,$limit);

    public function getEntity(){
        return $this->listEntity;
    }
    public function getLink(){
        return $this->apiLink;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }


}