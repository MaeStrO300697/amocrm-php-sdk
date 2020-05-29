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

    public function __construct(Client $client,QueryGenerator $queryGenerator){
        $this->client = $client;
        $this->queryGenerator = $queryGenerator;
    }

    public abstract function getById(int $id);
    public function add(IEntity $entity){
        //$this->queryGenerator->request();
    }
    public abstract function update(IEntity $entity);
    public abstract function list($query,$limit);
    public abstract function getEntity();
    public function getLink(){
        return $this->apiLink;
    }
}