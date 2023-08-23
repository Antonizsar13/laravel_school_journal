<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User list') }}
        </h2>
    </x-slot>
    
   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                                        <th scope="col" class="px-6 py-4">Role</th>
                                        <th scope="col" class="px-6 py-4">Edit</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($users as $user)
                                    <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-700">
                                      <td class="whitespace-nowrap px-6 py-4 font-medium" >{{$user->id}}</td>
                                        <td class="whitespace-nowrap px-6 py-4" >{{$user->first_name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4" >{{$user->father_name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4" >{{$user->last_name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4" >
                                            <form method="post" action="{{ route('permissions.update', $user) }}">
                                                @csrf
                                                @method('patch')

                                                <div>
                                                    <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        @foreach ($roles as $roleList)

                                                        <option  type="text" @if($user->roles[0]->name == $roleList->name) selected @endif> {{$roleList->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="flex items-center gap-4 mt-2">
                                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"  href="{{route('permissions.show', $user)}}">
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
