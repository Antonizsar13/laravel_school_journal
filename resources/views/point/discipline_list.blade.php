<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Discipline list class id = '. $learningClass->id) }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex flex-col" >
                    <div class="overdlow-x-auto sm:-mx-6 lg:-mx-8" >
                    <div class="inline-block min-w-full py-2 sm:px-6 px-8">    
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4" >#</th>
                                    <th scope="col" class="px-6 py-4" >Name</th>
                                    <th scope="col" class="px-6 py-4" >Teacher</th>
                                    <th scope="col" class="px-6 py-4" >Set</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($disciplines as $discipline)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$discipline->id}}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$discipline->name}}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                        @foreach ($discipline->users as $teacher)
                                            @if(($teacher['roles'][0]['name']) == 'Teacher')
                                                {{$teacher->last_name . ' ' . $teacher->first_name . ' ' . $teacher->father_name .', '}}   
                                            @endif
                                        @endforeach 
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-xl" ><a href="{{route('point.discipline_points_list', [$learningClass, $discipline])}}">THIS</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
