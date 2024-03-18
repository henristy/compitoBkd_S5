


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Project Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card dark:bg-gray-800 bg-gray-700">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 text-white">
                            Name : {{ $project->name }}
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
                <div class="card-body dark:bg-gray-900 bg-gray-800 ">
                    <div class="card-text text-white-50">
                        <p>Start date: {{ $project->start_date }}</p>
                        <p>Deadline: {{ $project->end_date }}</p>
                        <p>Status: {{ $project->status }}</p>
                        <p class="card-text text-white-50 mt-3 ">Description:</p>
                        <p class="card-text text-white-50 mb-3 ">  {{ $project->description }}</p>
                    </div>

                
                    <h2 class="my-4 text-white text-center">Tasks this project has been assigned. <a href="{{ route('activities.create') }}" class="btn btn-sm btn-outline-light">Add a new task</a> </h2>

                    <table class="table bg-transparent text-white dark:text-gray-800 table-white">
                        <thead>
                            <tr>
                                <th scope="col"><i class="bi bi-clipboard-check"></i></th>
                                <th scope="col"><i class="bi bi-card-text"></i></th>
                                <th scope="col"><i class="bi bi-clock-history"></i></th>
                                <th scope="col"><i class="bi b"></i> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($addActivity) 
                                <tr>
                                    <form action=" {{ route('activities.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        <td>
                                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Task name..." required autofocus />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </td>
                                        <td>
                                            <textarea placeholder="Task description..." id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="2"></textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </td>
                                        <td>
                                            <select name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            <option selected value="to do">To do</option>
                                            <option value="active">Active</option>
                                            <option value="completed">Completed</option>
                                            </select>
                                        </td>
                                        <td><button type="submit" class="btn btn-outline-success">Add Task</button> <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary">Cancel</a></td>
                                        
                                    </form>
                                </tr>
                            @endif
                            @if ($project->activities->count() > 0)
                                @foreach ($project->activities as $activity)
                                    @if ($modActivityId && $modActivityId === $activity->id)
                                        <tr>
                                            <form action="{{ route('activities.update', $activity) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <td>
                                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $activity->name)" required autofocus />
                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                </td>
                                                <td>
                                                    <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="2">{{ $activity->description }}</textarea>
                                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                                </td>
                                                <td>
                                                    <select name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" >
                                                    <option selected value="{{  $activity->status }}">{{  $activity->status }}</option>
                                                    <option value="to do">To do</option>
                                                    <option value="active">Active</option>
                                                    <option value="completed">Completed</option>
                                                    </select>
                                                </td>
                                                <td><button type="submit" class="btn btn-outline-primary">Update</button> <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary">Cancel</td>
                                            </form>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $activity->name }}</td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ $activity->status  }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('activities.edit', $activity) }}" class="btn btn-sm btn-outline-light"><i class="bi bi-pencil-fill  text-light"></i></a>
                                                <form action="{{ route('activities.destroy', $activity) }}" method="POST" class="d-inline"> 
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light"><i class="bi bi-trash-fill text-light"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else 
                                <tr>
                                    <td colspan="4" class="text-center">No tasks found. Add one to this project.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <small class="text-muted">Last updated: {{ $project->updated_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


