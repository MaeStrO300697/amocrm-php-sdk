<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 02.06.2020
 * Time: 15:15
 */

include_once '../vendor/autoload.php';
///Создание клиента для работы с AmoCRzm
$client = new \maestro300697\amocrmSdk\Client('jack.royal2020256@gmail.com','jackroyal2020256','cd14a4a4bc47a07ac5053df58c5301cf9d68243c');
echo "<pre>";
///Сохдание сделаки
$lead = new \maestro300697\amocrmSdk\Entity\Lead('Первая сделка', 1000);
//Добавление сделки в listEntity
$listLead = new \maestro300697\amocrmSdk\Entity\ListEntity();
$listLead->add($lead);
//создание Генератора запросов
$generator = new \maestro300697\amocrmSdk\QueryGenerator();
//Создание сервиса для работы со сделками привязав клиент и генератор запросов
$leadService = new \maestro300697\amocrmSdk\EntitiesService\LeadService($client,$generator);
///Добавим объект $listLead ListEntity
$leadService->setListEntity($listLead);
///Создание сделки \\\ ответ в формате \Psr\Http\Message\ResponseInterface . Необходимо разобрать
$responseCreateLead = $leadService->create();
//Получить тело ответа. Преобразовать в ассоциативный массив
$responseCreateLead = json_decode($responseCreateLead->getBody()->getContents(),1);
$lead->setId($responseCreateLead['_embedded']['leads'][0]['id']);
//////////
///
///
///
/////////////
/// Создание контакта
$contact = new \maestro300697\amocrmSdk\Entity\Contact('Олег Липовенко');
$contact->setFirstName('Олег');
$contact->setLastName('Липовенко');

$listContacts = new \maestro300697\amocrmSdk\Entity\ListEntity();
$listContacts->add($contact);

//Создание сервиса для работы с контактами привязав клиент и генератор запросов
$contactService = new \maestro300697\amocrmSdk\EntitiesService\ContactService($client,$generator);
///Добавим объект $listLead ListEntity
$contactService->setListEntity($listContacts);
$responseCreateContact = $contactService->create();
//Получить тело ответа. Преобразовать в ассоциативный массив
$responseCreateContact = json_decode($responseCreateContact->getBody()->getContents(),1);
$contact->setId($responseCreateContact['_embedded']['contacts'][0]['id']);

//Связь между сделкой и контактом
var_dump($leadService->link($lead,$contact));
