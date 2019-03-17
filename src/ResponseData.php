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
 * ResponseData The class to get response in a common format from SMS APIs
 *
 * @category ResponseData
 * @package  Iyngaran_SmsGateway
 * @author   Iyathurai Iyngaran <dev@iyngaran.info>
 * @link     https://github.com/iyngaran/laravel-sms-gateway
 */
class ResponseData
{
    private $_messageId;
    private $_status;
    private $_messagePrice;

    /**
     * @return mixed
     */
    public function getMessageId()
    {
        return $this->_messageId;
    }

    /**
     * @param mixed $messageId
     */
    public function setMessageId($messageId): void
    {
        $this->_messageId = $messageId;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->_status = $status;
    }

    /**
     * @return mixed
     */
    public function getMessagePrice()
    {
        return $this->_messagePrice;
    }

    /**
     * @param mixed $messagePrice
     */
    public function setMessagePrice($messagePrice): void
    {
        $this->_messagePrice = $messagePrice;
    }

    
}
