<div class="mt-6 page-card">
    <div class="flex items-baseline px-4 mb-4">
        <div class="relative z-10 my-4 mt-8">
            <h5 class="relative z-20 pl-4 pr-4 py-2 inline-block font-bold bg-magenta-700 text-white shadow">
                Publications
            </h5>
        </div>
        <a class="ml-auto btn btn-magenta is-sm shadow-inset" 
            href="{{ route('scholars.profile.publication.store')}}">
            New    
        </a>
    </div>
    <div class="mt-4 px-6 items-center flex flex-wrap">
        @foreach ($publications as $publication)
            @include('scholars.partials.academic_details_index', [
                'paper' => $publication
            ])
            <div class="ml-auto flex">
                <a href="{{ route('scholars.profile.publication.edit', $publication) }}" 
                    class="p-1 text-gray-500 text-blue-600 hover:bg-gray-200 rounded mr-3" title="Edit">
                    <feather-icon name="edit-3" stroke-width="2.5" class="h-current">Edit</feather-icon>
                </a>
                <form method="POST" action="{{ route('scholars.profile.publication.destroy', $publication->id) }}"
                    onsubmit="return confirm('Do you really want to delete this publication?');">
                    @csrf_token
                    @method('DELETE')
                    <button type="submit" class="p-1 hover:bg-gray-200 text-red-700 rounded">
                        <feather-icon name="trash-2" stroke-width="2.5" class="h-current">Delete</feather-icon>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>