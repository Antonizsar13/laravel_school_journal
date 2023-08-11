<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit discipline') }}
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
                        <x-text-input id="number" name="number" type="number" class="mt-1 block w-full" :value="old('number', $learningClass->number)" />      
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="specialization" :value="__('Specialization')" />
                        <x-text-input id="specialization" name="specialization" type="text" class="mt-1 block w-full" :value="old('specialization', $learningClass->specialization)" />      
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h3>Teacher:</h3>
                        <select id="teacher" name="students[]">
                             @foreach ($teachers as $teacher)
                                <option type="text" value={{$teacher->id}}
                                 @selected($teacher->id == $teacherClass)> {{$teacher->last_name . ' ' . $teacher->first_name . ' ' . $teacher->father_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h3>Students:</h3>
                            @foreach ($students as $student)
                            <input type="checkbox" id={{$student->id}} name='students[]' value={{$student->id}} 
                            @foreach ($studentsClass as $studentClass)
                                @checked($student->id == $studentClass)
                            @endforeach>
                            <label for={{$student->id}}>{{$student->last_name . ' ' . $student->first_name . ' ' . $student->father_name}}</label>
                            <br>
                        @endforeach
                    </div>
                </div>              

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h3>Discipline:</h3>
                        @foreach ($academicDisciplines as $discipline)
                            <input type="checkbox" 
                                id={{$discipline->id}} 
                                name='disciplines[]' 
                                value={{$discipline->id}} 
                                @foreach ($disciplinesClass as $disciplineClass)
                                    @if($disciplineClass->id == $discipline->id) 
                                        checked 
                                    @endif
                                @endforeach>
                            <label for={{$discipline->id}}>{{$discipline->name}}</label>
                            <br>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>


            
           <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <form method="post" action="{{ route('learning_class.destroy', $learningClass) }}" class="p-6">
                @csrf
                @method('delete')
                
                <h3 class="text-lg text-gray-900">
                    {{ __('Delete class') }}
                </h3>
            
                <x-danger-button    x-danger-button class="ml-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </form>
           </div>
        </div>
    </div>
</x-app-layout>
