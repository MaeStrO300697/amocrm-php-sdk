<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.05.2020
 * Time: 12:07
 */

namespace maestro300697\amocrmSdk\Leads;

class Lead
{
    /**
     * Название сделки
     *
     * @var string
     */
    public $name;
/**
     * Дата создания текущей сделки
     *
     * @var
     */
    public $created_at;
/**
     * @var
     */
    public $status_id;
// Дата изменения текущей сделки
    /**
     * @var
     */
    public $sale;
// Бюджет сделки
    /**
     * @var
     */
    public $responsible_user_id;
//ID ответственного пользователя
    /**
     * @var
     */
    public $tags;
/**
     * @var
     */
    public $contacts_id;
//Уникальный идентификатор контакта, для связи с сделкой.
    /**
     * @var
     */
    public $custom_fields; // Внутри данного массива находится содержимое каждого заполненного дополнительного поля
}
