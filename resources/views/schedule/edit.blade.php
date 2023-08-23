<x-app-layout>

    <script>
        function createChooseDiscipline(){
            const countBlock = document.getElementById('count_lessons').value;
            
            text = '<h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Schedule') }}</h2>';
            for(i=1; i<=countBlock; i++)
            {          
                textTemp = '<br>' + i + '.<select id="academic_discipline_id_' + i + '" name="academic_discipline_id[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">@foreach ($disciplines as $discipline)<option type="text" value={{$discipline->id}}>{{$discipline->name}}</option>@endforeach</select>'
                text += textTemp;
            }
            document.getElementById("blockDusciplines").innerHTML = text;
        }
    </script>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('schedule.update', $schedule) }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="learning_class_id" :value="__('Learning Class')" />                              
                        <x-text-input id="learning_class_id" name="learning_class_id" type="text" :value="old('learning_class', $schedule->learningClass->number . ' ' . $schedule->learningClass->specialization)" readonly/>
                    </div>
                </div>
                
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="day_of_the_week" :value="__('Day of the week')" />
                        <x-text-input id="day_of_the_week" name="day_of_the_week" type="text" :value="old('day_of_the_week', $schedule->day_of_the_week)" readonly/>
                    </div>
                </div>
                
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="count_lessons" :value="__('Count lessons')" />
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Set count lessons") }}
                            </p>
                        <x-text-input id="count_lessons" name="count_lessons" type="number" class="mt-1 block w-full" min='0' value="{{count($schedule->academicDisciplines)}}" onchange="createChooseDiscipline()"/>

                        
                        <div id="blockDusciplines" class="py-12">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Schedule') }}
                            </h2>
                            
                            @foreach($schedule->academicDisciplines as $scheduleDiscipline)
                            <br>{{$scheduleDiscipline->pivot->number}}. .                           
                                <select id="academic_discipline_id_{{$scheduleDiscipline->pivot->number}}" name="academic_discipline_id[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($disciplines as $discipline)
                                        <option type="text" value={{$discipline->id}} @selected($discipline->id == $scheduleDiscipline->id)> {{$discipline->name}}
                                        </option>
                                    @endforeach
                                </select>
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
                        <form method="post" action="{{ route('schedule.destroy', $schedule) }}">
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
