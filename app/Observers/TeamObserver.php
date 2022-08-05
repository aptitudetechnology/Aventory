<?php

namespace App\Observers;

use App\Models\Team;

class TeamObserver
{
    /**
     * When a Team is created, dispatch jobs.
     *
     * @param  Team  $team
     */
    public function created(Team $team)
    {
    }
}
