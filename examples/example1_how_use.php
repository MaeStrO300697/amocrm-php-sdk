<?php

/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 03.06.2020
 * Time: 14:30
 */

use maestro300697\amocrmSdk\Client;
use maestro300697\amocrmSdk\EntitiesService\ContactService;
use maestro300697\amocrmSdk\Entity\Contact;
use maestro300697\amocrmSdk\QueryGenerator;

include_once '../vendor/autoload.php';
echo "<pre>";
var_dump($_POST);
if (empty($_POST)) {
    exit;
}

/////Создание клиента для работы с AmoCRzm
$client = new Client('jack.royal2020256@gmail.com', 'jackroyal2020256', 'cd14a4a4bc47a07ac5053df58c5301cf9d68243c');
$generator = new QueryGenerator();

/// -------------------------------------------------------------------------------------------
/// Фильтрация сделок к пользывателю. Кол. сделок у пользователя и другая инфа
//Создание сервиса для работы со сделками привязав клиент и генератор запросов
$leadService = new \maestro300697\amocrmSdk\EntitiesService\LeadService($client, $generator);
///Запрос сделок
$listLead = $leadService->query('', 500);
$leadService->setListEntity($listLead);
///Фильтрация сделок в другой формат
$userLeads = $leadService->filterLeadsByUser();
///Создание сервиса для работы с пользователями
$usersService = new \maestro300697\amocrmSdk\EntitiesService\UsersService($client, $generator);
/**
 * $var ListEntity $userList
 *
 * Список пользователей
 */
////Получение всех пользователей
$userList = $usersService->query('', 500);

//Проверка наличия всех пользователей и удаление администраторов со списка администратора
/// Добавить отсутствущих пользователей
foreach ($userList->getList() as $user) {
    $status = null;
    foreach ($userLeads as $key => $value) {
        if ($user->getId() == $value['id']) {
            $status = true;
            if ($user->getIsAdmin() === true) {
                unset($userLeads[$key]);
            } else {
                $userLeads[$key]['is_admin'] = $user->getIsAdmin();
            }
        }
    }
    if (!isset($status)) {
        if ($user->getIsAdmin() === false) {
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

////Выбрать пользователя у кого меньше сделок за сегодня
$first = 0;
$minCountLeadsToday = 0;
$minLeadsTodayUser = [];

foreach ($userLeads as $user) {
    if ($first == 0) {
        $first++;
        $minCountLeadsToday = $user['countLeadsToday'];
        $minLeadsTodayUser = $user;
    } else {
        if ($user['countLeadsToday'] <= $minCountLeadsToday) {
            $minCountLeadsToday = $user['countLeadsToday'];
            $minLeadsTodayUser = $user;
        }
    }
}
//////////--------------------------------------------------------------------------------------------------

$contactService = new ContactService($client, $generator);

$listContacts = $contactService->query('');
$contactService->setListEntity($listContacts);

//Поиск по почте
$contactSearchByEmail = $contactService->getContactByEmail($_POST['email']);
//Поиск по номеру телефона
$contactSearchByPhone = $contactSearch = $contactService->getContactByPhone($_POST['phone']);



if (!empty($contactSearchByEmail) || !empty($contactSearchByPhone)) {
    //Поместить объект найденого контакта в $contact
    $contact = empty($contactSearchByEmail) ? $contactSearchByPhone : $contactSearchByEmail;

    $lead = new \maestro300697\amocrmSdk\Entity\Lead('Заявка с сайта', 1);
    $lead->setResponsibleUserId($minLeadsTodayUser['id']);
    $listLead = new \maestro300697\amocrmSdk\Entity\ListEntity();
    $listLead->add($lead);
    ////////
    $leadService->setListEntity($listLead);
    ///Создание сделки \\\ ответ в формате \Psr\Http\Message\ResponseInterface . Необходимо разобрать
    $responseCreateLead = $leadService->create();
    //Получить тело ответа. Преобразовать в ассоциативный массив
    $responseCreateLead = json_decode($responseCreateLead->getBody()->getContents(), 1);
    $lead->setId($responseCreateLead['_embedded']['leads'][0]['id']);
    //Связь между сделкой и контактом
    var_dump($leadService->link($lead, $contact)->getBody()->getContents());
} else {
    $leadService = new \maestro300697\amocrmSdk\EntitiesService\LeadService($client, $generator);
    $lead = new \maestro300697\amocrmSdk\Entity\Lead('Заявка с сайта', 1);
    $listLead = new \maestro300697\amocrmSdk\Entity\ListEntity();
    $listLead->add($lead);
    $lead->setResponsibleUserId($minLeadsTodayUser['id']);
////////
    $leadService->setListEntity($listLead);
///Создание сделки \\\ ответ в формате \Psr\Http\Message\ResponseInterface . Необходимо разобрать
    $responseCreateLead = $leadService->create();
//Получить тело ответа. Преобразовать в ассоциативный массив
    $responseCreateLead = json_decode($responseCreateLead->getBody()->getContents(), 1);
    $lead->setId($responseCreateLead['_embedded']['leads'][0]['id']);


//Создание контакта
    $contact = new Contact($_POST['username']);
    $contact->setCustomFieldsValues(
        [
            [
                'field_id' => 149699,
                'values' => [
                    [
                        'value' => $_POST['phone']
                    ]
                ]
            ],
            [
                'field_id' => 149701,
                'values' => [
                    [
                        'value' => $_POST['email']
                    ]
                ]
            ]
        ]);
    $listContacts = new \maestro300697\amocrmSdk\Entity\ListEntity();
    $listContacts->add($contact);

//Создание сервиса для работы с контактами привязав клиент и генератор запросов
    $contactService = new \maestro300697\amocrmSdk\EntitiesService\ContactService($client, $generator);
///Добавим объект $listLead ListEntity
    $contactService->setListEntity($listContacts);
    $responseCreateContact = $contactService->create();
//Получить тело ответа. Преобразовать в ассоциативный массив
    $responseCreateContact = json_decode($responseCreateContact->getBody()->getContents(), 1);
    $contact->setId($responseCreateContact['_embedded']['contacts'][0]['id']);
    //Связь между сделкой и контактом
    ///
    var_dump($leadService->link($lead, $contact)->getBody()->getContents());
}
exit;

//Заявка с сайта