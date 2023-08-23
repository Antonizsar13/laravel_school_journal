<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit homework') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('homework.update', $homework) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="task" :value="__('Task')" />
                            <p class="mt-1 text-sm text-gray-600">{{ __("Min: 2 sybmol, max: 256 symbol.") }}</p>
                        <textarea id="task" name="task" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your task here">{{$homework->task}}</textarea>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="date" :value="__('Date')" />
                            <p class="mt-1 text-sm text-gray-600">{{ __("Set date") }}</p>
                        <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="old('date', date_create($homework->date)->Format('Y-m-d'))"/>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="learning_class_id" :value="__('Learning class')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Choose class for this homework.") }}</p>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="learning_class_id" name="learning_class_id">
                            @foreach ($learningClasses as $learningClass)
                                <option type="text" value={{$learningClass->id}}
                                    @selected($homework->learningClass == $learningClass)>
                                     {{$learningClass->number . ' ' . $learningClass->specialization}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                        {{-- сделать что бы список предметов менялся относительно выбранного класса  --}}
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="academic_discipline_id" :value="__('Academic disciplines')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Choose disciplines for this homework.") }}</p>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="academic_discipline_id" name="academic_discipline_id">
                            @foreach ($disciplines as $discipline)
                                <option type="text" value={{$discipline->id}} 
                                    @selected($homework->academicDiscipline == $discipline)> {{$discipline->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

               <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Edit') }}</x-primary-button>
                        </div>
                    </div>
                </div>   
            </form>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                        <div>
                        <form method="post" action="{{ route('homework.destroy', $homework) }}">
                            @csrf
                            @method('delete')   
                            <button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete
                            </button>
                        </form>
                        </div>
                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" onclick="history.back()">Back</button>
                    </div>
                </div>
            </div>
                        
        </div>
    </div>   
</x-app-layout>  
