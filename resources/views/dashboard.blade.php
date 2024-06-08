<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Start') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <nav class="bg-white border-gray-200 dark:border-gray-600 dark:bg-gray-900">
                        <div id="mega-menu-full-dropdown" class="mt-1 border-gray-200 shadow-sm bg-gray-50 md:bg-white border-y dark:bg-gray-800 dark:border-gray-600">
                            <div class="grid max-w-screen-xl px-4 py-5 mx-auto text-gray-900 dark:text-white sm:grid-cols-2 md:px-6">
                                @role('Super Admin|Admin')
                                <ul>
                                    <li>
                                        <a href={{route('academic_discipline.index')}} class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <div class="font-semibold">Discipline</div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">List all disciplines</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href={{route('learning_class.index')}} class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <div class="font-semibold">Classes</div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">List all classes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href={{route('point.classes')}} class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <div class="font-semibold">Points</div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Check and put a points</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <a href={{route('homework.index')}} class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <div class="font-semibold">Homework</div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Check and make homeworks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href={{route('schedule.classes')}} class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <div class="font-semibold">Schedule</div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Check and choose shedules</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href={{route('permissions.index')}} class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <div class="font-semibold">Profile settings</div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">List users and his role</span>
                                        </a>
                                    </li>
                                </ul>
                                @endrole
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
