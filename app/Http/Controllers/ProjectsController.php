<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function store()
    {
        // 数据验证
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        // 存储到数据库中
        auth()->user()->projects()->create($attributes);
        // 创建成功后进行重定向
        return redirect('/projects');
    }

    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact(['projects']));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact(['project']));
    }
}
