<?php

error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

$objet = 'token de sécurité pour la connexion au site de lépaule';
$message = "Votre token de sécurité est : ";
$headers = 'From: lepaule.ynov@gmail.com';


mail('paul.lautier@ynov.com',$objet,$message,$headers);
?>