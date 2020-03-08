<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use Symfony\Component\Mime\RawMessage;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('update', $project);

        request()->validate(['body' => 'required']);

        $project->addTask([
            'body' => request('body'),
            'owner_id' => auth()->id()
        ]);

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        $this->authorize('update', $task->project);

        $attribute = request()->validate(['body' => 'required']);

        $task->update($attribute);

        request('completed') ? $task->complete() : $task->incomplete();

        return redirect($project->path());
    }

    public function destroy(Project $project, Task $task)
    {
        $this->authorize('update', $project);
        $task->delete();
    }
}
