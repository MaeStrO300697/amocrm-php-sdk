<?php

include_once 'vendor/autoload.php';

echo "<pre>";
$client = new \maestro300697\amocrmSdk\Client('jack.royal2020256@gmail.com','jackroyal2020256','cd14a4a4bc47a07ac5053df58c5301cf9d68243c');
$generator = new \maestro300697\amocrmSdk\QueryGenerator();

$lead = new \maestro300697\amocrmSdk\Entity\Lead('Первая сделка', 1000);

$leadService = new \maestro300697\amocrmSdk\EntitiesService\LeadService($client,$generator);
$leadService->create($lead);
echo "</pre>";
