<?php

/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 02.06.2020
 * Time: 17:22
 */

include_once '../vendor/autoload.php';


$client = new \maestro300697\amocrmSdk\Client('jack.royal2020256@gmail.com','jackroyal2020256','cd14a4a4bc47a07ac5053df58c5301cf9d68243c');
echo '<pre>';

$generator = new \maestro300697\amocrmSdk\QueryGenerator();
$leadService = new \maestro300697\amocrmSdk\EntitiesService\LeadService($client,$generator);

$listLead = $leadService->query('',500);
$leadService->setListEntity($listLead);
$userLeads = $leadService->filterLeadsByUser();

$usersService = new \maestro300697\amocrmSdk\EntitiesService\UsersService($client,$generator);
/**
 * $var ListEntity $userList
 * Список пользователей
 */
$userList = $usersService->query('',500);

//Проверка наличия всех пользователей и отсутствие администратора
foreach ($userList->getList() as $user){
    $status = null;
    foreach ($userLeads as $key => $value){
        if($user->getId() == $value['id']) {
            $status = true;
            if($user->getIsAdmin() === true){
                unset($userLeads[$key]);
            }else{
                $userLeads[$key]['is_admin'] = $user->getIsAdmin();
            }
        }
    }
    if(!isset($status)){
        if($user->getIsAdmin() === false) {
            $userLeads[$user->getId()] = [
                'id' => $user->getId(),
                'leads' => null,
                'countLeads' => 0,
                'countLeadsToday' => 0,
                'is_admin' => $user->getIsAdmin()
            ];
        }
    }
}
var_dump($userLeads);
//Поиск по номеру телефона
//$contactSearch = $contactService->getContactByPhone('0636745556');
//$contactSearch = $leadService->getContactByEmail('artem2gmail.com');