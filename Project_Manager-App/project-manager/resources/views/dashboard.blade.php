<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Welcome back, {{ Auth::user()->name }}! Pick up right where you left off. 
                    <a href="{{ route('projects.index') }}" class="text-warning">View projects</a>
                    or <a href="{{ route('projects.create') }}" class="text-primary">create a new project</a>.
                </div>
            </div>
        </div>
    </div>

    <
    
</x-app-layout>
