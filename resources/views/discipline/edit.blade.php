<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit discipline') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('discipline.update', $discipline)}}" class="mt-6 space-y-6">                
                @csrf
                @method('patch')

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $discipline->name)" />      
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h3>Teachers:</h3>
                        @foreach ($teachers as $teacher)
                            <input type="checkbox" 
                                id={{$teacher->id}} 
                                name='teachers[]' 
                                value={{$teacher->id}} 
                                @foreach ($teachersDiscipline as $teacherDiscipline)
                                    @if($teacherDiscipline->id == $teacher->id) 
                                        checked 
                                    @endif
                                @endforeach>
                            <label for={{$teacher->id}}>{{$teacher->last_name . ' ' . $teacher->first_name . ' ' . $teacher->father_name}}</label>
                            <br>
                        @endforeach
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h3>Classes:</h3>
                        @foreach ($learningClasses as $learningClass)
                            <input type="checkbox" 
                                id={{$learningClass->id}} 
                                name='learningClasses[]' 
                                value={{$learningClass->id}} 
                                @foreach ($learningClassesDiscipline as $learningClassDiscipline)
                                    @if($learningClassDiscipline->id == $learningClass->id) 
                                        checked 
                                    @endif
                                @endforeach>
                            <label for={{$learningClass->id}}>{{$learningClass->number . ' ' . $learningClass->specialization}}</label>
                            <br>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>


            
           <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <form method="post" action="{{ route('discipline.destroy', $discipline) }}" class="p-6">
                @csrf
                @method('delete')
                
                <h3 class="text-lg text-gray-900">
                    {{ __('Delete discipline') }}
                </h3>
            
                <x-danger-button    x-danger-button class="ml-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </form>
           </div>
        </div>
    </div>
</x-app-layout>
