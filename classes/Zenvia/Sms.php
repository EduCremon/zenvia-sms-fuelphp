<?php
namespace Zenvia;
#include_once '../../human_gateway_client_api/HumanClientMain.php';
#include_once 'HUMAN_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'human_gateway_client_api' );
if (!defined('HUMAN_ROOT')) {
    define('HUMAN_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'human_gateway_client_api' );
    require(HUMAN_ROOT . DIRECTORY_SEPARATOR . 'util' . DIRECTORY_SEPARATOR . 'HumanAutoloader.php');
    \HumanAutoloader::register();
}

/**
 *
 */
class Sms {

    private static $instance;
    private $zenvia;

    private function __construct() {
        \Config::load('zenvia', true);
        if (empty(\Config::get('zenvia.credentials'))) {
            throw new Exception('credentials must be set in config');
        }
        $this->fromNumber = \Config::get('directcall.credentials.fromNumber');
        $this->zenvia = new \HumanSimpleSend(\Config::get('zenvia.credentials.clientId'), \Config::get('zenvia.credentials.clientSecret'));
    }

    /**
     *
     * @return Zenvia\Sms
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     */
    public function sendSMS($msgId, $toNumber, $msg) {
	$message = new \HumanSimpleMessage();
	$message->setBody($msg);
	$message->setTo($toNumber);
	$message->setMsgId(sprintf('%04d',$msgId));
	#$message->setSchedule($schedule);
	$this->lastResponse = $this->zenvia->sendMessage($message, \HumanSimpleSend::CALLBACK_INACTIVE);
	return $this;
    }

    /**
     *
     */
    public function getLastResponseCode() {
	return $this->lastResponse->getCode();
	}

    /**
     *
     */
    public function getLastResponseMessage() {
	return $this->lastResponse->getMessage();
	}

    /**
     *
     */
    public function getStatus($msgId) {
	$this->lastResponse = $this->zenvia->queryStatus(sprintf('%04d',$msgId));
	return $this;
    }

}
