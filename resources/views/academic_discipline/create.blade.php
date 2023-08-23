<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New discipline') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('academic_discipline.store') }}" class="mt-6 space-y-6">
            @csrf
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="name" :value="__('Name')" />
                            <p class="mt-1 text-sm text-gray-600">{{ __("Min: 2 sybmol, max: 256 symbol.") }}</p>
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"/>
                    </div>
                </div>
            
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="teachers" :value="__('Teachers')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Choose teachers for this discipline.") }}</p>
                        <div class="py-2">
                            @foreach ($teachers as $teacher)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name='teachers[]' value={{$teacher->id}} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for={{$teacher->id}} class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$teacher->last_name . ' ' . $teacher->first_name . ' ' . $teacher->father_name}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="learningClasses" :value="__('Classes')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Choose classes for this discipline.") }}</p>
                        <div class="py-2">
                            @foreach ($learningClasses as $learningClass)
                                <div class="flex items-center mb-2">
                                    <input type="checkbox"  name='learningClasses[]' value={{$learningClass->id}} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for={{$learningClass->id}} class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$learningClass->number . ' ' . $learningClass->specialization}}</label>
                                </div>
                            @endforeach
                        </div>
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
