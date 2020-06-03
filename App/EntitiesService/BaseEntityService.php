<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.05.2020
 * Time: 14:52
 */

namespace maestro300697\amocrmSdk\EntitiesService;


use maestro300697\amocrmSdk\Client;
use maestro300697\amocrmSdk\Entity\ListEntity;
use maestro300697\amocrmSdk\QueryGenerator;

/**
 * Class BaseEntityService
 *
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

    /**
     * @var string
     */
    protected $apiLink = '/api/v4/';

    /**
     * @var ListEntity
     */
    protected $listEntity;

    /**
     * @var string
     */
    protected static $entity = '/';

    /**
     * BaseEntityService constructor.
     *
     * @param Client         $client
     * @param QueryGenerator $queryGenerator
     */
    public function __construct(Client $client, QueryGenerator $queryGenerator)
    {
        $this->client = $client;
        $this->queryGenerator = $queryGenerator;
    }

    /**
     * @return ListEntity
     */
    public function getListEntity(): ListEntity
    {
        return $this->listEntity;
    }

    /**
     * @param ListEntity $listEntity
     */
    public function setListEntity(ListEntity $listEntity)
    {
        $this->listEntity = $listEntity;
    }


    /**
     * @param  int $id
     * @return mixed
     */
    public abstract function getById(int $id);

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function create()
    {
        return $this->queryGenerator->request('add', $this);
    }

    /**
     * @return mixed
     */
    public abstract function update();

    /**
     * @param $query
     * @param $limit
     */
    public function query($query, $limit)
    {

    }

    /**
     * @return ListEntity
     */
    public function getEntity()
    {
        return $this->listEntity;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->apiLink . static::$entity;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

}
