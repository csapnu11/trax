<x-guest-layout>
    <div class="min-h-40 flex align-top justify-center px-2">
        <div class="w-full max-w-md bg-white rounded-xl">
            <h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">
                {{ __('Create Your Account') }}
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-indigo-700 font-semibold" />
                    <x-text-input id="name" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" class="text-indigo-700 font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-indigo-700 font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-indigo-700 font-semibold" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-3 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
