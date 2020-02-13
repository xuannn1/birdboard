@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-3">
    <div class="w-full flex justify-between items-center">
        <h3 class="text-grey tracking-wide">
            <a href="/projects">My Projects</a> / {{ $project->title }}
        </h3>
        <a href="{{ $project->path() . '/edit' }}"
           class="btn-blue">Edit Project</a>
    </div>
</header>
<main>
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3 mb-6">
            <div class="mb-8">
                <h3 class="text-lg text-grey tracking-wide mb-3">Tasks</h3>

                {{-- Tasks --}}
                @foreach ($project->tasks as $task)
                <div class="card mb-4">
                    <form action="{{ $task->path() }}"
                          method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="flex">
                            <input type="text"
                                   name="body"
                                   value="{{ $task->body }}"
                                   class="w-full {{$task->completed ? 'text-gray-500' : ''}}">
                            <input name="completed"
                                   type="checkbox"
                                   onchange="this.form.submit()"
                                   {{ $task->completed ? 'checked' : '' }}>
                        </div>
                    </form>
                </div>
                @endforeach
                <div class="card mb-4">
                    <form action="{{ $project->path() . '/tasks' }}"
                          method="POST">
                        @csrf
                        <input placeholder="Begin adding tasks..."
                               class="w-full"
                               name="body">
                    </form>
                </div>
            </div>
            <div>

                <form action="{{ $project->path() }}"
                      method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea name="notes"
                              class="card w-full mb-4"
                              style="min-height: 200px;"
                              placeholder="anything special that you want to make a note of?">{{ $project->notes }}</textarea>
                    <button type="submit"
                            class="btn-blue">Save</button>
                </form>
                @if ($errors->any())
                <div class="field mt-6">
                    @foreach ($errors->all() as $error)
                    <li class="text-sm text-red-500">{{ $error }}</li>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        <div class="lg:w-1/4 px-3">
            @include('projects.card')
        </div>
    </div>
</main>
@endsection