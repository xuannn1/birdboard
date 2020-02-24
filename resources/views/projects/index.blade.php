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

    <div id="bottom">111</div>

    <scroll-link href="#app"
                 class="fixed"
                 style="right: 1.5rem; bottom: 4rem;">
        <font-awesome-icon :icon="['fas', 'arrow-up']"
                           class="text-2xl"></font-awesome-icon>
    </scroll-link>

</main>

<new-project></new-project>

@endsection