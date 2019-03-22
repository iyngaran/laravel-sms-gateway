<?php
/**
 * The Sms Gateway to send SMS through various providers.
 * It supports multiple sms gateways, and easily extendable to support new gateways.
 *
 * PHP version 7.1
 *
 * @category PHP/Laravel
 * @package  Iyngaran_SmsGateway
 * @author   Iyathurai Iyngaran <dev@iyngaran.info>
 * @link     https://github.com/iyngaran/laravel-sms-gateway
 */
namespace Iyngaran\SmsGateway;

use \MessageBird\Client;
use \MessageBird\Objects\Message;
/**
 * MessageBirdSmsGateway The class to send sms using MessageBird REST API
 *
 * @category MessageBirdSmsGateway
 * @package  Iyngaran_SmsGateway
 * @author   Iyathurai Iyngaran <dev@iyngaran.info>
 * @link     https://github.com/iyngaran/laravel-sms-gateway
 */
class MessageBirdSmsGateway implements SmsGatewayInterface
{
    protected $client;

    protected $message_from;

    private $_response;

    /**
     * The class constructor
     */
    public function __construct()
    {
        $MESSAGE_BIRD_API_KEY   = config('sms_gateway.message_bird_sms_api_settings.API_KEY');
        $this->message_from = config('sms_gateway.message_bird_sms_api_settings.SEND_SMS_FROM');

        $this->client = new Client($MESSAGE_BIRD_API_KEY);
    }

    /**
     * The function to send sms using MessageBird REST API
     *
     * @param String $to      The recipient number
     * @param String $message The sms message
     *
     * @return mixed The response from API
     */
    public function send($to,$message)
    {
        $messageObj = new Message();
        $messageObj->originator = $this->message_from;
        $messageObj->recipients = [$to];
        $messageObj->body = $message;
        $this->_response = $this->client->messages->create($messageObj);
        return $this->_response;
    }

    /**
     * The function to get response from Nexmo API
     *
     * @return ResponseData
     */
    public function getResponseData():ResponseData
    {
        $objResponseData = new ResponseData();
        if (isset($this->_response)) {

            if (isset($this->_response->recipients)) {

                if ($this->_response->recipients->totalCount>0) {
                    $objResponseData->setStatus('sent');
                    $objResponseData->setMessagePrice(null);
                    $objResponseData->setMessageId($this->_response->getId());
                }

            }

        }
        return $objResponseData;
    }


}
