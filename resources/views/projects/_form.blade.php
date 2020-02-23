@csrf


<div class="field mb-6">
    <label for="title"
           class="label mb-2 block">Title:</label>

    <div class="control">
        <input type="text"
               class="input bg-transparent border border-grey rounded-lg p-2 text-xs w-full"
               name="title"
               placeholder="Title"
               required
               value="{{ $project->title }}">
    </div>
</div>

<div class="field mb-6">
    <label for="description"
           class="label mb-2 block">Description:</label>
    <div class="control">
        <textarea name="description"
                  class="textarea bg-transparent border border-grey rounded-lg p-2 text-xs w-full"
                  placeholder="description"
                  required>
            {{ $project->description }}
        </textarea>
    </div>
</div>

<div class="flex">
    <div class="flex flex-1 justify-end">
        <button type="submit"
                class="btn-blue mr-4">{{ $buttonText }}</button>

    </div>
    <div class="flex flex-1">
        <a href="{{ $project->path() }}"
           class="btn-white">Cancel</a>

    </div>
</div>

@if ($errors->any())
<div class="field mt-6">
    @foreach ($errors->all() as $error)
    <li class="text-sm text-red">{{ $error }}</li>
    @endforeach
</div>
@endif