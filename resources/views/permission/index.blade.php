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
                            {{ __('List users:') }}
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
                                    <th scope="col" class="px-6 py-4">Email</th>
                                    <th scope="col" class="px-6 py-4">Role</th>
                                    <th scope="col" class="px-6 py-4">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium" >{{$user->id}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >{{$user->first_name}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >{{$user->father_name}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >{{$user->last_name}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >{{$user->email}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >
                                        <form method="post" action="{{ route('permissions.update', $user) }}" class="mt-6 space-y-6">
                                            @csrf
                                            @method('patch')

                                            <div>
                                                <select id="role" name="role">
                                                    @foreach ($roles as $roleList)

                                                    <option  type="text" @if($user->roles[0]->name == $roleList->name) selected @endif> {{$roleList->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                            
                                                @if (session('status') === 'profile-updated')
                                                    <p
                                                        x-data="{ show: true }"
                                                        x-show="show"
                                                        x-transition
                                                        x-init="setTimeout(() => show = false, 2000)"
                                                        class="text-sm text-gray-600"
                                                    >{{ __('Saved.') }}</p>
                                                @endif
                                            </div>
                                        </form>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-xl" ><a href="/permissions/{{{$user->id}}}">&#9998</a></td>
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
