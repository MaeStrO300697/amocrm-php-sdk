<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.05.2020
 * Time: 11:34
 */

namespace maestro300697\amocrmSdk\EntitiesService;

use maestro300697\amocrmSdk\Entity\Contact;
use maestro300697\amocrmSdk\Entity\ListEntity;

class ContactService extends BaseEntityService
{

    /**
     * @var string
     */
    protected $link = '/contacts';

    /**
     * @var string
     */
    protected static $entity = 'contacts';

    /**
     *
     */
    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * @param  $query
     * @param  int $limit
     * @return ListEntity
     */
    public function query($query, $limit = 500) : ListEntity
    {
        // TODO: Implement list() method.
        $this->listEntity = null;
        $this->link = $this->link . '?limit=500';
        $response = json_decode($this->queryGenerator->request('search', $this)->getBody()->getContents(), 1);
        $contacts = $response['_embedded']['contacts'];
        $listEntity = new ListEntity();
        foreach ($contacts as $contactItem){
            $contact = new Contact('создан');
            foreach ($contactItem as $key => $value){
                switch ($key){
                case 'id':{
                    $contact->setId($value);
                    break;
}
                case 'name':{
                    $contact->setName($value);
                    break;
}
                case 'first_name':{
                    $contact->setFirstName($value);
                    break;
}
                case 'last_name':{
                    $contact->setLastName($value);
                    break;
}
                case 'created_at':{
                    $contact->setCreatedAt($value);
                    break;
}
                case 'updated_by':{
                    $contact->setUpdatedBy($value);
                    break;
}
                case 'responsible_user_id':{
                    $contact->setResponsibleUserId($value);
                    break;
}
                case 'created_by':{
                    $contact->setCreatedAt($value);
                    break;
}
                case 'company_id':{
                    $contact->setCompanyId($value);
                    break;
}
                case 'custom_fields_values':{
                    /*var_dump($value);
                    foreach ($value as $key => $item){
                        $value[$key] = (array)$item;
                        foreach ($item as $k => $v){
                            if ($k == "values"){
                                foreach ($v as $j => $x){
                                    $v[$j] = array($x);
                                }
                            }
                        }
                    }*/
                    $contact->setCustomFieldsValues($value);
                    break;
}
                case '_embedded':{
                    //
}
                }
            }
            $listEntity->add($contact);
            unset($contact);
        }
        return $listEntity;
    }


    /**
     * @param int $id
     */
    public function getById(int $id)
    {
        // TODO: Implement getById() method.
        //
    }

    /**
     * @param $field
     * @param $value
     */
    public function getContactByField($field, $value)
    {

    }

    /**
     * @param  string|int $phone
     * @return null|Contact
     */
    public function getContactByPhone($phone)
    {
        $contacts = $this->getEntity()->getList();
        foreach ($contacts as $contact){
            $customField = $contact->getCustomFieldsValues();
            if(!empty($customField)) {
                foreach ($customField as $k => $cf) {
                    foreach ($cf as $key => $value) {
                        if ($value == "PHONE") {
                            foreach ($cf['values'] as $val) {
                                foreach ($val as $keyVal => $valX) {
                                    if ($valX == $phone) {
                                        return $contact;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return null;
    }

    /**
     * @param  string $email
     * @return null|Contact
     */
    public function getContactByEmail($email)
    {
        $contacts = $this->getEntity()->getList();
        foreach ($contacts as $contact){
            $customField = $contact->getCustomFieldsValues();
            if(!empty($customField)) {
                foreach ($customField as $k => $cf) {
                    foreach ($cf as $key => $value) {
                        if ($value == "Email") {
                            foreach ($cf['values'] as $val) {
                                foreach ($val as $keyVal => $valX) {
                                    if ($valX == $email) {
                                        return $contact;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return null;
    }

    public function list($query, $limit)
    {
        // TODO: Implement list() method.
    }
}
