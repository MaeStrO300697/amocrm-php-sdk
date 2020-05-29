<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 26.05.2020
 * Time: 12:07
 */

namespace maestro300697\amocrmSdk\Leads;


use maestro300697\amocrmSdk\IEntityAmoCrm;

class Lead implements IEntityAmoCrm
{
    public $type;

    protected $lead;

    protected $link = '/api/v4/leads';

    public function create(array $lead)
    {
        $this->lead = $lead;
        $this->type = 'add';
    }

    public function update(array $lead)
    {
        // TODO: Implement update() method.
    }

    public function list()
    {
        // TODO: Implement list() method.
    }


    public function getLead()
    {
        return $this->lead;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLink()
    {
        return $this->link;
    }
}
