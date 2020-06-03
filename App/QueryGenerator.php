<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 26.05.2020
 * Time: 10:31
 */

namespace maestro300697\amocrmSdk;

use GuzzleHttp\Exception\GuzzleException;
use maestro300697\amocrmSdk\EntitiesService\BaseEntityService;
use maestro300697\amocrmSdk\Entity\IEntity;
use maestro300697\amocrmSdk\Entity\Lead;

class QueryGenerator
{

    protected $format = 'array';


    /**
     * @param  BaseEntityService $service
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request($typeRequest = '', BaseEntityService $service)
    {
        try {
            if ($typeRequest != "search") {
                $response = $service->getClient()->getClient()->request(
                    'Post', $service->getLink(), [
                        'headers' => [
                            'User-Agent' => 'amoCRM-API-client/1.0'
                        ],
                        'json' => [
                            $typeRequest => $service->getEntity()->getListHowArray()
                        ]
                    ]
                );
            } else {
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

    public function link(Lead $lead,IEntity $entity, BaseEntityService $service)
    {
        try {
            $response = $service->getClient()->getClient()->request(
                'Post', $service->getLink() . '/' . $lead->getId() . '/link', [
                    'headers' => [
                        'User-Agent' => 'amoCRM-API-client/1.0'
                    ],
                    'json' => [
                        [
                            'to_entity_id' => $entity->getId(),
                            'to_entity_type' => 'contacts',
                            "metadata" => null
                        ]
                    ]
                ]
            );
        } catch (GuzzleException | \Exception $e) {
            echo $e->getMessage() . \PHP_EOL;
            echo $e->getCode() . \PHP_EOL;
            exit;
        }
        return $response;
    }

}
