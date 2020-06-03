<?php
/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 01.06.2020
 * Time: 14:16
 */

include_once '../vendor/autoload.php';

$client = new \maestro300697\amocrmSdk\Client('jack.royal2020256@gmail.com','jackroyal2020256','cd14a4a4bc47a07ac5053df58c5301cf9d68243c');
echo '<pre>';

$generator = new \maestro300697\amocrmSdk\QueryGenerator();
$contactService = new \maestro300697\amocrmSdk\EntitiesService\ContactService($client,$generator);

$listContacts = $contactService->query('');
$contactService->setListEntity($listContacts);
//Поиск по номеру телефона
//$contactSearch = $contactService->getContactByPhone('0636745556');
$contactSearch = $contactService->getContactByEmail('artem2gmail.com');
var_dump($contactSearch);