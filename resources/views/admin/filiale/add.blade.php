<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un représentant
        </h2>
    </x-slot>
    <div class="py-12">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('filiale.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-6 shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-1 gap-6">
              <!-- avatar -->
                <div class="space-y-2">
                     <x-form.label
                        for="name"
                        :value="__('Avatar')"
                    />
                
                    <x-form.input
                            id="avatar"
                            class="block w-full form-control"
                            type="file"
                            name="avatar"
                            :value="old('avatar')"
                            autofocus
                            placeholder="{{ __('Avatar') }}"
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

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-form.label
                        for="email"
                        :value="__('Email')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                           <!--  <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" /> -->
                        </x-slot>

                        <x-form.input
                            withicon
                            id="email"
                            class="block w-full form-control"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            placeholder="{{ __('Email') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password"
                        :value="__('Mot de passe')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                           <!--  <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" /> -->
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password"
                            class="block w-full form-control"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="{{ __('Mot de passe') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password_confirmation"
                        :value="__('Confirmez le mot de passe')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                           <!--  <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" /> -->
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password_confirmation"
                            class="block w-full form-control"
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="{{ __('Confirmez le mot de passe') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <div class="space-y-2">
                     <x-form.label
                        for="pays_id"
                        :value="__('Selectionnez le pays')"
                    />
                                <select name="pays_id" required class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 @error('pays_id') border-red-500 @enderror">
                                    <option value="" {{old('pays_id')=='' ? 'selected':''}}>Selectionnez</option>
                                    @php
                                        $data = collect($data)->sortBy('name')->all();
                                        @endphp

                                        @foreach($data as $pays)
                                            @if(strpos($pays->name, ':') !== false)
                                                @php($class='hide-country')
                                            @else
                                                @php($class='')
                                            @endif
                                            <option value="{{$pays->id}}"  class="{{$class}}" {{old('pays_id')==$pays->id ? 'selected':''}}>{{$pays->name}}</option>
                                        @endforeach
                               
                                </select>
                </div>
                @error('pays_id')
                <div class="text-red-600">{{$message}}</div>
                @enderror
              </div>


                <div>
                    <x-button class="jpx-4 py-3 bg-gray-50 text-right sm:px-6">
                        <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                        <span>{{ __('Ajout ') }}</span>
                    </x-button>
                </div>
                </div>
            </div>

            </div>
        </form>
</div>
</x-app-layout>
