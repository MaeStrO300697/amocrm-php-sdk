<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 26.05.2020
 * Time: 10:31
 */

namespace maestro300697\amocrmSdk;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use maestro300697\amocrmSdk\EntitiesService\IEntityService;

class QueryGenerator
{

    protected $format = 'array';

    /**
     * Make request to Amocrm API.
     *
     * @param \maestro300697\amocrmSdk\EntitiesService\IEntityService $essence
     * @param Client $client
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request(IEntityService $essence, Client $client)
    {
        try {
            if($essence->getEntity()) {
                $response = $client->getClient()->request(
                    'Post', $essence->getLink(), [
                        'headers' => [
                            'User-Agent' => 'amoCRM-API-client/1.0',
                            'Content-Type' => 'application/json'
                        ],
                        RequestOptions::JSON => $essence->getEntity()
                    ]
                );
            }else{
                $response = $client->getClient()->request(
                    'Get', $essence->getLink(), [
                        'headers' => [
                            'User-Agent' => 'amoCRM-API-client/1.0',
                        ]
                    ]
                );
            }
        } catch (GuzzleException | \Exception $e) {
            echo $e->getMessage() . \PHP_EOL;
            echo $e->getCode() . \PHP_EOL;
            exit;
        }
        return $response;
    }



}
