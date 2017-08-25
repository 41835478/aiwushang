<?php

namespace App\Listeners;

use App\Events\Example;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class ExampleListener
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
     * @param  Example  $event
     * @return void
     */
    public function handle(Example $event)
    {
        Log::info('测试',['id'=>$event->id]);
    }
}
