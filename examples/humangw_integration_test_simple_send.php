<?php

ini_set('display_errors', "on");
//ini_set('error_reporting', E_ALL & ~E_NOTICE);
ini_set('error_reporting', E_ALL);
include_once 'human_gateway_client_api/HumanClientMain.php';

$account = "account";
$password="password";

$body = "Este e um teste de envio de mensagem simples utilizando a plataforma Zenvia. ".date('d/m/Y H:i:s');
$to="5500112233445";
$msgId="0001";
$schedule=date("d/m/Y H:i:s", strtotime("+2 minutes"));
$callbackOption=  HumanSimpleSend::CALLBACK_INACTIVE;

$sender = new HumanSimpleSend($account, $password);
$message = new HumanSimpleMessage();
$message->setBody($body);
$message->setTo($to);
$message->setMsgId($msgId);
#$message->setSchedule($schedule);

$response = $sender->sendMessage($message, $callbackOption);
echo $response->getCode() . " - " . $response->getMessage() . "<br />";
