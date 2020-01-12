@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-3">
    <div class="w-full flex justify-between items-center">
        <h3 class="text-grey tracking-wide">My Project</h3>
        <a href="/projects/create" class="btn-blue">New Project</a>
    </div>
</header>

<main class="lg:flex lg:flex-wrap -mx-3">
    @forelse ($projects as $project)
    <div class="lg:w-1/3 px-3 pb-6">
        <div class="bg-white p-5 rounded-lg shadow" style="height:200px;">
            <h3 class="font-font-normal text-xl mb-4 py-4 -ml-5 border-l-4 border-blue-light pl-4">
                <a href="{{ $project->path() }}">{{ $project->title }}</a>
            </h3>

            <div class="text-grey">{{ \Str::limit($project->description, 100) }}</div>
        </div>

    </div>
    @empty
    <div>No Problem yet</div>
    @endforelse
</main>

@endsection