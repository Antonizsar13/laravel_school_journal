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
                                <form method="post" action="{{ route('learning_class.store') }}" class="mt-6 space-y-6">
                                @csrf

                                <div>
                                    <x-input-label for="number" :value="__('Number')" />
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __("Min: 2 sybmol, max: 256 symbol.") }}
                                        </p>
                                    <x-text-input id="number" name="number" type="number" class="mt-1 block w-full"/>
                                </div>

                                <div>
                                    <x-input-label for="specialization" :value="__('Specialization')" />
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __("Min: 2 sybmol, max: 256 symbol.") }}
                                        </p>
                                    <x-text-input id="specialization" name="specialization" type="text" class="mt-1 block w-full"/>
                                </div>

                                 <x-input-label for="teacher" :value="__('Teacher')" />
                                <select id="teacher" name="students[]">
                                    @foreach ($teachers as $teacher)
                                    <option type="text" value={{$teacher->id}}> {{$teacher->last_name . ' ' . $teacher->first_name . ' ' . $teacher->father_name .', '}}</option>
                                    @endforeach
                                </select>

                                <div>
                                    <h3>Students:</h3>
                                    @foreach ($students as $student)
                                        <input type="checkbox" id={{$student->id}} name='students[]' value={{$student->id}}>
                                        <label for={{$student->id}}>{{$student->last_name . ' ' . $student->first_name . ' ' . $student->father_name}}</label>
                                        <br>
                                    @endforeach
                                </div>

                                <div>
                                    <h3>Disciplines:</h3>
                                    @foreach ($disciplines as $discipline)
                                        <input type="checkbox" id={{$discipline->id}} name='disciplines[]' value={{$discipline->id}}>
                                        <label for={{$discipline->id}}>{{$discipline->name}}</label>
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
