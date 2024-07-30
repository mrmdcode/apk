<?php

namespace App\Services;

use Mosquitto\Exception;
use PhpMqtt\Client\Facades\MQTT;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Exceptions\MqttClientException;

class MqttServicePub
{
    protected $client;

    public function __construct()
    {


        try {
            $this->client = MQTT::connection();
        }
        catch (\Exception $e) {

            echo "Error connecting to MQTT broker: " . $e->getMessage();
        }


}

    public function publish($topic, $message)
    {
        try {
            $this->client->publish($topic, $message, MqttClient::QOS_AT_LEAST_ONCE);
//            $this->client->disconnect();
//            return true;
        }
        catch (\Exception $e) {
            echo "Error publishing to MQTT broker: " . $e->getMessage();
            }

    }
}
