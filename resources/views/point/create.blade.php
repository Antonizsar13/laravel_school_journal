<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New point') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col" >
                        <div class="overdlow-x-auto sm:-mx-6 lg:-mx-8" >
                            <div class="inline-block min-w-full py-2 sm:px-6 px-8">
                                <form method="post" action="{{ route('point.store') }}" class="mt-6 space-y-6">
                                @csrf

                                <div>
                                    <x-input-label for="point" :value="__('Point')" />
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __("Set point") }}
                                        </p>
                                    <x-text-input id="point" name="point" type="number" class="mt-1 block w-full"/>
                                </div>

                                <x-input-label for="academic_discipline_id" :value="__('Discipline')" />
                                <select id="academic_discipline_id" name="academic_discipline_id">
                                    @foreach ($disciplines as $discipline)
                                    <option type="text" value={{$discipline->id}}> {{$discipline->name}}</option>
                                    @endforeach
                                </select>

                                <x-input-label for="user_id" :value="__('Student')" />
                                <select id="user_id" name="user_id">
                                    @foreach ($students as $student)
                                    <option type="text" value={{$student->id}}> {{$student->last_name . ' ' . $student->first_name}}</option>
                                    @endforeach
                                </select>

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
