<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($schedules as $schedule)
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-3xl font-bold dark:text-white">{{$schedule->day_of_the_week}}</h3>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        Number
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Discipline
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedule->academicDisciplines as $discipline)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                        {{$discipline->pivot->number}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$discipline->name}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @role('Admin|Super Admin')
                        <div class="flex items-center gap-4 m-3">
                            <a href="{{route('schedule.edit', $schedule)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                {{ __('Edit schedule') }}
                            </a>
                        </div>
                        @endrole
                    </div>
                </div>
            </div>
                @endforeach            
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                       <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" onclick="history.back()">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>
