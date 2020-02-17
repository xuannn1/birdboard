<div class="card mt-3"
     style="height:200px;">
    <h3 class="font-font-normal text-xl mb-4 py-4 -ml-5 border-l-4 border-blue-light pl-4">
        Invite a User
    </h3>

    <form method="POST"
          action="{{ $project->path() . '/invitations' }}">
        @csrf
        <div class="mb-3">
            <input type="email"
                   name="email"
                   placeholder="Email Address"
                   class="border border-gray-400 rounded w-full py-2 px-3">
        </div>
        <button type="submit"
                class="btn-blue">Invite</button>
    </form>
    @include('errors', ['bag' => 'invitations'])
</div>
</div>