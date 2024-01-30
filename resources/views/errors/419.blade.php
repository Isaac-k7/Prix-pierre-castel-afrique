
<style>
    .imgPreview img{
        width: 100px;
    }
</style>
<x-candidat-layout>

        <div class="error419">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="text-wrapper">
                            <div class="title" data-content="404">
                            SESSIONS EXPIRE
                            </div>

                            <div class="subtitle">
                            votre session a expiré , veuillez vous recconnecter.
                            </div>
                            <div class="connexion">
                            <a href="{{ route('login') }}" class="btn-log-guest text-sm text-gray-700 dark:text-gray-500 underline">Connexion</a>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
</x-candidat-layout>


