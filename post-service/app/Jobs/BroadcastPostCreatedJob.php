<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use VladimirYuldashev\LaravelQueueRabbitMQ\Middleware\RabbitMQMessage;

class BroadcastPostCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $title;
    protected string $body;

    public function __construct(string $title, string $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function handle(): void
    {
        \Log::info("Broadcast Post Created: {$this->title}");
    }

    public function middleware(): array
    {
        return [
            new RabbitMQMessage([
                'exchange' => 'broadcast_exchange', // exchange type fanout
                // routing_key tidak digunakan dalam fanout
            ]),
        ];
    }
}
