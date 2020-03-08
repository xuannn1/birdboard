@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-3">
    <div class="w-full flex justify-between items-center">
        <h3 class="text-default tracking-wide">
            <a href="/projects">My Projects</a> / {{ $project->title }}
        </h3>

        <div>
            @foreach ($project->members as $member)
            <img src="{{ gravatar_url($member->email) }}"
                 alt="{{ $member->name }}'s avatar'"
                 class="inline rounded-full w-10 mr-2">
            @endforeach

            <img src="{{ gravatar_url($project->owner->email) }}"
                 alt="{{ $project->owner->name }}'s avatar'"
                 class="inline rounded-full w-10 mr-2">

            <a href="{{ $project->path() . '/edit' }}"
               class="btn-blue ml-6"
               id="edit-button"
               @click.prevent="$modal.show('project-edit')">Edit Project</a>
        </div>
    </div>
</header>
<main>
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3 mb-6">
            <div class="mb-8">
                <h3 class="text-lg text-default tracking-wide mb-3">Tasks</h3>

                {{-- Tasks --}}
                @foreach ($project->tasks as $task)
                <div class="card mb-4">
                    <form action="{{ $task->path() }}"
                          method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="flex items-center">
                            <input type="text"
                                   name="body"
                                   value="{{ $task->body }}"
                                   class="bg-card w-full p-2 rounded-lg {{$task->completed ? 'text-grey line-through' : ''}}">
                            <input name="completed"
                                   type="checkbox"
                                   class="ml-4"
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
                               class="bg-card text-default w-full p-2 rounded-lg"
                               name="body">
                    </form>
                </div>
            </div>
            <div>
                <h3 class="text-lg text-default tracking-wide mb-3">General Notes</h3>

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
                @include('errors')
            </div>
        </div>
        <div class="lg:w-1/4 px-3 pt-10">
            @include('projects.card')

            @include('projects.activity.card')

            @can('manage', $project)
            @include('projects.invite')
            @endcan
        </div>
    </div>

    <scroll-link href="#app"
                 when-hidden="#edit-button"
                 action="scroll"
                 class="fixed"
                 style="right: 1.5rem; bottom: 4rem;">
        <font-awesome-icon :icon="['fas', 'arrow-up']"
                           class="text-2xl"></font-awesome-icon>
    </scroll-link>

    <scroll-link href="#app"
                 when-hidden="#edit-button"
                 action="edit"
                 class="fixed"
                 style="right: 1.5rem; bottom: 7.5rem;">
        <font-awesome-icon :icon="['fas', 'pen']"
                           class="text-2xl"></font-awesome-icon>
    </scroll-link>

</main>

<project-edit></project-edit>

@endsection