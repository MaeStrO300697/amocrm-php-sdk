<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 01.06.2020
 * Time: 10:14
 */

namespace maestro300697\amocrmSdk\Entity;

/**
 * Class Contact
 *
 * @package maestro300697\amocrmSdk\Entity
 */

class Contact implements IEntity
{

    /**
     * @var $id int
     */
    private $id;

    /**
     * @var $name string
     */
    private $name;

    /**
     * @var $first_name string
     */
    private $first_name;

    /**
     * @var $last_name string
     */
    private $last_name;

    /**
     * @var $company_id int
     */
    private $company_id;

    /**
     * @var $responsible_user_id int
     */
    private $responsible_user_id;

    /**
     * @var $created_by
     */
    private $created_by;

    /**
     * @var $created_at
     */
    private $created_at;

    /**
     * @var $updated_by
     */
    private $updated_by;

    /**
     * @var $updated_at
     */
    private $updated_at;

    /**
     * @var $closest_task_at
     */
    private $closest_task_at;

    /**
     * @var $custom_fields_values
     */
    private $custom_fields_values;

    /**
     * @var $_embeddedTags
     */
    private $_embeddedTags;

    /**
     * @var $_embeddedCompanies
     */
    private $_embeddedCompanies;

    public function __construct($name)
    {
        $this->setName($name);
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        if(empty($name)) {
            throw new \InvalidArgumentException('Variable cannot be empty');
        }
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return int
     */
    public function getCompanyId(): int
    {
        return $this->company_id;
    }

    /**
     * @param int $company_id
     */
    public function setCompanyId(int $company_id)
    {
        $this->company_id = $company_id;
    }

    /**
     * @return int
     */
    public function getResponsibleUserId(): int
    {
        return $this->responsible_user_id;
    }

    /**
     * @param int $responsible_user_id
     */
    public function setResponsibleUserId(int $responsible_user_id)
    {
        $this->responsible_user_id = $responsible_user_id;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * @param mixed $created_by
     */
    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * @param mixed $updated_by
     */
    public function setUpdatedBy($updated_by)
    {
        $this->updated_by = $updated_by;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getClosestTaskAt()
    {
        return $this->closest_task_at;
    }

    /**
     * @param mixed $closest_task_at
     */
    public function setClosestTaskAt($closest_task_at)
    {
        $this->closest_task_at = $closest_task_at;
    }

    /**
     * @return mixed
     */
    public function getCustomFieldsValues()
    {
        return $this->custom_fields_values;
    }

    /**
     * @param mixed $custom_fields_values
     */
    public function setCustomFieldsValues($custom_fields_values)
    {
        $this->custom_fields_values = $custom_fields_values;
    }

    /**
     * @return mixed
     */
    public function getEmbeddedTags()
    {
        return $this->_embeddedTags;
    }

    /**
     * @param mixed $embeddedTags
     */
    public function setEmbeddedTags($embeddedTags)
    {
        $this->_embeddedTags = $embeddedTags;
    }

    /**
     * @return mixed
     */
    public function getEmbeddedCompanies()
    {
        return $this->_embeddedCompanies;
    }

    /**
     * @param mixed $embeddedCompanies
     */
    public function setEmbeddedCompanies($embeddedCompanies)
    {
        $this->_embeddedCompanies = $embeddedCompanies;
    }



    public function toArray(): array
    {
        $array = [
          'name' => $this->getName()
        ];
        isset($this->first_name) ? $array['first_name'] = $this->getFirstName() : false;
        isset($this->last_name) ? $array['last_name'] = $this->getLastName() : false;
        isset($this->created_at) ? $array['created_at'] = $this->getCreatedAt() : false;
        isset($this->updated_by) ? $array['updated_by'] = $this->getUpdatedBy() : false;
        isset($this->responsible_user_id) ? $array['responsible_user_id'] = $this->getResponsibleUserId() : false;
        isset($this->created_by) ? $array['created_by'] = $this->getCreatedBy() : false;
        isset($this->company_id) ? $array['company_id'] = $this->getCompanyId() : false;
        isset($this->custom_fields_values) ? $array['custom_fields_values'] = $this->getCustomFieldsValues() : false;
        isset($this->_embeddedTags) ? $array['_embedded']['tags'] = $this->getEmbeddedTags() : false;
        isset($this->_embeddedCompanies) ? $array['_embedded']['companies'] = $this->getEmbeddedCompanies() : false;

        return $array;
    }

}
