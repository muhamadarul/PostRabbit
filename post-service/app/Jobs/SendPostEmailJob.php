<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use VladimirYuldashev\LaravelQueueRabbitMQ\Middleware\RabbitMQMessage;

class SendPostEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $title;
    protected string $body;
    protected string $email;

    public function __construct(string $title, string $body, string $email)
    {
        $this->title = $title;
        $this->body = $body;
        $this->email = $email;
    }

    public function handle(): void
    {
        // contoh simulasi pengiriman email
        \Log::info("Sending email to {$this->email}: {$this->title}");
    }

    public function middleware(): array
    {
        return [
            new RabbitMQMessage([
                'exchange' => 'post_topic',
                'routing_key' => 'post.created',
            ]),
        ];
    }
}
