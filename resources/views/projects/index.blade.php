@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-3">
    <div class="w-full flex justify-between items-center">
        <h3 class="text-default tracking-wide">My Project</h3>
        <a href="/projects/create"
           class="btn-blue"
           @click.prevent="$modal.show('new-project')">New Project</a>
    </div>
</header>

<main class="lg:flex lg:flex-wrap -mx-3">
    @forelse ($projects as $project)
    <div class="lg:w-1/3 px-3 pb-6">
        @include('projects.card')
    </div>
    @empty
    <div>No Project yet</div>
    @endforelse
</main>

<new-project></new-project>

@endsection