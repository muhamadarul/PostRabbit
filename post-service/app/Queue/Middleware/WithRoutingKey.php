<?php

namespace App\Queue\Middleware;

use VladimirYuldashev\LaravelQueueRabbitMQ\Middleware\RabbitMQMessage;

class WithRoutingKey
{
    public static function set($key)
    {
        return new RabbitMQMessage([
            'routing_key' => $key,
        ]);
    }
}
