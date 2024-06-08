<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Role Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update role.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('permissions.update', $user) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <select id="role" name="role"  <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">>
                @foreach ($roles as $roleList)
                    @if($roleList->name == 'Super Admin')
                        @role('Super Admin')
                        <option  type="text" @if($user->roles[0]->name == $roleList->name) selected @endif> {{$roleList->name}}</option>
                        @endrole
                    @else
                        <option  type="text" @if($user->roles[0]->name == $roleList->name) selected @endif> {{$roleList->name}}</option>
                    @endif
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
</section>
