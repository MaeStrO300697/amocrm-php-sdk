<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.05.2020
 * Time: 10:31
 */

namespace maestro300697\amocrmSdk;


class queryGenerator
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
     * @var string Format of returned data - array, json
     */
    protected $format = 'array';

    /**
     * Default constructor.
     *
     * @param string $key            AmoCrm API key
     * @param bool   $throwErrors    Throw request errors as Exceptions
     *
     * @return AmoCrmApi
     */
    public function __construct($subdomain,$key)
    {
        return $this
            ->setSubdomain($subdomain)
            ->setKey($key);
    }

    /**
     * @param $subdomain
     * @return $this
     */

    public function setSubdomain($subdomain){
        $this->subdomain = $subdomain;
        return $this;
    }

    public function getSubdomain(){
         return $this->subdomain;
    }

    /**
     * Setter for key property.
     *
     * @param string $key AmoCrm API key
     *
     * @return AmoCrmApi
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
     * Prepare data before return it.
     *
     * @param json $data
     *
     * @return mixed
     */
    private function prepare($data)
    {
        //Returns array
        if ('array' == $this->format) {
            $result = is_array($data)
                ? $data
                : json_decode($data, 1);
            // If error exists, throw Exception
            if ($this->throwErrors and $result['errors']) {
                throw new \Exception(is_array($result['errors']) ? implode("\n", $result['errors']) : $result['errors']);
            }
            return $result;
        }
        // Returns json or xml document
        return $data;
    }

    /**
     * Make request to Amocrm API.
     *
     * @param string $model  Model name
     * @param string $method Method name
     * @param array  $params Required params
     */
    private function request($model, $method, $params = null)
    {
        // Get required URL
        $url = 'https://' . $this->getSubdomain() . '.amocrm.ru/api/v2/leads';;

        $data = array(
            'apiKey' => $this->key,
            'modelName' => $model,
            'calledMethod' => $method,
            'language' => $this->language,
            'methodProperties' => $params,
        );
        // Convert data to neccessary format
        $post = 'xml' == $this->format
            ? $this->array2xml($data)
            : $post = json_encode($data);

        if ('curl' == $this->getConnectionType()) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: '.('xml' == $this->format ? 'text/xml' : 'application/json')));
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $result = curl_exec($ch);
            curl_close($ch);
        } else {
            $result = file_get_contents($url, null, stream_context_create(array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-type: application/x-www-form-urlencoded;\r\n",
                    'content' => $post,
                ),
            )));
        }

        return $this->prepare($result);
    }



}