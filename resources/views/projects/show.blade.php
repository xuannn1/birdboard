@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-3">
    <div class="w-full flex justify-between items-center">
        <h3 class="text-grey tracking-wide">
            <a href="/projects">My Projects</a> / {{ $project->title }}
        </h3>
        <a href="/projects/create" class="btn-blue">New Project</a>
    </div>
</header>
<main>
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3 mb-6">
            <div class="mb-8">
                <h3 class="text-lg text-grey tracking-wide mb-3">Tasks</h3>

                {{-- Tasks --}}
                @foreach ($project->tasks as $task)
                <div class="card mb-4">{{ $task->body }}</div>
                @endforeach
            </div>
            <div>
                <h3 class="text-lg text-grey tracking-wide mb-3">General Notes</h3>

                <textarea class="card w-full" style="min-height: 200px;">Lorem ipsum.</textarea>
            </div>
        </div>
        <div class="lg:w-1/4 px-3">
            @include('projects.card')
        </div>
    </div>
</main>
@endsection