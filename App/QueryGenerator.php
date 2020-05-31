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
use maestro300697\amocrmSdk\EntitiesService\BaseEntityService;

class QueryGenerator
{

    protected $format = 'array';


    /**
     * @param BaseEntityService $service
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request($typeRequest,BaseEntityService $service)
    {
        try {
            if($service->getEntity()->getList()) {
                $response = $service->getClient()->client->request(
                    'Post', $service->getLink(), [
                        'headers' => [
                            'User-Agent' => 'amoCRM-API-client/1.0',
                            'Content-Type' => 'application/json'
                        ],
                        RequestOptions::JSON => [
                            $typeRequest => $service->getEntity()->getList()
                        ]
                    ]
                );
            }else{
                $response = $service->getClient()->client->request(
                    'Get', $service->getLink(), [
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
