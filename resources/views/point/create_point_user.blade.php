<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New point') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <header>
                <h2 class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                    {{ __('Student: ' . $user->first_name . ' '. $user->second_name)}}
                </h2>
                <h2 class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                    {{ __('Discipline: ' . $discipline->name) }}
                </h2>
            </header>
            <form method="post" action="{{ route('point.store') }}" class="mt-6 space-y-6">
            @csrf
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="point" :value="__('Point')" />
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Set point") }}
                            </p>
                        <x-text-input id="point" name="point" type="number" class="mt-1 block w-full"/>

                        <div class="flex items-center gap-4 mt-7">
                            <x-primary-button>{{ __('Create') }}</x-primary-button>
                        </div>
                    </div>
                </div>

                <input type="text" name="academic_discipline_id" value={{$discipline->id}} hidden>
                <input type="text" name="user_id" value={{$user->id}} hidden>


            </form>
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

    


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New point') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col" >
                        <div class="overdlow-x-auto sm:-mx-6 lg:-mx-8" >
                            <div class="inline-block min-w-full py-2 sm:px-6 px-8">
                                <form method="post" action="{{ route('point.store') }}" class="mt-6 space-y-6">
                                @csrf

                                <div>
                                    <x-input-label for="point" :value="__('Point')" />
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __("Set point") }}
                                        </p>
                                    <x-text-input id="point" name="point" type="number" class="mt-1 block w-full"/>
                                </div>


                               

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
