<?php

namespace Iyngaran\SmsGateway\UnitTests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nexmo\Client;

class NexmoSmsGatewayTest extends TestCase
{

    /**
     * Test the send sms response status
     *
     * @return void
     */
    public function testSendSmsStatus()
    {

        $objGateWay = new \Iyngaran\SmsGateway\NexmoSmsGateway();
        $objSMS = new \Iyngaran\SmsGateway\SmsGateway($objGateWay);
        $response = $objSMS->sendSms('+1711122288', 'Hello');
        $responseStatus = $response['status'];
        $this->assertEquals(0, $responseStatus);

    }

    /**
     * test the sms price...
     */
    public function testSmsMessagePrice()
    {

        $objGateWay = new \Iyngaran\SmsGateway\NexmoSmsGateway();
        $objSMS = new \Iyngaran\SmsGateway\SmsGateway($objGateWay);
        $response = $objSMS->sendSms('+1711122288', 'Hello');
        $messagePrice = $response['message-price'];
        $this->assertEquals(0.05100000, $messagePrice);

    }

    /**
     * test the response data object
     */
    public function testSendSmsResponse()
    {
        $objGateWay = new \Iyngaran\SmsGateway\NexmoSmsGateway();
        $objSMS = new \Iyngaran\SmsGateway\SmsGateway($objGateWay);
        $objSMS->sendSms('+1711122288', 'Hello');
        $responseDataObject = $objSMS->getResponseData();
        $this->assertInstanceOf(\Iyngaran\SmsGateway\ResponseData::class, $responseDataObject);
    }
}
