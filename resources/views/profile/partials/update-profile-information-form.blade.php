<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Informations sur le profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mettre à jour les informations de profil et l'adresse e-mail de votre compte.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="mt-6 space-y-6"
        enctype="multipart/form-data"
    >
        @csrf
        @method('patch')

        <div class="space-y-2">
            <x-form.label
                for="avatar"
                :value="__('Avatar')"
            />

            <x-form.input
                id="avatar"
                name="avatar"
                type="file"
                class="block w-full"
                :value="old('avatar')"
                autofocus
                autocomplete="avatar"
            />

            <x-form.error :messages="$errors->get('avatar')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                for="name"
                :value="__('Nom')"
            />

            <x-form.input
                id="name"
                name="name"
                type="text"
                class="block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-form.error :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                for="email"
                :value="__('Email')"
            />

            <x-form.input
                id="email"
                name="email"
                type="email"
                class="block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="email"
            />

            <x-form.error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-300">
                        {{ __('Votre adresse e-mail n\'est pas vérifiée.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  dark:text-gray-400 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800">
                            {{ __('Cliquez ici pour renvoyer l\'e-mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

         <div class="space-y-2">
                <x-form.label
                    for="birthday"
                    :value="__('Date de naissance')"
                />

                <x-form.input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-heroicon-o-calendar aria-hidden="true" class="w-5 h-5" />
                    </x-slot>

                    <x-form.input
                        withicon
                        min="1978-01-01" 
                        max="2005-12-31"
                        id="birthday"
                        class="block w-full"
                        type="date"
                        name="birthday"
                        :value="old('birthday', $user->birthday)"
                        placeholder="{{ __('Date de naissance') }}"
                    />
                </x-form.input-with-icon-wrapper>
        </div>

         <div class="space-y-2">
            <x-form.label
                for="phone"
                :value="__('Téléphone')"
            />

            <x-form.input-with-icon-wrapper>
                <x-slot name="icon">
                    <x-heroicon-o-phone aria-hidden="true" class="w-5 h-5" />
                </x-slot>

                <x-form.input
                    withicon
                    id="phone"
                    class="block w-full"
                    type="text"
                    name="phone"
                    :value="old('phone', $user->phone)"
                    required
                    placeholder="{{ __('Téléphone') }}"
                />
            </x-form.input-with-icon-wrapper>
        </div>

         <div class="space-y-2">
                <x-form.label
                    for="address"
                    :value="__('Adresse')"
                />

                <x-form.input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-heroicon-o-map aria-hidden="true" class="w-5 h-5" />
                    </x-slot>

                    <x-form.input
                        withicon
                        id="address"
                        class="block w-full"
                        type="text"
                        name="address"
                        :value="old('address', $user->address)"
                        required
                        placeholder="{{ __('Adresse') }}"
                    />
                </x-form.input-with-icon-wrapper>
        </div>

        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Sauvegarder') }}
            </x-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >
                    {{ __('Sauvegardé.') }}
                </p>
            @endif
        </div>
    </form>
</section>
