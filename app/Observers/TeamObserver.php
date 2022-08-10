<?php

namespace App\Observers;

use App\Http\Integrations\Accounting\Requests\CreateCompanyRequest;
use App\Http\Integrations\Accounting\Requests\DeleteCompanyRequest;
use App\Http\Integrations\Accounting\Requests\UpdateCompanyRequest;
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
        $request = new CreateCompanyRequest();
        $request->setData(['name' => $team->name]);
        $response = $request->send()->json();

        $team->codat_company_id = $response['id'];
        $team->save();
    }

    public function updated(Team $team)
    {
        if ($team->codat_company_id) {
            $request = new UpdateCompanyRequest($team->codat_company_id);
            $request->setData(['name' => $team->name]);
            $request->send();
        } else {
            $this->created($team);
        }
    }

    public function deleted(Team $team)
    {
        $request = new DeleteCompanyRequest($team->codat_company_id);
        $request->send();

        $team->codat_company_id = null;
        $team->save();
    }
}
