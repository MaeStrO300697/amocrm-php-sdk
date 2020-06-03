<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 26.05.2020
 * Time: 12:07
 */

namespace maestro300697\amocrmSdk\EntitiesService;



use maestro300697\amocrmSdk\Entity\IEntity;
use maestro300697\amocrmSdk\Entity\Lead;
use maestro300697\amocrmSdk\Entity\ListEntity;
use PHPUnit\Exception;

/**
 * Class LeadService
 * @package maestro300697\amocrmSdk\EntitiesService
 */
class LeadService extends BaseEntityService
{

    /**
     * @var string
     */
    protected $link = '/leads';

    /**
     * @var
     */
    protected $lead;

    protected static $entity = 'leads';


    public function update()
    {
        // TODO: Implement update() method.
    }


    public function list($query,$limit = 250)
    {
        // TODO: Implement list() method.
    }

    public function query($query, $limit){
        $this->listEntity = null;
        $this->link = $this->link . '?limit=500';
        try {
            $response = json_decode($this->queryGenerator->request('search', $this)->getBody()->getContents(), 1);
            $arrLeads = $response['_embedded']['leads'];
            $listEntity = new ListEntity();
            foreach ($arrLeads as $leadItem) {
                $objLead = new Lead('пустой', 1);
                foreach ($leadItem as $key => $value) {
                    switch ($key) {
                        case 'id': {
                            $objLead->setId($value);
                            break;
                        }
                        case 'name': {
                            $objLead->setName($value);
                            break;
                        }
                        case 'responsible_user_id': {
                            $objLead->setResponsibleUserId($value);
                            break;
                        }
                        case 'group_id': {
                            $objLead->setGroupId($value);
                            break;
                        }
                        case 'status_id': {
                            $objLead->setStatusId($value);
                            break;
                        }
                        case 'pipeline_id': {
                            $objLead->setPipelineId($value);
                            break;
                        }
                        case 'loss_reason_id': {
                            $objLead->setLossReasonId($value);
                            break;
                        }
                        case 'created_at': {
                            $objLead->setCreatedAt($value);
                            break;
                        }
                        case 'updated_by': {
                            $objLead->setUpdatedBy($value);
                            break;
                        }
                        case 'created_by': {
                            $objLead->setCreatedAt($value);
                            break;
                        }
                        case 'updated_at': {
                            $objLead->setUpdatedAt($value);
                            break;
                        }
                        case 'closed_at': {
                            $objLead->setClosedAt($value);
                            break;
                        }
                        case 'closest_task_at': {
                            $objLead->setClosestTaskAt($value);
                            break;
                        }
                        case 'is_deleted': {
                            $objLead->setClosestTaskAt($value);
                            break;
                        }
                        case 'account_id': {
                            $objLead->setAccountId($value);
                            break;
                        }
                        case 'custom_fields_values': {
                            $objLead->setCustomFieldsValues($value);
                            break;
                        }
                        case '_embedded': {
                            //
                        }
                        //closest_task_at
                    }
                }
                $listEntity->add($objLead);
                unset($objLead);
            }

            return $listEntity;
        }catch (Exception $e){
            return null;
        }

    }


    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

    public function link(Lead $lead, IEntity $entity){
        return $this->queryGenerator->link($lead, $entity,$this);
    }

    public function unlink(){

    }

    /**
     * @return mixed|null $users
     */
    public function filterLeadsByUser(){
        $users = [];
        ////Достаем список сделаок ввиде массива объктов Lead
        /// Производим сортировку привязывая сделки к пользывателю
        $listEntity =$this->listEntity->getList();
        if(!empty($listEntity)) {
            foreach ($listEntity as $value) {
                if (empty($users)) {
                    $users[$value->getResponsibleUserId()] = [
                        'id' => $value->getResponsibleUserId(),
                        'leads' => [$value],
                        'countLeads' => null,
                        'countLeadsToday' => 0,
                        'is_admin' => null,
                    ];
                } else {
                    if ($users[$value->getResponsibleUserId()]['id'] == $value->getResponsibleUserId()) {
                        $users[$value->getResponsibleUserId()]['leads'][] = $value;
                    } else {
                        $users[$value->getResponsibleUserId()] = [
                            'id' => $value->getResponsibleUserId(),
                            'leads' => [$value],
                            'countLeads' => null,
                            'countLeadsToday' => 0,
                            'is_admin' => null
                        ];
                    }
                }
            }
            foreach ($users as $keyUser => $user){
                $users[$keyUser]['countLeads'] = count($user['leads']);
                foreach ($user['leads'] as $key => $lead){
                    if(strtotime(date("d.m.Y",$lead->getCreatedAt())) == strtotime(date("d.m.Y",time()))){
                        $users[$keyUser]['countLeadsToday'] = ++$user['countLeadsToday'];
                    }
                }
            }
            return $users;
        }
        return null;
    }


}
