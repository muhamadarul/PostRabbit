<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\PublishPostToRabbitMQ;

class SendPostToRabbitMQ
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        PublishPostToRabbitMQ::dispatch($event->post)
            ->onQueue('post-created'); // kirim ke queue RabbitMQ
    }
}
