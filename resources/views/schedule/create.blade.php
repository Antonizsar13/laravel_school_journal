<x-app-layout>

     {{-- <script>
        function createChooseDiscipline(){
            const learningClassId = document.getElementById('learning_class_id').value;
            
            learningClassId = 1;
            const countBlock = document.getElementById('count_lessons').value;
            
             text = '<h2>Schedule</h2>';
            for(var i = 1; i <= countBlock; i++){
                textTemp = '<br>' + i + '. <select id="academic_discipline_id_' + i + '" name="academic_discipline_id[]">@foreach (App\Models\LearningClass::find('+parseInt(learningClassId)+')->academicDisciplines as $discipline)<option type="text" value={{$discipline->id}}> {{$discipline->name}}</option>@endforeach</select>'
                console.log(textTemp);
                text += textTemp;
            }
            document.getElementById("blockDusciplines").innerHTML = text;
        }
    </script> --}}

    <script>
        function createChooseDiscipline(){
            const countBlock = document.getElementById('count_lessons').value;
            
            text = '<h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Schedule') }}</h2>';
            for(i=1; i<=countBlock; i++)
            {          
                textTemp = '<br>' + i + '.<select id="academic_discipline_id_' + i + '" name="academic_discipline_id[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">@foreach ($academicDisciplines as $discipline)<option type="text" value={{$discipline->id}}>{{$discipline->name}}</option>@endforeach</select>'
                text += textTemp;
            }
            document.getElementById("blockDusciplines").innerHTML = text;
        }
    </script>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('schedule.store') }}" class="mt-6 space-y-6">
            @csrf

                 <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="learning_class_id" :value="__('Learning class')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Choose class.") }}</p>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="learning_class_id" name="learning_class_id">
                            @foreach ($learningClasses as $learningClass)
                                <option type="text" value={{$learningClass->id}}>
                                     {{$learningClass->number . ' ' . $learningClass->specialization}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                 <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="day_of_the_week" :value="__('Day of the week')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Choose day of the week.") }}</p>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="day_of_the_week" name="day_of_the_week">
                            @foreach ($daysOfTheWeek as $dayOfTheWeek)
                                <option type="text" value={{$dayOfTheWeek}}>
                                     {{$dayOfTheWeek}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="count_lessons" :value="__('Count lessons')" />
                        <p class="mt-1 text-sm text-gray-600">{{ __("Set count lessons.") }}</p>
                        <x-text-input id="count_lessons" name="count_lessons" type="number" class="mt-1 block w-full" min='0' value="3" onchange="createChooseDiscipline()"/>
                    

                        <div id="blockDusciplines" class="py-12">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Schedule') }}
                            </h2>
                            
                            <br>1.                           
                            <select id="academic_discipline_id_1" name="academic_discipline_id[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($academicDisciplines as $discipline)
                                    <option type="text" value={{$discipline->id}}>
                                         {{$discipline->name}}
                                    </option>
                                @endforeach
                            </select>

                            <br>2.                           
                            <select id="academic_discipline_id_2" name="academic_discipline_id[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($academicDisciplines as $discipline)
                                    <option type="text" value={{$discipline->id}}>
                                         {{$discipline->name}}
                                    </option>
                                @endforeach
                            </select>

                            <br>3.                           
                            <select id="academic_discipline_id_3" name="academic_discipline_id[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($academicDisciplines as $discipline)
                                    <option type="text" value={{$discipline->id}}>
                                         {{$discipline->name}}
                                    </option>
                                @endforeach
                            </select>
                        
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



<x-app-layout>
    
   

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Schedule') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col" >
                        <div class="overdlow-x-auto sm:-mx-6 lg:-mx-8" >
                            <div class="inline-block min-w-full py-2 sm:px-6 px-8">
                                <form method="post" action="{{ route('schedule.store') }}" class="mt-6 space-y-6">
                                @csrf

                                <x-input-label for="learning_class_id" :value="__('Learning Class')" />
                                <select id="learning_class_id" name="learning_class_id" onchange="createChooseDiscipline()">
                                    @foreach ($learningClasses as $learningClass)
                                    <option type="text" value={{$learningClass->id}}> {{$learningClass->number . ' ' . $learningClass->specialization}}
                                    </option>
                                    @endforeach
                                </select>

                                <x-input-label for="day_of_the_week" :value="__('Day of the week')" />
                                <select id="day_of_the_week" name="day_of_the_week">
                                    @foreach ($daysOfTheWeek as $dayOfTheWeek)
                                    <option type="text" value={{$dayOfTheWeek}}> {{$dayOfTheWeek}}
                                    </option>
                                    @endforeach
                                </select>

                                <div>
                                    <x-input-label for="count_lessons" :value="__('Count lessons')" />
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __("Set count lessons") }}
                                        </p>
                                    <x-text-input id="count_lessons" type="number" class="mt-1 block w-full" min='0' value="3" onchange="createChooseDiscipline()"/>
                                </div>                            
                                <div id="blockDusciplines">
                                    <h2>Schedule</h2>
                                        <br>1. 
                                        <select id="academic_discipline_id_1" name="academic_discipline_id[]">
                                            @foreach ($academicDisciplines as $discipline)
                                            <option type="text" value={{$discipline->id}}> {{$discipline->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        <br>2. 
                                        <select id="academic_discipline_id_2" name="academic_discipline_id[]">
                                            @foreach ($academicDisciplines as $discipline)
                                            <option type="text" value={{$discipline->id}}> {{$discipline->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        <br>3. 
                                        <select id="academic_discipline_id_3" name="academic_discipline_id[]">
                                            @foreach ($academicDisciplines as $discipline)
                                            <option type="text" value={{$discipline->id}}> {{$discipline->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                       

                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
