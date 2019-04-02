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
 * DialogSmsGateway The class to send sms using Dialog (Sri Lanka) API
 *
 * @category DialogSmsGateway
 * @package  Iyngaran_SmsGateway
 * @author   Iyathurai Iyngaran <dev@iyngaran.info>
 * @link     https://github.com/iyngaran/laravel-sms-gateway
 */
class DialogSmsGateway implements SmsGatewayInterface
{
    protected $client;

    protected $message_from;

    private $_response;

    /**
     * @var string the sms API key
     */
    private $_dialog_sms_api_key;

    /**
     * @var string the sms api end point
     */
    private $_dialog_sms_api_endpoint;
    /**
     * The class constructor
     */
    public function __construct()
    {
        $this->_dialog_sms_api_key   = config('sms_gateway.dialog_sms_api_settings.API_KEY');
        $this->_dialog_sms_api_endpoint   = config('sms_gateway.dialog_sms_api_settings.ENDPOINT');
        $this->message_from = config('sms_gateway.dialog_sms_api_settings.SEND_SMS_FROM');
    }

    /**
     * The function to send sms using Dialog API
     *
     * @param String $smsTo   The recipient number
     * @param String $message The sms message
     *
     * @return mixed The response from API
     */
    public function send($smsTo,$message)
    {
        $message = urlencode($message);
        $sms_message_post_url = "{$this->_dialog_sms_api_endpoint}?destination={$smsTo}".
                                "&q={$this->_dialog_sms_api_key}&message={$message}&from={$this->message_from}";

        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array(
            $curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $sms_message_post_url,
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT']
            )
        );
        // Send the request & save response to $resp
        $this->_response = curl_exec($curl);
        curl_close($curl);

        return $this->_response;
    }

    /**
     * The function to get response from Dialog API
     *
     * @return ResponseData
     */
    public function getResponseData():ResponseData
    {
        $objResponseData = new ResponseData();
        if ($this->_response == 0) {
            $objResponseData->setStatus(1);
            $objResponseData->setMessagePrice(null);
            $objResponseData->setMessageId(null);
        }
        return $objResponseData;
    }


}
