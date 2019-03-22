<?php
namespace Iyngaran\SmsGateway\UnitTests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class MessageBirdSmsGatewayTest extends TestCase
{

    /**
     * test the response data object
     */
    public function testSendSmsResponse()
    {
        $objMBGateWay = new \Iyngaran\SmsGateway\MessageBirdSmsGateway();
        $objSMST = new \Iyngaran\SmsGateway\SmsGateway($objMBGateWay);
        $response = $objSMST->sendSms('+94711840760', 'Hello Message Bird Sms Gateway');
        $this->assertInstanceOf(\MessageBird\Objects\Message::class, $response);
    }
}
