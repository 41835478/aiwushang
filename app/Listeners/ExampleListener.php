<?php

namespace App\Listeners;

use App\Events\Example;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
