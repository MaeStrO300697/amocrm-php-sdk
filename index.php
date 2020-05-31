<?php

include_once 'vendor/autoload.php';

echo "<pre>";
$client = new \maestro300697\amocrmSdk\Client('jack.royal2020256@gmail.com','jackroyal2020256','cd14a4a4bc47a07ac5053df58c5301cf9d68243c');

$lead = new \maestro300697\amocrmSdk\Entity\Lead('Первая сделка', 1000);
$listLead = new \maestro300697\amocrmSdk\Entity\ListEntity();
$listLead->add($lead);

$generator = new \maestro300697\amocrmSdk\QueryGenerator();
$leadService = new \maestro300697\amocrmSdk\EntitiesService\LeadService($listLead,$client,$generator);
var_dump($leadService->create()->getBody()->getContents());

echo "</pre>";
