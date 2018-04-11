<?php

use Payment\Entity\Status;
use Payment\Entity\StatusTransition;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);


echo "Loading Status table data...\n";

$status100 = new Status();
$status100->setId(Status::STATUS_AUTHORIZED);
$status100->setName('Authorized');
$status100->setDateToUpdate("dateAuthorized");
$entityManager->persist($status100);


$status200 = new Status();
$status200->setId(Status::STATUS_CAPTURED);
$status200->setName('Captured');
$status200->setDateToUpdate("dateCaptured");
$entityManager->persist($status200);


$status300 = new Status();
$status300->setId(Status::STATUS_SETTLED);
$status300->setName('Settled');
$status300->setDateToUpdate("dateSettled");
$entityManager->persist($status300);


$status600 = new Status();
$status600->setId(Status::STATUS_CANCELLED);
$status600->setName('Cancelled');
$status600->setDateToUpdate("dateUnpaid");
$entityManager->persist($status600);


$status700 = new Status();
$status700->setId(Status::STATUS_REFUNDED);
$status700->setName('Refunded');
$status700->setDateToUpdate("dateUnpaid");
$entityManager->persist($status700);

$status800 = new Status();
$status800->setId(Status::STATUS_CHARGEBACKED);
$status800->setName('Chargebacked');
$status800->setDateToUpdate("dateUnpaid");
$entityManager->persist($status800);

$status900 = new Status();
$status900->setId(Status::STATUS_ERROR);
$status900->setName('Error');
$status900->setDateToUpdate("");
$entityManager->persist($status900);

echo "Loading Status Transition table data...\n";
//Insert status transition table data

$transition100200 = new StatusTransition();
$transition100200->setFromStatus(Status::STATUS_AUTHORIZED);
$transition100200->setToStatus(Status::STATUS_CAPTURED);
$entityManager->persist($transition100200);

$transition100300 = new StatusTransition();
$transition100300->setFromStatus(Status::STATUS_AUTHORIZED);
$transition100300->setToStatus(Status::STATUS_SETTLED);
$entityManager->persist($transition100300);

$transition100600 = new StatusTransition();
$transition100600->setFromStatus(Status::STATUS_AUTHORIZED);
$transition100600->setToStatus(Status::STATUS_CANCELLED);
$entityManager->persist($transition100600);

$transition100900 = new StatusTransition();
$transition100900->setFromStatus(Status::STATUS_AUTHORIZED);
$transition100900->setToStatus(Status::STATUS_ERROR);
$entityManager->persist($transition100900);

$transition200300 = new StatusTransition();
$transition200300->setFromStatus(Status::STATUS_CAPTURED);
$transition200300->setToStatus(Status::STATUS_SETTLED);
$entityManager->persist($transition200300);

$transition200700 = new StatusTransition();
$transition200700->setFromStatus(Status::STATUS_CAPTURED);
$transition200700->setToStatus(Status::STATUS_REFUNDED);
$entityManager->persist($transition200700);

$transition200800 = new StatusTransition();
$transition200800->setFromStatus(Status::STATUS_CAPTURED);
$transition200800->setToStatus(Status::STATUS_CHARGEBACKED);
$entityManager->persist($transition200800);

$transition200900 = new StatusTransition();
$transition200900->setFromStatus(Status::STATUS_CAPTURED);
$transition200900->setToStatus(Status::STATUS_ERROR);
$entityManager->persist($transition200900);

$transition300700 = new StatusTransition();
$transition300700->setFromStatus(Status::STATUS_SETTLED);
$transition300700->setToStatus(Status::STATUS_REFUNDED);
$entityManager->persist($transition300700);

$transition300800 = new StatusTransition();
$transition300800->setFromStatus(Status::STATUS_SETTLED);
$transition300800->setToStatus(Status::STATUS_CHARGEBACKED);
$entityManager->persist($transition300800);

$transition300900 = new StatusTransition();
$transition300900->setFromStatus(Status::STATUS_SETTLED);
$transition300900->setToStatus(Status::STATUS_ERROR);
$entityManager->persist($transition300900);

$entityManager->flush();

echo "Datatable is ready to use!";