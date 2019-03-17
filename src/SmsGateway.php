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
 * SmsGateway The factory class to provide SMS service
 *
 * @category SmsGateway
 * @package  Iyngaran_SmsGateway
 * @author   Iyathurai Iyngaran <dev@iyngaran.info>
 * @link     https://github.com/iyngaran/laravel-sms-gateway
 */
class SmsGateway
{
    protected  $smsGateway;

    /**
     * SmsGateway constructor.
     *
     * @param SmsGatewayInterface $smsGateway The SMS Gateway class
     */
    public function __construct(SmsGatewayInterface $smsGateway)
    {
        $this->smsGateway = $smsGateway;
    }

    /**
     * The function to send sms using provided  SMS API
     *
     * @param String $to      The recipient number
     * @param String $message The sms message
     *
     * @return mixed The response from API
     */
    public function sendSms($to,$message)
    {
        return $this->smsGateway->send($to, $message);
    }

    /**
     * The function to get response from the API
     *
     * @return ResponseData
     */
    public function getResponseData():ResponseData
    {
        return $this->smsGateway->getResponseData();
    }
}

