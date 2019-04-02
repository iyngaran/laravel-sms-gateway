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

use Twilio\Rest\Client;
/**
 * TwilioSmsGateway The class to send sms using Twilio API
 *
 * @category TwilioSmsGateway
 * @package  Iyngaran_SmsGateway
 * @author   Iyathurai Iyngaran <dev@iyngaran.info>
 * @link     https://github.com/iyngaran/laravel-sms-gateway
 */
class TwilioSmsGateway implements SmsGatewayInterface
{
    protected $client;

    protected $message_from;

    private $_response;

    /**
     * The class constructor
     */
    public function __construct()
    {
        $TWILIO_SID   = config('sms_gateway.twilio_sms_api_settings.SID');
        $TWILIO_TOKEN   = config('sms_gateway.twilio_sms_api_settings.TOKEN');
        $this->message_from = config('sms_gateway.twilio_sms_api_settings.SEND_SMS_FROM');
        $this->client = new Client($TWILIO_SID, $TWILIO_TOKEN);
    }

    /**
     * The function to send sms using Twilio API
     *
     * @param String $smsTo      The recipient number
     * @param String $message The sms message
     *
     * @return mixed The response from API
     */
    public function send($smsTo,$message)
    {
        $this->_response = $this->client->messages
            ->create($smsTo, // to
                array("from" => $this->message_from, "body" => $message)
            );

        return $this->_response;
    }

    /**
     * The function to get response from Twilio API
     *
     * @return ResponseData
     */
    public function getResponseData():ResponseData
    {
        $objResponseData = new ResponseData();
        if (isset($this->_response)) {
            $objResponseData->setStatus($this->_response->status);
            $objResponseData->setMessagePrice($this->_response->price);
            $objResponseData->setMessageId($this->_response->sid);
        }
        return $objResponseData;
    }


}
