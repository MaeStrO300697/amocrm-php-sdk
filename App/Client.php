<?php

/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 27.05.2020
 * Time: 13:44
 */

namespace maestro300697\amocrmSdk;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use maestro300697\amocrmSdk\Exceptions\AuthException;

class Client
{

    /**
     * Key for API AmoCrm.
     *
     * @var string
     *
     * @see https://*subdomain*.amocrm.ru/settings/profile/
     */

    protected $key;

    /**
     * Subdomain for AmoCrm.
     *
     * @var string
     *
     * @see https://*subdomain*.amocrm.ru
     */

    protected $subdomain;

    /**
     * Login fot AmoCrm
     *
     * @var string
     */
    protected $login;

    public $client;


    public function __construct($login, $subdomain, $hash)
    {
        if (empty($login) || empty($subdomain) || empty($hash)) {
            throw new InvalidArgumentException('Login, subdomains, hash cannot be empty');
        }
        $this->setLogin($login)
            ->setSubdomain($subdomain)
            ->setKey($hash);
        // Create a client with a base URI
        $link = 'https://' . $this->getSubdomain() . '.amocrm.ru/';
        $this->client = new GuzzleClient(
            [
                'base_uri' => $link,
                'verify'  => false,
                'cookies'  => true
            ]
        );
        if ($this->passAuth() instanceof Response) {
            return $this;
        }else{
            throw new InvalidArgumentException();
        }
    }

    /**
     * @param  $login
     * @return $this
     */

    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * Getter for login property.
     *
     * @return string
     */

    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param  $subdomain
     * @return $this
     */

    public function setSubdomain($subdomain)
    {
        $this->subdomain = $subdomain;
        return $this;
    }

    /**
     * Getter for subdomain property.
     *
     * @return string
     */

    public function getSubdomain()
    {
        return $this->subdomain;
    }

    /**
     * Setter for key property.
     *
     * @param string $key AmoCrm API key
     *
     * @return $this
     */

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Getter for key property.
     *
     * @return string
     */

    public function getKey()
    {
        return $this->key;
    }


    /**
     *
     * @return \GuzzleHttp\Client
     */

    public function getClient()
    {
        return $this->client;
    }


    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function passAuth()
    {
        try {
            $response = $this->getClient()->request(
                'Post', "/private/api/auth.php?type=json", [
                    'headers' => [
                        'User-Agent' => 'amoCRM-API-client/1.0',
                    ],
                    'form_params' => [
                        'USER_LOGIN' => $this->getLogin(),
                        'USER_HASH' => $this->getKey()
                    ]
                ]
            );
            $responseBody = json_decode($response->getBody()->getContents(), true);

            if($responseBody['response']['auth'] === true) {
                return $response;
            }else{
                throw new AuthException($responseBody);
            }
        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
