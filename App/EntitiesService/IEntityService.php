<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 27.05.2020
 * Time: 16:30
 */

namespace maestro300697\amocrmSdk\EntitiesService;

interface IEntityService
{
    public function getById(int $id);
    public function create();
    public function update();
    public function query($query,$limit);
    public function getEntity();
    public function getLink();
}
