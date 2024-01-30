<x-guest-layout>
    <x-auth-card>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Merci pour l\'enregistrement! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer ? Si vous n\'avez pas reçu l\'e-mail, nous vous en enverrons un autre avec plaisir.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous avez fournie lors de l\'inscription.') }}
            </div>
        @endif

        <div class="flex items-center justify-between mt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Renvoyer l\'e-mail de vérification') }}
                    </x-button>
                </div>
            </form>
            <br>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="text-sm text-blue-500 underline hover:text-blue-700">
                    {{ __('Se déconnecter') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
