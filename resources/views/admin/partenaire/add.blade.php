<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un partenaire
        </h2>
    </x-slot>
    <div class="py-12">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('partenaire.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-6 shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-1 gap-6">
              <!-- avatar -->
                <div class="space-y-2">
                     <x-form.label
                        for="name"
                        :value="__('Logo')"
                    />
                
                    <x-form.input
                            id="logo"
                            class="block w-full form-control"
                            type="file"
                            name="logo"
                            :value="old('logo')"
                            autofocus
                            placeholder="{{ __('Logo') }}"
                        />
                      
                    </div>
                    <!-- Name -->
                    <div class="space-y-2">
                        <x-form.label
                            for="name"
                            :value="__('Nom')"
                        />

                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <!--  <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" /> -->
                            </x-slot>

                            <x-form.input
                                withicon
                                id="name"
                                class="block w-full form-control"
                                type="text"
                                name="name"
                                :value="old('name')"
                                required
                                autofocus
                                placeholder="{{ __('Nom') }}"
                            />
                        </x-form.input-with-icon-wrapper>
                    </div>
                    <!-- statuts -->
                    <div class="space-y-2">
                        <x-form.label
                            for="name"
                            :value="__('Statut')"
                        />

                        <select name="status" required class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 @error('status') border-red-500 @enderror">
                                    <option value="" {{old('status')=='' ? 'selected':''}}>Sélectionnez</option>
                                    <option value="1">Actif</option>
                                    <option value="0">Inactif</option>
                                    
                                </select>
                    </div>

              </div>


                    <div>
                        <x-button class="jpx-4 py-3 bg-gray-50 text-right sm:px-6">
                            <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                            <span>{{ __('Ajouter ') }}</span>
                        </x-button>
                    </div>
                </div>
            </div>

            </div>
        </form>
</div>
</x-app-layout>
