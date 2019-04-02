# Laravel SMS gateway

[![Latest Stable Version](https://poser.pugx.org/iyngaran/sms-gateway/v/stable)](https://packagist.org/packages/iyngaran/sms-gateway)
[![Total Downloads](https://poser.pugx.org/iyngaran/sms-gateway/downloads)](https://packagist.org/packages/iyngaran/sms-gateway)
[![Latest Unstable Version](https://poser.pugx.org/iyngaran/sms-gateway/v/unstable)](https://packagist.org/packages/iyngaran/sms-gateway)
[![License](https://poser.pugx.org/iyngaran/sms-gateway/license)](https://packagist.org/packages/iyngaran/sms-gateway)

It is a Laravel package which will serve as gateway to send SMS through various providers. It supports multiple sms gateways, and easily extendable to support new gateways.

## INSTALLING

`composer require iyngaran/sms-gateway`

After install follow one of these steps:

1) Run the command `php artisan vendor:publish` to publish the extension. It will also copy the `sms_gateway.php` 
into the config folder of your laravel application.

2) If the `sms_gateway.php` file does not exists in your application config folder, just copy the entire file and place 
into your `config/` folder.

Then add your `NEXMO_API_KEY,NEXMO_API_SECRET and NEXMO_SMS_FROM` Key. To get your API Key, [please visit](https://developer.nexmo.com/)

```php
// config/sms_gateway.php

return [
    'nexmo_sms_api_settings' => [
        'API_KEY' => env('NEXMO_API_KEY', ''),
        'API_SECRET' => env('NEXMO_API_SECRET', ''),
        'SEND_SMS_FROM' => env('NEXMO_SMS_FROM', 'IYNGARAN'),
    ],
    'twilio_sms_api_settings' => [
        'SID' => env('TWILIO_SID', ''),
        'TOKEN' => env('TWILIO_TOKEN', ''),
        'SEND_SMS_FROM' => env('TWILIO_SMS_FROM', '+12012926824'),
    ],
    'message_bird_sms_api_settings' => [
        'API_KEY' => env('MESSAGE_BIRD_API_KEY', ''),
        'SEND_SMS_FROM' => env('MESSAGE_BIRD_SMS_FROM', '+12012926824'),
    ],
    'dialog_sms_api_settings' => [
         'API_KEY' => env('DIALOG_SMS_API_KEY', ''),
         'ENDPOINT' => env('DIALOG_SMS_ENDPOINT', ''),
         'SEND_SMS_FROM' => env('DIALOG_SMS_FROM', 'IYNGARAN'),
    ],
];
```

## USAGE

### NexmoSmsGateway - Example in a controller

```php
    $objSMS = new SmsGateway(new NexmoSmsGateway());
    $response = $objSMS->sendSms('+12012926822','Hello Nexmo');
```

### TwilioSmsGateway - Example in a controller

```php
    $objSMST = new SmsGateway(new TwilioSmsGateway());
    $response = $objSMST->sendSms('+12012926822','Hello Twilio');
```

### MessageBirdSmsGateway - Example in a controller

```php
    $objSMST = new SmsGateway(new MessageBirdSmsGateway());
    $response = $objSMST->sendSms('+12012926822','Hello MessageBird');
```

### DialogSmsGateway - Example in a controller

```php
    $objSMS = new SmsGateway(new DialogSmsGateway());
    $response = $objSMS->sendSms('+12012926822','Hello, from Dialog SMS');
```
## CONTRIBUTING

You can contribute with this module suggesting improvements, making tests and reporting bugs. Use [issues](https://github.com/iyngaran/sms-gateway/issues) for that.

## ERRORS 

Report errors opening [Issues](https://github.com/iyngaran/laravel-sms-gateway/issues).
