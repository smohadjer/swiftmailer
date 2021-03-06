<?php
require_once 'vendor/autoload.php';

// create a config.json with following data
/*
{
    "username": "username",
    "password": "password",
    "email": "email address"
}
*/

// get username and password for email from config file
$data = file_get_contents('config.json');
$json = json_decode($data);

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.fastmail.com', 587))
  ->setUsername($json->username)
  ->setPassword($json->password)
  ->setEncryption('tls')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['john@doe.com' => 'John Doe'])
  ->setTo([$json->email])
  ->setBody('Here is the message itself')
  ;

// Send the message
$result = $mailer->send($message);
