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

/**
 * NexmoSmsGateway The class to send sms using Nexmo API
 *
 * @category NexmoSmsGateway
 * @package  Iyngaran_SmsGateway
 * @author   Iyathurai Iyngaran <dev@iyngaran.info>
 * @link     https://github.com/iyngaran/laravel-sms-gateway
 */
class NexmoSmsGateway implements SmsGatewayInterface
{
    protected $client;

    protected $message_from;

    private $_response;

    /**
     * The class constructor
     */
    public function __construct()
    {
        $NEXMO_API_KEY   = config('sms_gateway.nexmo_sms_api_settings.API_KEY');
        $NEXMO_API_SECRET   = config('sms_gateway.nexmo_sms_api_settings.API_SECRET');
        $this->message_from = config('sms_gateway.nexmo_sms_api_settings.SEND_SMS_FROM');

        $basic  = new \Nexmo\Client\Credentials\Basic($NEXMO_API_KEY, $NEXMO_API_SECRET);
        $this->client = new \Nexmo\Client($basic);
    }

    /**
     * The function to send sms using Nexmo API
     *
     * @param String $smsTo      The recipient number
     * @param String $message The sms message
     *
     * @return mixed The response from API
     */
    public function send($smsTo,$message)
    {
        $this->_response = $this->client->message()->send(
            [
            'to' => $smsTo,
            'from' => $this->message_from,
            'text' => $message
            ]
        );

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
            $objResponseData->setStatus($this->_response['status']);
            $objResponseData->setMessagePrice($this->_response['message-price']);
            $objResponseData->setMessageId($this->_response['message-id']);
        }
        return $objResponseData;
    }


}
