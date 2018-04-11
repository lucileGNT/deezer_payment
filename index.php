<?php

// Index file

use Payment\Helper\NotificationHelper;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';

$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);
$loader = new \Twig_Loader_Filesystem(__DIR__.'/tpl/');
$twig = new \Twig_Environment($loader);
$result = "";

/* Form action management */
if ( isset($_POST["submit"])) {
    if (isset($_FILES["notificationsJSON"])) {
        $result .= NotificationHelper::processNotification($_FILES, $entityManager);
    } else {
        $result .= "No file selected <br />";
    }
}

// Generate twig view
echo $twig->render("index.html.twig", array('result' => $result));



