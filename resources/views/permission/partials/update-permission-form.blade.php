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
            <select id="role" name="role">
                @foreach ($roles as $roleList)
                
                <option  type="text" @if($role[0]->name === $roleList->name) selected @endif> {{$roleList->name}}</option>
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
