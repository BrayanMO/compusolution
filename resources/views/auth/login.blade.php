<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}
            <a href="" class="mx-6">
                {{-- <x-jet-application-mark class="block h-9 w-auto" /> --}}
                <span class="text-4xl  h-7 w-aut text-gray-500 cursor-pointer font-bold ">Compu</span>
                <span class="text-4xl font-bold h-7 w-aut text-orange-400 cursor-pointer">Solution</span>
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" autocomplete="off" >
            @csrf

            <div >
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full " type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4 mb-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button href="/" class="ml-4">
                    {{ __('Ingresar') }}
                </x-jet-button>
            </div>

            <hr>
            <div class="mt-4 text-gray-500 text-center">
                ¿No tienes una cuenta?  <a class="hover:underline hover:text-blue-700" href="{{route('register')}}">Registrate</a>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
