<div class="card" style="height:200px;">
    <h3 class="font-font-normal text-xl mb-4 py-4 -ml-5 border-l-4 border-blue-light pl-4">
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>

    <div class="text-grey">{{ \Str::limit($project->description, 100) }}</div>
</div>