<?php

ini_set('display_errors', "on");
ini_set('error_reporting', E_ALL & ~E_NOTICE);
//ini_set('error_reporting', E_ALL);
include_once 'human_gateway_client_api/HumanClientMain.php';

$account = "conta";
$password="senha";
$sender = new HumanQueryMessage($account, $password);

 // Obtém o retorno da integração (código/mensagem)
$messages = $sender->listReceivedSMS();

echo "Mensagens recebidas ";
if(is_array($messages) && count($messages) > 0){
   foreach($messages as $message) {
        echo "\nMensagem ";
        //Id da mensagem recebida
        echo "\nId ".$message->getMsgId();
        //Remetente
        echo "\nRemetente ".$message->getFrom();
        //Conteúdo da mensagem
        echo "\nConteudo ".$message->getBody();
        //Data de recebimento da mensagem
        echo "\nData ".$message->getSchedule();
    }  
}
else{
    echo "Nenhuma mensagem recebida \n";
}

