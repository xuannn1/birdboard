<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Project;
use App\User;
use Facades\Tests\Setup\ProjectFactory;

class ManageProjectsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function guests_cannot_manage_project()
    {
        $project = factory(Project::class)->create();

        // guests_cannot_create_projectk
        $this->post('/projects', $project->toArray())->assertRedirect('/login');
        // guests_cannot_view_create_project_page
        $this->get('/projects/create')->assertRedirect('/login');
        // guests_cannot_update_a_project
        $this->get($project->path() . '/edit')->assertRedirect('/login');
        // guests_cannot_view_project
        $this->get('/projects')->assertRedirect('/login');
        // guests_cannot_view_a_single_project
        $this->get($project->path())->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $user = $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = factory(Project::class)->raw(['owner_id' => $user->id]);

        $response = $this->post('/projects', $attributes);
        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function tasks_can_be_included_when_create_a_project()
    {
        $user = $this->signIn();

        $attributes = factory(Project::class)->raw(['owner_id' => $user->id]);
        $attributes['tasks'] = [
            ['body' => 'Task 1', 'owner_id' => $user->id],
            ['body' => 'Task 2', 'owner_id' => $user->id],
        ];

        $this->post('/projects', $attributes);

        $this->assertCount(2, Project::first()->tasks);
    }

    /** @test */
    public function unauthorized_users_cannot_delete_a_project()
    {
        $project = ProjectFactory::create();

        // 未登陆用户不能删除project
        $this->delete($project->path())
            ->assertRedirect('/login');

        // 不是project的创建者不能删除project
        $user = $this->signIn();
        $this->delete($project->path())->assertStatus(403);

        // 即使是被邀请进这个project的用户也不行
        $project->invite($user);
        $this->actingAs($user)->delete($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_user_can_delete_a_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
                'title' => 'changed',
                'description' => 'changed',
                'notes' => 'changed'
            ])
            ->assertRedirect($project->path());

        $this->get($project->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_update_a_project_general_notes()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
                'notes' => 'changed'
            ]);

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_user_can_see_all_projects_they_have_been_invited_to_on_their_dashboard()
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();

        $project = ProjectFactory::create();

        $project->invite($user);

        $this->get('/projects')->assertSee($project->title);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();
        // $this->withoutExceptionHandling();
        $project = factory(Project::class)->create();
        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_the_projects_of_others()
    {
        $this->signIn();
        $project = factory(Project::class)->create();
        $this->patch($project->path(), [])->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->signIn();
        $attributes = factory(Project::class)->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn();
        $attributes = factory(Project::class)->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
