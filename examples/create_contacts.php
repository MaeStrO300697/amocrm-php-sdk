<?php

/**
 * Created by PhpStorm.
 * User: maestro300697
 * Date: 01.06.2020
 * Time: 10:51
 */

include_once '../vendor/autoload.php';
echo "<pre>";
$client = new \maestro300697\amocrmSdk\Client('jack.royal2020256@gmail.com','jackroyal2020256','cd14a4a4bc47a07ac5053df58c5301cf9d68243c');
$contact = new \maestro300697\amocrmSdk\Entity\Contact('Первый контакт');
$contact->setFirstName('Олег');
$contact->setLastName('Липовенко');
$contact->setCustomFieldsValues([
    [
        'field_id' => 149699,
        'values' => [
            [
                'value' => "380934567895"
            ]
        ]
    ],
    [
        'field_id' => 149701,
        'values' => [
            [
                'value' => "artem.kar1291235@gmail.com"
            ]
        ]
    ]
]);
$listContact = new \maestro300697\amocrmSdk\Entity\ListEntity();
$listContact->add($contact);

$generator = new \maestro300697\amocrmSdk\QueryGenerator();
$contactService = new \maestro300697\amocrmSdk\EntitiesService\ContactService($client,$generator);
$contactService->setListEntity($listContact);
$response = $contactService->create()->getBody()->getContents();
var_dump($response);