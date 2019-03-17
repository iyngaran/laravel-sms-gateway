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

use Illuminate\Support\ServiceProvider;
use Config;

/**
 * SmsServiceProvider The service provider for SMS service
 *
 * @category SmsServiceProvider
 * @package  Iyngaran_SmsGateway
 * @author   Iyathurai Iyngaran <dev@iyngaran.info>
 * @link     https://github.com/iyngaran/laravel-sms-gateway
 */
class SmsServiceProvider extends ServiceProvider
{
    /**
     * The boot function
     *
     * @return void
     */
    public function boot()
    {

        if (!file_exists(base_path('config').'/sms_gateway.php')) {
            $this->publishes(
                [
                __DIR__.'/config/sms_gateway.php' => config_path('sms_gateway.php'),
                ]
            );
        }
    }



    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SmsGatewayInterface::class, NexmoSmsGateway::class);
    }
}
