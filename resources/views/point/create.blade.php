<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New point') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('point.store') }}" class="mt-6 space-y-6">
            @csrf
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="point" :value="__('Point')" />
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Set point") }}
                            </p>
                        <x-text-input id="point" name="point" type="number" class="mt-1 block w-full"/>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="user_id" :value="__('Students')" />
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Choose student") }}
                        </p>
                        <select id="user_id" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($students as $student)
                                <option type="text" value={{$student->id}}> {{$student->last_name . ' ' . $student->first_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="academic_discipline_id" :value="__('Academic discipline')" />
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Choose discipline") }}
                        </p>
                        <select id="academic_discipline_id" name="academic_discipline_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($disciplines as $discipline)
                                <option type="text" value={{$discipline->id}}>
                                     {{$discipline->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Create') }}</x-primary-button>
                        </div>
                    </div>
                 </div>

            </form>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                       <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" onclick="history.back()">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    
</x-app-layout>

    