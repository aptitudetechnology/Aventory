<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_names_can_be_updated()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $response = $this->put('/teams/' . $user->currentTeam->id, [
            'name' => 'Test Team',
            'email' => 'test@test.com',
        ]);

        $this->assertCount(1, $user->fresh()->ownedTeams);
        $this->assertEquals('Test Team', $user->currentTeam->fresh()->name);
    }
}
