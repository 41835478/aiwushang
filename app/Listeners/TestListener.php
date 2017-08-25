<?php

namespace App\Listeners;

use App\Events\Test;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class TestListener
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
     * @param  Test  $event
     * @return void
     */
    public function handle(Test $event)
    {
        $id = $event->id;
//        Log::info('保存文章到缓存成功！',['id'=>$event->id]);
    }
}
