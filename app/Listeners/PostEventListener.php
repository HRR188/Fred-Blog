<?php

namespace App\Listeners;

use App\Events\postVisitCount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  postVisitCount  $event
     * @return void
     */
    public function handle(postVisitCount $event)
    {
        $post = $event->post;
        $post->increment('visit');
    }
}
