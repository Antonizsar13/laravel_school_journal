<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit discipline') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('homework.update', $homework)}}" class="mt-6 space-y-6">                
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="task" :value="__('Task')" />
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Set task") }}
                        </p>
                    <x-text-input id="task" name="task" type="text" class="mt-1 block w-full" :value="old('task', $homework->task)"/>
                </div>

                <div>
                <x-input-label for="date" :value="__('Date')" />
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Set date") }}
                    </p>
                    <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="old('date', date_create($homework->date)->Format('Y-m-d'))"/>
                </div>

                <x-input-label for="learning_class_id" :value="__('Learning Class')" />
                <select id="learning_class_id" name="learning_class_id">
                    @foreach ($learningClasses as $learningClass)
                    <option type="text" value={{$learningClass->id}} @selected($homework->learningClass == $learningClass)> {{$learningClass->number . ' ' . $learningClass->specialization}}
                    </option>
                    @endforeach
                </select>
                        {{-- сделать что бы список предметов менялся относительно выбранного класса  --}}
                <x-input-label for="academic_discipline_id" :value="__('Learning Classes')" />
                <select id="academic_discipline_id" name="academic_discipline_id">
                    @foreach ($disciplines as $discipline)
                    <option type="text" value={{$discipline->id}} @selected($homework->academicDiscipline == $discipline)> {{$discipline->name}}</option>
                    @endforeach
                </select>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>


            
           <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <form method="post" action="{{ route('homework.destroy', $homework) }}" class="p-6">
                @csrf
                @method('delete')
                
                <h3 class="text-lg text-gray-900">
                    {{ __('Delete homework') }}
                </h3>
            
                <x-danger-button    x-danger-button class="ml-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </form>
           </div>
        </div>
    </div>
</x-app-layout>
