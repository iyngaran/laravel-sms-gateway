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
 * SmsGatewayInterface The abstract class for SMSGateway
 *
 * @category SmsGatewayInterface
 * @package  Iyngaran_SmsGateway
 * @author   Iyathurai Iyngaran <dev@iyngaran.info>
 * @link     https://github.com/iyngaran/laravel-sms-gateway
 */
interface SmsGatewayInterface
{

    /**
     * The abstract function to send sms using provided  SMS API
     *
     * @param String $message The sms message
     * @param String $to      The recipient number
     *
     * @return mixed The response from API
     */
    public function send($message, $to);

    /**
     * The abstract function to get response from the API
     *
     * @return ResponseData The response object
     */
    public function getResponseData():ResponseData;
}
