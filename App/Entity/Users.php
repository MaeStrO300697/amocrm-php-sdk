<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.06.2020
 * Time: 10:09
 */

namespace maestro300697\amocrmSdk\Entity;


class Users implements IEntity
{

    /**
     * @var int $id
     */
    private $id;


    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var boolean $is_admin
     */
    private $is_admin;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function getIsAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * @param bool $is_admin
     */
    public function setIsAdmin(bool $is_admin)
    {
        $this->is_admin = $is_admin;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
          'id' => $this->id
        ];
    }
}
