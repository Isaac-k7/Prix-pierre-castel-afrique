<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mise à jour de  {{ $data->users->name }}
        </h2>
    </x-slot>

    <div class="py-12">

        <form method="post" action="{{route('filiale.update', [$data->id])}}"  enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid gap-6 shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-1 gap-6">
              <!-- avatar -->
                <div class="space-y-2" >
                <p>  <x-form.label
                            for="name"
                            :value="__('Avatar')"
                        /></p>
                <div class="" style="display:flex">
                    @if($data->users->getFirstMediaUrl('avatar_user','thumb'))
                        <img  style="width:100px;" src="{!! $data->users->getFirstMediaUrl('avatar_user','thumb') !!}" alt="" srcset="">
                    @endif 
                      
                      
                        <x-form.input
                                id="avatar"
                                class="block w-full"
                                type="file"
                                name="avatar"
                                :value="old('avatar')"
                                autofocus
                                placeholder="{{ __('Avatar') }}"
                            />
                    
                      
                    </div>
                </div>
                <!-- Name -->
                <div class="space-y-2">
                    <x-form.label
                        for="name"
                        :value="__('Nom')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-form.input
                            withicon
                            id="name"
                            class="block w-full"
                            type="text"
                            name="name"
                            :value="old('name', $data->users->name)"
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
                            <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="email"
                            class="block w-full"
                            type="email"
                            name="email"
                            :value="old('name', $data->users->email)"
                            required
                            placeholder="{{ __('Email') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password"
                        :value="__('Nouveau mot de passe')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password"
                            class="block w-full"
                            type="password"
                            name="password"
                            autocomplete="new-password"
                            placeholder="{{ __('Nouveau mot de passe') }}"
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
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password_confirmation"
                            class="block w-full"
                            type="password"
                            name="password_confirmation"
                            placeholder="{{ __('Confirmez le mot de passe') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                           <div class="space-y-2">
                             <x-form.label
                                    for="pays_id"
                                    :value="__('Selectionnez le pays')"
                                />
                                <select name="pays_id" required class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 @error('pays_id') border-red-500 @enderror">
                                    <option value="" {{old('pays_id')=='' ? 'selected':''}}>Sélectionnez</option>
                                    @foreach($datapays as $pays)
                                        <option value="{{$pays->id}}" {{$data->pays->id==$pays->id ? 'selected':''}}>{{$pays->name}}</option>
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

                        <span>{{ __('Mettre à jour') }}</span>
                    </x-button>
                </div>
                </div>
            </div>

            </div>

        </form>

    </div>
</x-app-layout>