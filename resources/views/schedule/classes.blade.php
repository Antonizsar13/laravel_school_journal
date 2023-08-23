<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Classes list') }}
        </h2>
    </x-slot>
    
   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @role('Admin|Super Admin')
                        <div class="w-48">
                            <x-dropdown-link class="w-32 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"  :href="route('schedule.create')">
                                {{ __('Create new schedule') }}
                            </x-dropdown-link>
                        </div> 
                    @endrole
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                              <div class="overflow-hidden">
                                <table class="min-w-full text-left text-sm font-light">
                                  <thead
                                    class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
                                    <tr>
                                        <th scope="col" class="px-6 py-4" >#</th>
                                        <th scope="col" class="px-6 py-4" >Class number</th>
                                        <th scope="col" class="px-6 py-4" >Specialization</th>
                                        <th scope="col" class="px-6 py-4" >Disciplines</th>
                                        <th scope="col" class="px-6 py-4" >Teacher</th>
                                        <th scope="col" class="px-6 py-4" >Set</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($learningClasses as $learningClass)
                                    <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-700">
                                      <td class="whitespace-nowrap px-6 py-4 font-medium" >{{$learningClass->id}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >{{$learningClass->number}}</td>
                                    <td class="whitespace-normal px-6 py-4" >{{$learningClass->specialization}}</td>
                                    <td class="px-6 py-4" >  
                                        @foreach ($learningClass->academicDisciplines as $discipline)
                                        {{$discipline->name . ', '}}  
                                        @endforeach 
                                    </td>
                                    <td class="whitespace-normal px-6 py-4" >
                                        @foreach ($learningClass->users as $teacher)
                                                {{$teacher->last_name . ' ' . $teacher->first_name . ' ' . $teacher->father_name .', '}}
                                        @endforeach    
                                    </td>
                                      <td class="whitespace-nowrap px-6 py-4">
                                        <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href="{{route('schedule.show_class', $learningClass)}}">
                                            THIS
                                        </a>                                      
                                      </td>
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
    </div>
</x-app-layout>