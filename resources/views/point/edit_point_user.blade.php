<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Points list') }}
        </h2>
    </x-slot>
    
   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <header>
                        <h2 class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                            {{ __('Student: ' . $user->first_name . ' '. $user->second_name)}}
                        </h2>
                        <h2 class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                            {{ __('Discipline: ' . $discipline->name) }}
                        </h2>
                    </header>
                    <div class="w-64">
                        <x-dropdown-link :href="route('point.create_point_user', [$discipline, $user])" class="w-32 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"  >
                            {{ __('Create new point for this student') }}
                        </x-dropdown-link>
                    </div>  
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                              <div class="overflow-hidden">
                                <table class="min-w-full text-left text-sm font-light">
                                  <thead class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
                                    <tr>
                                        <th scope="col" class="px-6 py-4" >#</th>
                                        <th scope="col" class="px-6 py-4" >Point</th>
                                        <th scope="col" class="px-6 py-4" >Delete</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($points as $point)
                                     <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-700">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$point->id}}</td>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            <form method="post" action="{{ route('point.update', $point)}}">                
                                            @csrf
                                            @method('patch')
                                                <x-text-input id="point" name="point" type="number" class="" :value="old('point', $point->point)" />
                                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                            </form>
                                        </td>
                                        <td class="" >     
                                            <form method="post" action="{{ route('point.destroy', $point) }}">
                                                @csrf
                                                @method('delete')
                                                <x-danger-button>
                                                    {{ __('Delete') }}
                                                </x-danger-button>
                                            </form>
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
