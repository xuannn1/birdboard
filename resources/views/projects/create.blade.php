@extends('layouts.app')

@section('content')
<h1>Create a Project</h1>

<form action="/projects" method="POST">
    @csrf
    <div class="field">
        <label for="title" class="label">Title</label>
        <div class="control">
            <input type="text" class="input" name="title" placeholder="Title">
        </div>
    </div>

    <div class="field">
        <label for="description" class="label">Description</label>
        <div class="control">
            <textarea name="description" class="textarea"></textarea>
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button type="submit" class="button">Create Project</button>
            <a href="/projects">Cancel</a>
        </div>
    </div>
</form>
@endsection