<div class="card"
     style="height:200px;">
    <h3 class="text-default font-font-normal text-xl mb-4 py-4 -ml-5 border-l-4 border-accent pl-4">
        <a href="{{ $project->path() }}"
           class="">{{ $project->title }}</a>
    </h3>

    <div class="text-default mb-6 flex-1">{{ \Str::limit($project->description, 300) }}</div>

    @can('manage', $project)
    <footer>
        <form method="POST"
              action="{{ $project->path() }}"
              class="text-right">
            @method('DELETE')
            @csrf
            <button type="submit"
                    class="btn-white">Delete</button>
        </form>
    </footer>
    @endcan
</div>