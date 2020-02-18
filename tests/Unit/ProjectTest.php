<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $project = factory('App\Project')->create();
        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $project = factory('App\Project')->create();
        $this->assertInstanceOf('App\User', $project->owner);
    }

    /** @test */
    public function it_can_add_a_task()
    {
        $project = factory('App\Project')->create();

        $task = $project->addTask('Test task');
        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }

    /** @test */
    public function it_can_add_multiple_tasks_when_create_a_project()
    {
        $project = factory('App\Project')->create();

        $tasks = $project->addTasks([['body' => 'Task 1'], ['body' => 'Task 2']]);

        $this->assertCount(2, $project->tasks);
        $this->assertTrue($project->tasks->contains($tasks[0]));
        $this->assertTrue($project->tasks->contains($tasks[1]));
    }

    /** @test */
    public function it_can_invite_a_user()
    {
        $project = factory('App\Project')->create();

        $project->invite($user = factory(User::class)->create());

        $this->assertTrue($project->members->contains($user));
    }
}
