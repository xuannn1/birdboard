<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_projects()
    {
        $user = factory('App\User')->create();
        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    public function a_user_has_accessible_projects()
    {
        $user1 = $this->signIn();
        ProjectFactory::ownedBy($user1)->create();

        $this->assertCount(1, $user1->accessibleProjects());

        // user2新建了一个项目，并且邀请user1加入
        // 因而user1应该能看到2个项目
        $user2 = factory(User::class)->create();
        $project = ProjectFactory::ownedBy($user2)->create();
        $project->invite($user1);

        $this->assertCount(2, $user1->accessibleProjects());

        // 仅仅创建user3这个用户，他应该什么项目都看不到
        // 被邀请之后，能够看到1个项目
        $user3 = factory(User::class)->create();
        $this->assertCount(0, $user3->accessibleProjects());

        $project->invite($user3);
        $this->assertCount(1, $user3->accessibleProjects());
    }
}
