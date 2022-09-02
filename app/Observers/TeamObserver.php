<?php

namespace App\Observers;

use App\Models\Team;
use App\Services\CodatCompaniesService;

class TeamObserver
{
    public function __construct(
        public CodatCompaniesService $codatCompaniesService
    ) {
    }

    /**
     * When a Team is created, dispatch jobs.
     *
     * @param  Team  $team
     */
    public function created(Team $team)
    {
        $response = $this->codatCompaniesService->create(['name' => $team->name]);
        $team->codat_company_id = $response['id'];
        $team->saveQuietly();
    }

    public function updated(Team $team)
    {
        if ($team->codat_company_id) {
            $this->codatCompaniesService->update($team->codat_company_id, ['name' => $team->name]);
        } else {
            $response = $this->codatCompaniesService->create(['name' => $team->name]);
            $team->codat_company_id = $response['id'];
            $team->saveQuietly();
        }
    }

    public function deleted(Team $team)
    {
        if ($team->codat_company_id) {
            $this->codatCompaniesService->delete($team->codat_company_id);

            $team->codat_company_id = null;
            $team->saveQuietly();
        }
    }
}
