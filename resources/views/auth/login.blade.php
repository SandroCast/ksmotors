<x-guest-layout>
    {{-- <img id="imgfundo" src="/img/fundo.png" alt="" style="height: 100%; position: absolute; opacity : 0.9;"> --}}

    <style>
        .w-full{
            z-index: 1;
        }

        #imgfundo{
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
    </style>
    <x-jet-authentication-card>
        <x-slot name="logo">
             <x-jet-authentication-card-logo /> 
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div style="text-align: center; font-size: 30px; color: cornflowerblue; font-weight: 700">KSmotors</div>
        <br><br>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Senha') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Guardar Senha') }}</span>
            
                    <a style="float: right" class="justify-end text-sm text-red-600 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __('Não tenho conta') }}
                    </a>
                </label>
 
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Esqueceu a sua senha?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Entrar') }}
                </x-jet-button>
            </div>

        </form>
    </x-jet-authentication-card>
</x-guest-layout>
