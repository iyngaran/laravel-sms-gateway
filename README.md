# Laravel SMS gateway

[![Latest Stable Version](https://poser.pugx.org/iyngaran/sms-gateway/v/stable)](https://packagist.org/packages/iyngaran/sms-gateway)
[![Total Downloads](https://poser.pugx.org/iyngaran/sms-gateway/downloads)](https://packagist.org/packages/iyngaran/sms-gateway)
[![Latest Unstable Version](https://poser.pugx.org/iyngaran/sms-gateway/v/unstable)](https://packagist.org/packages/iyngaran/sms-gateway)
[![License](https://poser.pugx.org/iyngaran/sms-gateway/license)](https://packagist.org/packages/iyngaran/sms-gateway)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/1e699a1026bc410ba8282674af990d53)](https://www.codacy.com/app/iyngaran/laravel-sms-gateway?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=iyngaran/laravel-sms-gateway&amp;utm_campaign=Badge_Grade)

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

<a href="https://www.nexmo.com/" target="_blank">
<img src="https://www.nexmo.com/wp-content/uploads/2015/06/nexmo-logo-lg.jpg" height="70" title="Nexmo">
</a>

### Nexmo

Nexmo provides innovative communication SMS and Voice APIs that enable applications and enterprises to easily connect to their customers.

Website : [www.nexmo.com](https://www.nexmo.com/)

Developer Documentation: [developer.nexmo.com](https://developer.nexmo.com/)

To send sms using Nexmo API, you need to get the API KEY and API SECRET from Nexmo.

When initially subscribing to Nexmo 2 EUR free test credit is granted for testing your application.

#### Nexmo Configuration

Open the config file `config/sms_gateway.php` and add your `API KEY` and `API SECRET` to the following section of the configuration file.

```php
'nexmo_sms_api_settings' => [
        'API_KEY' => env('NEXMO_API_KEY', ''),
        'API_SECRET' => env('NEXMO_API_SECRET', ''),
        'SEND_SMS_FROM' => env('NEXMO_SMS_FROM', 'IYNGARAN'),
],
```

#### Sending SMS - Nexmo 

Use the following code to send SMS.

```php
    $objSMS = new SmsGateway(new NexmoSmsGateway());
    $response = $objSMS->sendSms('+12012926822','Hello Nexmo');
```

<a href="https://www.twilio.com/" target="_blank">
<img src="https://www.twilio.com/marketing/bundles/company/img/logos/red/twilio-logo-red.svg" height="70" title="Twilio">
</a>

### Twilio

Twilio allows software developers to programmatically make and receive phone calls, send and receive text messages, and perform other communication functions using its web service APIs.

Website : [twilio.com](https://www.twilio.com/)

Developer Documentation: [Twilio API](https://www.twilio.com/docs/api)

To send sms using Twilio API, you need to get the `SID` and `TOKEN` from Twilio.

When initially subscribing to Twilio $15.50 free test credit is granted for testing your application.

#### Twilio Configuration

Open the config file `config/sms_gateway.php` and add your `SID` and `TOKEN` to the following section of the configuration file.

```php
twilio_sms_api_settings' => [
        'SID' => env('TWILIO_SID', ''),
        'TOKEN' => env('TWILIO_TOKEN', ''),
        'SEND_SMS_FROM' => env('TWILIO_SMS_FROM', '+12012926824'),
]
```

#### Sending SMS - Twilio

Use the following code to send SMS.

```php
    $objSMST = new SmsGateway(new TwilioSmsGateway());
    $response = $objSMST->sendSms('+12012926822','Hello Twilio');
```

<a href="https://www.messagebird.com/en/" target="_blank">
<img src="https://www.messagebird.com/img/logo.svg" height="70" title="Dialog (Sri Lanka)">
</a>

### MessageBird

MessageBird is a powerful communication APIs and technical resources to help you build your communication solution.

Website : [messagebird.com](https://www.messagebird.com/en/)

Developer Documentation: [developers.messagebird.com](https://developers.messagebird.com/)

To send sms using MessageBird API, you need to get the `API KEY` from MessageBird.

When initially subscribing to MessageBird 10 free SMS credit is granted for testing your application on live.

#### MessageBird Configuration

Open the config file `config/sms_gateway.php` and add your `API_KEY` to the following section of the configuration file.

```php
'message_bird_sms_api_settings' => [
        'API_KEY' => env('MESSAGE_BIRD_API_KEY', ''),
        'SEND_SMS_FROM' => env('MESSAGE_BIRD_SMS_FROM', '+12012926824'),
 ]
```

#### Sending SMS - MessageBird

Use the following code to send SMS.

```php
    $objSMST = new SmsGateway(new MessageBirdSmsGateway());
    $response = $objSMST->sendSms('+12012926822','Hello MessageBird');
```

<a href="https://www.dialog.lk/" target="_blank">
<img src="https://www.dialog.lk/dialogdocroot/content/images/dialog_logo@2x.png" height="70" title="Dialog (Sri Lanka)">
</a>

### Dialog (Sri Lanka)

Dialog Axiata PLC has hence combined its innovativeness and technical superiority to bring out a solution that will enable you to tap into this opportunity by introducing Dialog Bulk SMS Solution which will enable you to communicate by SMS to a mass list of customers/staff through an easy to use web portal that can also be accessed from any location.

Website : [dialog.lk](https://www.dialog.lk/)

To send sms using Dialog SMS API, you need to get the `API KEY` from Dialog.


#### Dialog Configuration

Open the config file `config/sms_gateway.php` and add your `API_KEY` to the following section of the configuration file.

```php
'dialog_sms_api_settings' => [
        'API_KEY' => env('DIALOG_SMS_API_KEY', ''),
        'ENDPOINT' => env('DIALOG_SMS_ENDPOINT', ''),
        'SEND_SMS_FROM' => env('DIALOG_SMS_FROM', 'IYNGARAN'),
    ]
```

#### Sending SMS - Dialog

Use the following code to send SMS.

```php
    $objSMS = new SmsGateway(new DialogSmsGateway());
    $response = $objSMS->sendSms('+12012926822','Hello, from Dialog SMS');
```

## CONTRIBUTING

You can contribute with this module suggesting improvements, making tests and reporting bugs. Use [issues](https://github.com/iyngaran/sms-gateway/issues) for that.

## ERRORS 

Report errors opening [Issues](https://github.com/iyngaran/laravel-sms-gateway/issues).
