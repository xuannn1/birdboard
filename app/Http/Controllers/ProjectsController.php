<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        // 获取所有的project，将最近更新的放前面
        $projects = auth()->user()->accessibleProjects();
        return view('projects.index', compact(['projects']));
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact(['project']));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        // 数据验证
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'
        ]);
        // 存储到数据库中
        $project = auth()->user()->projects()->create($attributes);
        // 创建成功后进行重定向
        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $attributes = request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'min:3'
        ]);

        $project->update($attributes);
        return redirect($project->path());
    }

    public function destroy(Project $project)
    {
        $this->authorize('manage', $project);

        $project->delete();
        return redirect('/projects');
    }
}
