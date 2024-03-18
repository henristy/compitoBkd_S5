<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('projects.store') }}" class="row justify-content-between" method="POST">
                        @csrf
                        
                        <div class="col-7">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="col-5">
                            <x-input-label for="status" :value="__('Status')" />
                            <select class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"  name="status">
                                <option value="paused">Paused</option>
                                <option value="active">Active</option>
                                <option selected value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="col-5 mt-4">
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" min="{{ \Carbon\Carbon::now()->subYears(8)->format('Y-m-d') }}" max="{{ \Carbon\Carbon::now()->addYears(8)->format('Y-m-d') }}" />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div class="col-5 mt-4">
                            <x-input-label for="end_date" :value="__('Deadline')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date"  min="{{ \Carbon\Carbon::now()->subYears(8)->format('Y-m-d') }}" max="{{ \Carbon\Carbon::now()->addYears(8)->format('Y-m-d') }}"   />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea rows="6" cols="50"  id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        

                        <div class="flex items-center justify-end mt-4">
                            <button class="btn btn-success" type="submit">Create</button>
                            <a href="{{ route('projects.index') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Go back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

