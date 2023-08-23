<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Homework list') }}
        </h2>
    </x-slot>
    
   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <div class="w-48">
                        <x-dropdown-link class="w-32 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"  :href="route('homework.create')">
                            {{ __('Create new homework') }}
                        </x-dropdown-link>
                        </div> 
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                              <div class="overflow-hidden">
                                <table class="min-w-full text-left text-sm font-light">
                                  <thead
                                    class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
                                    <tr>
                                        <th scope="col" class="px-6 py-4" >#</th>
                                        <th scope="col" class="px-6 py-4" >Task</th>
                                        <th scope="col" class="px-6 py-4" >Class</th>
                                        <th scope="col" class="px-6 py-4" >Discipline</th>
                                        <th scope="col" class="px-6 py-4" >Date</th>
                                        <th scope="col" class="px-6 py-4" >Edit</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($homeworks as $homework)
                                    <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-700">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium" >{{$homework->id}}</td>
                                        <td class="whitespace-normal px-6 py-4" >{{$homework->task}}</td>
                                        <td class="whitespace-nowrap px-6 py-4" >  
                                            {{$homework->learningClass->number . ' ' . $homework->learningClass->specialization }}  
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4" >  
                                            {{$homework->academicDiscipline->name}}  
                                        </td>
                                        <td class="px-6 py-4">{{date_create($homework->date)->Format('m-d-Y')}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                          <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"  
                                                href="{{route('homework.edit', $homework)}}">
                                              &#9998
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
