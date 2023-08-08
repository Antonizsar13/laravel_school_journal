<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New discipline') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col" >
                        <div class="overdlow-x-auto sm:-mx-6 lg:-mx-8" >
                            <div class="inline-block min-w-full py-2 sm:px-6 px-8">
                                <form method="post" action="{{ route('discipline.store') }}" class="mt-6 space-y-6">
                                @csrf

                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __("Min: 2 sybmol, max: 256 symbol.") }}
                                        </p>
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"/>
                                </div>


                                <div>
                                    <h3>Teachers:</h3>
                                    @foreach ($teachers as $teacher)
                                        <input type="checkbox" id={{$teacher->id}} name='teachers[]' value={{$teacher->id}}>
                                        <label for={{$teacher->id}}>{{$teacher->last_name . ' ' . $teacher->first_name . ' ' . $teacher->father_name}}</label>
                                        <br>
                                    @endforeach
                                </div>


                                <div>
                                    <h3>Classes:</h3>
                                    @foreach ($learningClasses as $learningClass)
                                        <input type="checkbox" id={{$learningClass->id}} name='learningClasses[]' value={{$learningClass->id}}>
                                        <label for={{$learningClass->id}}>{{$learningClass->number . ' ' . $learningClass->specialization}}</label>
                                        <br>
                                    @endforeach
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
