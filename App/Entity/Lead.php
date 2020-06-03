<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.05.2020
 * Time: 16:54
 */

namespace maestro300697\amocrmSdk\Entity;


/**
 * Class Lead
 *
 * @package maestro300697\amocrmSdk\Entity
 */
class Lead implements IEntity
{
    /**
     * Уникальный идентификатор списка
     *
     * @var $id integer
     */
    private $id;

    /**
     * Название сделки
     *
     * @var $name string
     */
    private $name;

    /**
     * Бюджет сделки
     *
     * @var $sale int
     */
    private $sale;

    /**
     * ID этапа цифровой воронки, на котором находится данная сделка
     *
     * @var $status_id int
     */
    private $status_id;

    /**
     * ID цифровой воронки, в которой находится сделка
     *
     * @var $pipeline_id int
     */
    private $pipeline_id;

    /**
     * ID аккаунта, в котором создана сделка
     *
     * @var $account_id int
     */
    private $account_id;

    /**
     * Ответственный сделки
     *
     * @var $responsible_user_id int
     */
    private $responsible_user_id;

    /**
     * ID группы в которой состоит пользователь ответственный за данную сделку
     *
     * @var $group_id int
     */
    private $group_id;

    /**
     * ID причины отказа
     *
     * @var $loss_reason_id int
     */
    private $loss_reason_id;

    /**
     * ID источника сделки
     *
     * @var $source_id int
     */
    private $source_id;

    /**
     * ID пользователя, создавшего сделку
     *
     * @var $created_by int
     */
    private $created_by;

    /**
     * Время и дата создания сделки
     *
     * @var $created_at int
     */
    private $created_at;

    /**
     * ID пользователя, обновившего параметры сделки
     *
     * @var $updated_by int
     */
    private $updated_by;

    /**
     * Время и дата когда была обновлена сделка
     *
     * @var $updated_at int
     */
    private $updated_at;

    /**
     * Время и дата, когда была завершена данная сделка
     *
     * @var $closed_at int
     */
    private $closed_at;

    /**
     * Время ближайшей задачи по данной сделке
     *
     * @var $closest_task_at int
     */
    private $closest_task_at;

    /**
     * Удалена сделка или нет. Удалённые сделки могут находиться в “удалённых”.
     *
     * @var $is_deleted bool
     */
    private $is_deleted;

    /**
     * Массив, содержащий информацию по дополнительным полям, заданным для данной сделки
     *
     * @var $custom_fields_values array
     */
    private $custom_fields_values = [];

    /**
     * Массив содержащий ссылку на текущий запрос
     *
     * @var $_links array
     */
    private $_links;

    /**
     * Массив вложенных сущностей для сделки, например, мы можем получить все теги и компании связанные со сделкой
     *
     * @var $_embedded array
     */
    private $_embedded;


    /**
     * Lead constructor.
     *
     * @param $name
     * @param $price
     * @param null $custom_fields_values
     * return $this
     */
    public function __construct($name, $sale, $custom_fields_values = null)
    {
        $this->setName($name);
        $this->setSale($sale);
        $this->custom_fields_values = $this->setCustomFieldsValues($custom_fields_values);

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
     * @return int
     */
    public function getSale(): int
    {
        return $this->sale;
    }

    /**
     * @param int $price
     */
    public function setSale(int $sale)
    {
        if($sale <= 0 && empty($price)) {
            throw new \InvalidArgumentException('Variable cannot be empty');
        }
        $this->sale = $sale;
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->status_id;
    }

    /**
     * @param int $status_id
     */
    public function setStatusId(int $status_id)
    {
        $this->status_id = $status_id;
    }

    /**
     * @return int
     */
    public function getPipelineId(): int
    {
        return $this->pipeline_id;
    }

    /**
     * @param int $pipeline_id
     */
    public function setPipelineId(int $pipeline_id)
    {
        $this->pipeline_id = $pipeline_id;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->account_id;
    }

    /**
     * @param int $account_id
     */
    public function setAccountId(int $account_id)
    {
        $this->account_id = $account_id;
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
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->group_id;
    }

    /**
     * @param int $group_id
     */
    public function setGroupId(int $group_id)
    {
        $this->group_id = $group_id;
    }

    /**
     * @return int
     */
    public function getLossReasonId(): int
    {
        return $this->loss_reason_id;
    }

    /**
     * @param int $loss_reason_id
     */
    public function setLossReasonId($loss_reason_id)
    {
        $this->loss_reason_id = $loss_reason_id;
    }

    /**
     * @return int
     */
    public function getSourceId(): int
    {
        return $this->source_id;
    }

    /**
     * @param int $source_id
     */
    public function setSourceId(int $source_id)
    {
        $this->source_id = $source_id;
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->created_by;
    }

    /**
     * @param int $created_by
     */
    public function setCreatedBy(int $created_by)
    {
        $this->created_by = $created_by;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    /**
     * @param int $created_at
     */
    public function setCreatedAt(int $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getUpdatedBy(): int
    {
        return $this->updated_by;
    }

    /**
     * @param int $updated_by
     */
    public function setUpdatedBy(int $updated_by)
    {
        $this->updated_by = $updated_by;
    }

    /**
     * @return int
     */
    public function getUpdatedAt(): int
    {
        return $this->updated_at;
    }

    /**
     * @param int $updated_at
     */
    public function setUpdatedAt(int $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return int
     */
    public function getClosedAt(): int
    {
        return $this->closed_at;
    }

    /**
     * @param int $closed_at
     */
    public function setClosedAt($closed_at)
    {
        $this->closed_at = $closed_at;
    }

    /**
     * @return int
     */
    public function getClosestTaskAt(): int
    {
        return $this->closest_task_at;
    }

    /**
     * @param int $closest_task_at
     */
    public function setClosestTaskAt($closest_task_at)
    {
        $this->closest_task_at = $closest_task_at;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->is_deleted;
    }

    /**
     * @param bool $is_deleted
     */
    public function setIsDeleted(bool $is_deleted)
    {
        $this->is_deleted = $is_deleted;
    }

    /**
     * @return array
     */
    public function getCustomFieldsValues(): array
    {
        return $this->custom_fields_values;
    }

    /**
     * @param array|null $custom_fields_values
     */
    public function setCustomFieldsValues($custom_fields_values)
    {
        $this->custom_fields_values = $custom_fields_values;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->_links;
    }

    /**
     * @param array $links
     */
    public function setLinks(array $links)
    {
        $this->_links = $links;
    }

    /**
     * @return array
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }

    /**
     * @param array $embedded
     */
    public function setEmbedded(array $embedded)
    {
        $this->_embedded = $embedded;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        $array =  [
            'name' => $this->getName(),
            'sale' => $this->getSale()
        ];
        isset($this->status_id) ? $array['status_id'] = $this->getStatusId() : false;
        isset($this->pipeline_id) ? $array['pipeline_id'] = $this->getPipelineId() : false;
        isset($this->created_by) ? $array['created_by'] = $this->getCreatedBy() : false;
        isset($this->updated_by) ? $array['updated_by'] = $this->getUpdatedBy() : false;
        isset($this->responsible_user_id) ? $array['responsible_user_id'] = $this->getResponsibleUserId() : false;
        isset($this->custom_fields_values) ? $array['custom_fields_values'] = $this->getCustomFieldsValues() : false;
        isset($this->_embedded) ? $array['_embedded'] = $this->getEmbedded() : false;

        return $array;
    }

}
