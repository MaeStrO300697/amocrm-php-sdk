<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.05.2020
 * Time: 19:32
 */

namespace maestro300697\amocrmSdk\Exceptions;

/**
 * Class AuthException
 * Ошибка авторизации AmoCRM
 *
 * @package maestro300697\amocrmSdk\Exceptions
 */
class AuthException extends \Exception
{
    /**
     * Код ошибки
     *
     * @var $error_code integer
     */
    private $error_code;

    /**
     * Название ошибки
     *
     * @var $error string
     */
    private $error;

    /**
     * AuthException constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        \Exception::__construct('Ошибка авторизации: ' . $response['response']['error']);
        $this->message = 'Ошибка авторизации: ' . $response['response']['error'];
        $this->error_code = $response['response']['error_code'];
        $this->error = $response['response']['error'];
    }

    /**
     * Возвращает код ошибки при авторизации
     * Справочник ошибок доступен по адресу
     *
     * @see    https://www.amocrm.ru/developers/content/api/errors
     * @return int $error_code
     */
    public function getErrorCode()
    {
        return $this->error_code;
    }
    /**
     * Возвращает название ошибки при авторизации
     * Справочник ошибок доступен по адресу
     *
     * @see    https://www.amocrm.ru/developers/content/api/errors
     * @return int $error_code
     */

    public function getError()
    {
        return $this->error;
    }

}
