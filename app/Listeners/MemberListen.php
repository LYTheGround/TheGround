<?php

namespace App\Listeners;

use App\Member;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MemberListen
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
     * @param  Member  $event
     * @return void
     */
    public function handle(Member $event)
    {
        //
    }
}
