<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('List Students. Class id=' . $learningClass->id . '. Discipline id=' . $discipline->id) }}
                        </h2>
                    </header>
                    <div class="flex flex-col" >
                    <div class="overdlow-x-auto sm:-mx-6 lg:-mx-8" >
                    <div class="inline-block min-w-full py-2 sm:px-6 px-8">

                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4" >#</th>
                                    <th scope="col" class="px-6 py-4" >First name</th>
                                    <th scope="col" class="px-6 py-4">Fater name</th>
                                    <th scope="col" class="px-6 py-4">Last name</th>
                                    <th scope="col" class="px-6 py-4">Points</th>
                                    <th scope="col" class="px-6 py-4">Set point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium" >{{$student->id}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >{{$student->first_name}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >{{$student->father_name}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >{{$student->last_name}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >
                                        @foreach($student->points as $point)
                                        {{$point->point . ', '}}
                                        @endforeach
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-xl" ><a href="{{route('point.create_point_user', [$discipline, $student])}}">SET</a></td>
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
