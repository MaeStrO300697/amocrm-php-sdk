<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 27.05.2020
 * Time: 16:30
 */

namespace maestro300697\amocrmSdk\EntitiesService;

use maestro300697\amocrmSdk\Entity\IEntity;

interface IEntityService
{
    public function getById(int $id);
    public function create(IEntity $lead);
    public function update(IEntity $lead);
    public function list($query,$limit);
    public function getEntity();
    public function getLink();
}
