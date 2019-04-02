<?php

namespace Iyngaran\SmsGateway\UnitTests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nexmo\Client;

class TwilioSmsGatewayTest extends TestCase
{

    /**
     * test the response data object
     */
    public function testSendSmsResponse()
    {
        $objTGateWay = new \Iyngaran\SmsGateway\TwilioSmsGateway();
        $objSMST = new \Iyngaran\SmsGateway\SmsGateway($objTGateWay);
        $objSMST->sendSms('+1711840760', 'Hello Twilio');
        $responseDataObject = $objSMST->getResponseData();
        $this->assertInstanceOf(\Iyngaran\SmsGateway\ResponseData::class, $responseDataObject);
    }
}
