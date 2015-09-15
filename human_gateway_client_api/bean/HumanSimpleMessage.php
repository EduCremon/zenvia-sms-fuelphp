<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HumanSimpleMessage
 *
 * @author fabio.souza
 */
class HumanSimpleMessage {
    
    private $body;
    private $to;
    private $from;
    private $schedule;
    private $msgId;

    /**
     *
     * @param type $body
     * @param type $to
     * @param type $from
     * @param type $msgId
     * @param type $schedule 
     */
    public function __construct($body="", $to="", $from="", $msgId="", $schedule="") {
        $this->body = $body;
        $this->to = $to;
        $this->from = $from;
        $this->msgId = $msgId;
        $this->schedule = $schedule;
    }
    
    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getTo() {
        return $this->to;
    }

    public function setTo($to) {
        $this->to = $to;
    }

    public function getFrom() {
        return $this->from;
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    public function getMsgId() {
        return $this->msgId;
    }

    public function setMsgId($msgId) {
        $this->msgId = $msgId;
    }

    public function getSchedule() {
        return $this->schedule;
    }

    public function setSchedule($schedule) {
        $this->schedule = $schedule;
    }    

}

?>
