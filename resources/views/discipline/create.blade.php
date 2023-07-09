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
                                    <x-input-label for="teachers" :value="__('Choose teachers, whom lead this discipline')" />
                                    <select multiple id="teachers" name="teachers[]" >
                                        @foreach ($teachers as $teacher) 
                                            <option  type="text" value={{$teacher->id}}>{{$teacher->last_name . ' ' . $teacher->first_name . ' ' . $teacher->father_name}}</option>
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
