<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students list') }}
        </h2>
    </x-slot>
    
   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <header>
                        <h2 class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                            {{ __('Class: ' . $learningClass->number . ' '. $learningClass->specialization)}}
                        </h2>
                        <h2 class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                            {{ __('Discipline: ' . $discipline->name) }}
                        </h2>

                    </header>
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                              <div class="overflow-hidden">
                                <table class="min-w-full text-left text-sm font-light">
                                  <thead
                                    class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
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
                                    <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-700">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium" >{{$student->id}}</td>
                                        <td class="whitespace-nowrap px-6 py-4" >{{$student->first_name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4" >{{$student->father_name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4" >{{$student->last_name}}</td>
                                        <td class="whitespace-normal px-6 py-4" >
                                            @foreach($student->points as $point)
                                            {{$point->point}}
                                            @endforeach
                                        </td>
                                      <td class="whitespace-nowrap px-6 py-4">
                                          <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" 
                                          href="{{route('point.create_point_user', [$discipline, $student])}}">SET</a>                                     
                                      </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>
                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" onclick="history.back()">Back</button>  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
