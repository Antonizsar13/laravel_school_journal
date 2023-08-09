<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Points list student id = '. $user->id . ', dicipline id = ' . $discipline->id) }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center gap-4 mt-2">
                            <x-dropdown-link :href="route('point.create_point_user', [$discipline, $user])">
                                {{ __('Create new point this student') }}
                            </x-dropdown-link>
                    </div>    
                    <div class="flex flex-col" >
                    <div class="overdlow-x-auto sm:-mx-6 lg:-mx-8" >
                    <div class="inline-block min-w-full py-2 sm:px-6 px-8">    
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4" >#</th>
                                    <th scope="col" class="px-6 py-4" >Point</th>
                                    <th scope="col" class="px-6 py-4" >Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($points as $point)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$point->id}}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                     <form method="post" action="{{ route('point.update', $point)}}" class="mt-6 space-y-6">                
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
            </div>
        </div>
    </div>
</x-app-layout>
