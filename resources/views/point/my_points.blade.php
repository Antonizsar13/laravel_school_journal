<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Discipline list') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col" >
                    <div class="overdlow-x-auto sm:-mx-6 lg:-mx-8" >
                    <div class="inline-block min-w-full py-2 sm:px-6 px-8">
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4" >#</th>
                                    <th scope="col" class="px-6 py-4" >Discipline</th>
                                    <th scope="col" class="px-6 py-4" >Points</th>
                                    <th scope="col" class="px-6 py-4" >Acerage point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($disciplines as $discipline)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium" >{{$discipline->id}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >{{$discipline->name}}</td>
                                    <td class="whitespace-nowrap px-6 py-4" >
                                        @php
                                            $aceragePoint = 0;
                                            $count = 0;
                                        @endphp 
                                        @foreach($user->pointsDiscipline($discipline)->get() as $point)
                                            @php
                                                $aceragePoint = $aceragePoint + $point->point;
                                                $count = $count + 1;
                                            @endphp
                                            {{$point->point}}
                                        @endforeach
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($count != 0)
                                            {{$aceragePoint/$count}}
                                        @endif    
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
