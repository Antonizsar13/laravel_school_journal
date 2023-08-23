
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit class') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('learning_class.update', $learningClass)}}" class="mt-6 space-y-6">                
                @csrf
                @method('patch')
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="number" :value="__('Number')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Min: 2, max: 256.") }}</p>
                        <x-text-input id="number" name="number" type="number" class="mt-1 block w-full" :value="old('number', $learningClass->number)"/>
                    </div>
                </div>


                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="specialization" :value="__('Specialization')" />
                            <p class="mt-1 text-sm text-gray-600">{{ __("Min: 2, max: 256.") }}</p>
                        <x-text-input id="specialization" name="specialization" type="text" class="mt-1 block w-full" :value="old('specialization', $learningClass->specialization)"/>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="teacher" :value="__('Teacher')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Choose teacher for this class.") }}</p>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="teacher" name="students[]">
                            @foreach ($teachers as $teacher)
                                <option type="text" value={{$teacher->id}}
                                    @selected($teacher->id == $teacherClass->id)>
                                     {{$teacher->last_name . ' ' . $teacher->first_name . ' ' . $teacher->father_name .', '}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="students" :value="__('Students')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Choose students for this class.") }}</p>
                        <div class="py-2">
                            @foreach ($students as $student)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name='students[]' value={{$student->id}} 
                                    @foreach ($studentsClass as $studentClass)
                                        @checked($student->id == $studentClass->id)
                                    @endforeach
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for={{$student->id}} class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$student->last_name . ' ' . $student->first_name . ' ' . $student->father_name}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="disciplines" :value="__('Disciplines')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Choose disciplines for this class.") }}</p>
                        <div class="py-2">
                            @foreach ($disciplines as $discipline)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name='disciplines[]'
                                    @foreach ($disciplinesClass as $disciplineClass)
                                        @checked($disciplineClass->id == $discipline->id) 
                                    @endforeach
                                    value={{$discipline->id}} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for={{$discipline->id}}
                                 class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$discipline->name}}</label>
                            </div>
                            @endforeach
                        </div>
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
                        <form method="post" action="{{ route('learning_class.destroy', $learningClass) }}">
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
               
