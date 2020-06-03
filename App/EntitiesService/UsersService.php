<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.06.2020
 * Time: 10:13
 */

namespace maestro300697\amocrmSdk\EntitiesService;


use maestro300697\amocrmSdk\Entity\ListEntity;
use maestro300697\amocrmSdk\Entity\Users;

class UsersService extends BaseEntityService
{

    /**
     * @var string
     */
    protected $link = '/users';

    /**
     * @var
     */
    protected $lead;

    protected static $entity = 'users';

    public function query($query, $limit)
    {
        // TODO: Implement list() method.
        $this->listEntity = null;
        $this->link = $this->link . '?limit=500';
        $response = json_decode($this->queryGenerator->request('search', $this)->getBody()->getContents(), 1);
        $users = $response['_embedded']['users'];
        $listEntity = new ListEntity();
        foreach ($users as $user){
            $objUser = new Users();
            foreach ($user as $key => $value) {
                switch ($key) {
                case 'id': {
                    $objUser->setId($value);
                    break;
}
                case 'name': {
                    $objUser->setName($value);
                    break;
}
                case 'email': {
                    $objUser->setEmail($value);
                    break;
}
                case 'rights': {
                    $objUser->setIsAdmin($value['is_admin']);
                    break;
}
                }
            }
            $listEntity->add($objUser);
            unset($user);
        }
        return $listEntity;
    }
    /**
     * @param int $id
     */
    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

    /**
     */
    public function update()
    {
        // TODO: Implement update() method.
    }
}
