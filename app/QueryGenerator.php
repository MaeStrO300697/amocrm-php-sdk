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

class QueryGenerator
{

    protected $format = 'array';


    public function __construct()
    {

    }

    /**
     * Make request to Amocrm API.
     */
    public function request(EssenceAmoCrm $essence,Client $client)
    {
        try {
            $response = $client->getClient()->request(
                'Post', $essence->getLink(), [
                'headers' => [
                    'User-Agent' => 'amoCRM-API-client/1.0',
                    'Content-Type' => 'application/json'
                ],
                RequestOptions::JSON => [
                    $essence->getType() =>
                        $essence->getLead(),
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
