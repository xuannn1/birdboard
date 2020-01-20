@csrf


<div class="field mb-6">
    <label for="title"
           class="label text-sm mb-2 block">Title</label>

    <div class="control">
        <input type="text"
               class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full"
               name="title"
               placeholder="Title"
               required
               value="{{ $project->title }}">
    </div>
</div>

<div class="field mb-6">
    <label for="description"
           class="label text-sm mb-2 block">Description</label>
    <div class="control">
        <textarea name="description"
                  class="textarea bg-transparent border border-grey-light rounded p-2 text-xs w-full"
                  placeholder="description"
                  required>
            {{ $project->description }}
        </textarea>
    </div>
</div>

<div class="field">
    <div class="control">
        <button type="submit"
                class="button btn-blue">{{ $buttonText }}</button>
        <a href="{{ $project->path() }}"
           class="px-2">Cancel</a>
    </div>
</div>

@if ($errors->any())
<div class="field mt-6">
    @foreach ($errors->all() as $error)
    <li class="text-sm text-red-500">{{ $error }}</li>
    @endforeach
</div>
@endif