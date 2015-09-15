<?php

/**
 * Classe responsavel por realizar a consulta das mensagens no gateway
 *
 * @author Fábio
 * @since 09/01/2013
 * @version 1.0
 */
    class HumanQueryMessage extends HumanBaseService
{
        
    public function __construct($account, $password)
    {
        parent::__construct($account, $password);
        $this->setUri(parent::URI_QUERY);
    }
       
    /**
    * Busca por mensagens recebidas(MO) no gateway.
    * @return array de mensagens recebidas(MO). Caso nenhuma mensagem 
    * seja encontrada sera retornada um array vazio.  
    */
    public function listReceivedSMS()
    {    	    	
    	$params = array(
            "dispatch"       => "listReceived",
            "account"        => $this->getAccount(),
            "code"           => $this->getPassword(),
        );      
        
    	$responses = HumanConnectionHelper::requestAndGetMessages($this->getHost(), $this->getUri()
                , $params, self::CONTENT_TYPE_APP_FORM_URLENCODED);
        return $responses;
    }
    
    
}