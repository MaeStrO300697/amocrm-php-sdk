<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 27.05.2020
 * Time: 16:30
 */

namespace maestro300697\amocrmSdk;


interface IEntityAmoCrm
{
    public function create(array $data);
    public function update(array $data);
    public function list();
}
