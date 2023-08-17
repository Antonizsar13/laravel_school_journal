
<x-app-layout>
    {{-- <script src="{{url(mix('js/schedule/create.js'))}}"></script> --}}
     {{-- @vite('resourse/js/schedule/create.js') --}}
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
                                <select id="learning_class_id" name="learning_class_id">
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
                                    <x-text-input id="count_lessons" name="count_lessons" type="number" class="mt-1 block w-full" min='0' value="0" onchange="window.createChooseDiscipline()"/>
                                </div>                            
                                <div>
                                    <h2>Schedule</h2>
                                        <br>1. 
                                        <select id="academic_discipline_id_1" name="academic_discipline_id[]">
                                            @foreach ($disciplines as $discipline)
                                            <option type="text" value={{$discipline->id}}> {{$discipline->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        <br>2. 
                                        <select id="academic_discipline_id_2" name="academic_discipline_id[]">
                                            @foreach ($disciplines as $discipline)
                                            <option type="text" value={{$discipline->id}}> {{$discipline->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        <br>3. 
                                        <select id="academic_discipline_id_3" name="academic_discipline_id[]">
                                            @foreach ($disciplines as $discipline)
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
