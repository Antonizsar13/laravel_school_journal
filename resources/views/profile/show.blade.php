<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Profile Information') }}
                        </h2>
                    </header>

                    <div class="mt-2">
                        <div>
                            <x-input-label for="first_name" :value="__('First name')" />
                            <x-text-input  name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" readonly/>
                        </div>

                        <div>
                            <x-input-label for="father_name" :value="__('Father name')" />
                            <x-text-input  name="father_name" type="text" class="mt-1 block w-full" :value="old('father_name', $user->father_name)" readonly/>
                        </div>

                        <div>
                            <x-input-label for="last_name" :value="__('Last name')" />
                            <x-text-input name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" readonly/>
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" readonly/>
                        </div>

                        <div class="flex items-center gap-4 mt-2">
                        <x-dropdown-link class="w-32 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"  :href="route('profile.edit')">
                            {{ __('Change profile details') }}
                        </x-dropdown-link>
                        </div>    
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
