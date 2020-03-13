<?php


namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_project()
    {
        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks')->assertRedirect('/login');
    }

    /** @test */
    public function unauthenticated_user_cannot_add_tasks()
    {
        $this->signIn();
        $project = factory('App\Project')->create();

        // 非项目成员不能添加task
        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }
    /** @test */
    public function the_member_of_a_project_may_add_tasks()
    {
        $project = factory('App\Project')->create();

        // 项目的创建者可以添加task
        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test task']);
        $this->assertDatabaseHas('tasks', ['body' => 'Test task']);
        $this->get($project->path())->assertSee('Test task');

        // 受邀加入项目的用户，可以添加task
        $user2 = factory('App\User')->create();
        $project->invite($user2);
        $this->actingAs($user2)
            ->post($project->path() . '/tasks', ['body' => 'Test task again']);
        $this->assertDatabaseHas('tasks', ['body' => 'Test task again']);
        $this->get($project->path())->assertSee('Test task again');
    }

    /** @test */
    public function guest_cannot_update_update_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->patch($project->tasks[0]->path(), ['body' => 'changed'])
            ->assertRedirect('/login');
    }

    /** @test */
    public function unauthenticated_user_cannot_update_a_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks[0]->path(), ['body' => 'changed'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    /** @test */
    public function the_member_of_a_project_can_update_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $task = $project->tasks[0];

        // 项目的创建者可以修改task
        $this->actingAs($project->owner)
            ->patch($task->path(), ['body' => 'changed']);
        $this->assertDatabaseHas('tasks', ['body' => 'changed']);
        $this->get($project->path())->assertSee('changed');

        // 受邀加入项目的用户，可以修改task
        $user2 = factory('App\User')->create();
        $project->invite($user2);
        $this->actingAs($user2)
            ->patch($task->path(), ['body' => 'change again']);
        $this->assertDatabaseHas('tasks', ['body' => 'change again']);
        $this->get($project->path())->assertSee('change again');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'changed',
            ]);
        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
        ]);
    }

    /** @test */
    public function a_task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'changed',
                'completed' => true,
            ]);
        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true,
        ]);
    }

    /** @test */
    public function a_task_can_be_marked_as_incompleted()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'changed',
                'completed' => true,
            ]);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'changed',
            'completed' => false,
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false,
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::create();

        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function guest_cannot_delete_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->delete($project->tasks[0]->path())->assertRedirect('/login');
    }

    /** @test */
    public function unauthenticated_user_cannot_delete_a_task()
    {
        $this->signIn();
        $project = ProjectFactory::withTasks(1)->create();
        $this->delete($project->tasks[0]->path())->assertStatus(403);
    }

    /** @test */
    public function the_member_of_a_project_can_delete_a_task()
    {
        $project = ProjectFactory::withTasks(2)->create();
        $task1 = $project->tasks[0];
        $task2 = $project->tasks[1];

        // 项目的创建者可以删除task
        $this->actingAs($project->owner)
            ->delete($task1->path());
        $this->assertDatabaseMissing('tasks', ['id' => $task1->id]);

        $user2 = factory('App\User')->create();
        $project->invite($user2);
        $this->actingAs($user2)
            ->delete($task2->path());
        $this->assertDatabaseMissing('tasks', ['id' => $task2->id]);
    }

    /** @test */
    public function the_member_of_a_project_can_get_all_tasks()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(2)->create();
        $task1 = $project->tasks[0];
        $task2 = $project->tasks[1];

        // 项目的创建者可以删除task
        $this->actingAs($project->owner)
            ->get($project->path() . '/tasks')
            ->assertStatus(200);
    }
}
