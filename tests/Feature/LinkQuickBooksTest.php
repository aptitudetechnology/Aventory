<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LinkQuickBooksTest extends TestCase
{
    /**
     * Teams should be able to link to QuickBooks.
     *
     * @return void
     */
    public function test_teams_can_link_a_quickbooks_account()
    {
        $user = User::factory()->withPersonalTeam()->create();
        $team = $user->currentTeam;

        $response = $this->post('/teams/'.$team->id.'/link-quickbooks', [
            'company_id' => $team->id,
            'access_token' => 'abcdef',
            'realm_id' => 'ghijk',
            'refresh_token' => 'lmnop',
        ]);
    }
}
