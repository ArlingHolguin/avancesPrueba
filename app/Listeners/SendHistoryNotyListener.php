<?php

namespace App\Listeners;

use App\Events\HistoriaCreada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendHistoryNotyListener
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
     * @param  \App\Events\HistoriaCreada  $event
     * @return void
     */
    public function handle(HistoriaCreada $event)
    {
        //
    }
}
