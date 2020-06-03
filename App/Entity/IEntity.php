<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.05.2020
 * Time: 17:34
 */

namespace maestro300697\amocrmSdk\Entity;


/**
 * Interface IEntity
 *
 * @package maestro300697\amocrmSdk\Entity
 */
interface IEntity
{

    public function getId():int;
    /**
     * @return array
     */
    public function toArray() : array;
}
