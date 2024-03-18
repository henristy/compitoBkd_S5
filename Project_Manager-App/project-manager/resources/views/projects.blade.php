

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($message)
            <div class="alert alert-{{ $message['type'] }} max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $message['text'] }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-flex justify-content-between">
                <h1 class="text-center fs-1 fw-bolder text-white">All your projects are shown here</h1>
                <a href="{{ route('projects.create') }}" class="btn btn-success">Create Project</a>
            </div>

        @if ($projects->count() > 0)
            @foreach ($projects as $project)
                <div class="card dark:bg-gray-800 hover:bg-gray-700 my-5 border-0 shadow-lg rounded-lg hover:shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">
                            <a href="{{ route('projects.show', ['project' => $project->id]) }}" class="text-white hover:underline hover:cursor-pointer" style="text-decoration: none;">{{ $project->name }} </a>
                            
                            <x-status-pill :status="$project->status" class="float-right"/>
                            </h5>
                        </div>
                        <div class="btn-group" role="group" aria-label="Card Actions">
                            <a href="{{ route('projects.edit', ['project' => $project->id]) }}" class="btn btn-outline-light"><i class="bi bi-pencil-fill text-light"></i></a>

                            <form action="{{ route('projects.destroy', ['project' => $project->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light"><i class="bi bi-trash-fill text-light"></i></button>
                            </form>
                            

                        </div>
                    </div>
                    <div class="card-body dark:bg-gray-900">
                        <p class="card-text text-white-50 mb-3">{{ $project->description }}</p>
                        
                        <x-progress-bar start="{{ $project->start_date }}" end="{{ $project->end_date }}" />
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <small class="text-muted">Last updated: {{ $project->updated_at->diffForHumans() }}</small>
                    </div>
                </div>

                
            @endforeach
        @else 
            <div class="alert alert-info max-w-7xl mx-auto sm:px-6 lg:px-8 my-5">
                <p >No projects found.</p>
            </div>
        @endif
        </div>
    </div>
</x-app-layout>
