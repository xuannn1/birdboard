<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        // 获取所有的project，将最近更新的放前面
        $projects = auth()->user()->projects;
        return view('projects.index', compact(['projects']));
    }

    public function show(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }
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
        ]);
        // 存储到数据库中
        $project = auth()->user()->projects()->create($attributes);
        // 创建成功后进行重定向
        return redirect($project->path());
    }
}
