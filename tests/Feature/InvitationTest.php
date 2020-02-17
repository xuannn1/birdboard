<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_owner_cannot_invite_users()
    {
        $project = ProjectFactory::create();
        $user = factory(User::class)->create();

        $this->actingAs($user)->post($project->path() . '/invitations')
            ->assertStatus(403);
    }

    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $user = factory(User::class)->create();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', [
            'email' => $user->email,
        ])->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($user));
    }

    /** @test */
    public function the_invited_email_address_must_be_associated_with_a_valid_birdboard_account()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', [
            'email' => 'foobar@test.com',
        ])->assertSessionHasErrors([
            'email' => 'The user you are inviting must have a birdboard account'
        ]);
    }

    /** @test */
    public function invited_users_can_update_project_details()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = factory(User::class)->create());

        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
