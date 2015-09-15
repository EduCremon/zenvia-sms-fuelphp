<?php

/**
 * Classe responsavel por manipular envio de mensagem simples para o gateway
 *
 * @author Fábio
 * @since 09/01/2013
 * @version 1.0
 */
    class HumanSimpleSend extends HumanBaseService
{
    
    /**
     * Retorno do callback, retorno inativo
     * @var integer
     */
    const CALLBACK_INACTIVE            = 0;
    
    /**
     * Retorno do callback, somente retorno de status final da mensagem
     * @var integer
     */
    const CALLBACK_FINAL_STATUS        = 1;
    
    /**
     * Retorno do callback, retorno de status intermediário e final da mensagem
     * @var integer
     */
    const CALLBACK_INTERMEDIARY_STATUS = 2;
    
    /**
     *
     * @param string $account
     * @param string $password 
     */
    public function __construct($account, $password)
    {
        parent::__construct($account, $password);
        $this->setUri(parent::URI_SEND);
    }
        
    /**
     * Faz o envio da mensagem para o gateway através do método HTTP/POST .
     *
     * @param HumanSimpleMessage $message
     * @param integer $callbackOption (0, 1, 2)
     * @return HumanResponse
     */
    public function sendMessage($message, $callbackOption = self::CALLBACK_INACTIVE)
    {
        $params = array(
            "dispatch"       => "send",
            "account"        => $this->getAccount(),
            "code"           => $this->getPassword(),
            "callbackOption" => $callbackOption,
            "to" => $message->getTo(),
            "msg" => $message->getBody()            
        );
        
        if( $message->getFrom() != null && trim($message->getFrom())!= "" ){
            $params["from"] = $message->getFrom();
        }
        
        if( $message->getMsgId() != null && trim($message->getMsgId())!= "" ){
            $params["id"] = $message->getMsgId();
        }
        
        if( $message->getSchedule() != null && trim($message->getSchedule())!= "" ){
            $params["schedule"] = $message->getSchedule();
        }
        
        $responses = $this->send($params);
        return $responses[0];
    }
    
    public function queryStatus($id)
    {    	    	
    	$params = array(
            "dispatch"       => "check",
            "account"        => $this->getAccount(),
            "code"           => $this->getPassword(),
            "id"         => $id,
        );
        $responses = $this->query($params);
        return $responses[0];
    }
    
    
}