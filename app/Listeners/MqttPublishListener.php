<?php

namespace App\Listeners;

use App\Events\MqttPublishEvent;
use App\Services\MqttServicePub;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MqttPublishListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MqttServicePub $mqttService)
    {
        $this->mqttService = $mqttService;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MqttPublishEvent  $event
     * @return void
     */
    public function handle(MqttPublishEvent $event)
    {
        $this->mqttService->publish($event->topic, $event->message);
    }
}
