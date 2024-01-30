<x-guest-layout>
   
       

        <form method="post" action="{{ route('postcandidat-register') }}" enctype="multipart/form-data">
           
              @csrf

               <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6 register-cand" id="cand-form">
                    
                    <!-- Validation Errors -->
               <x-auth-validation-errors class="mb-4" :errors="$errors" />
               
                <div class="grid grid-cols-1  gap-6">
                    <!-- avatar -->
                    <div class="space-y-2">
                        <x-form.label
                            for="name"
                            :value="__('Photo de profil')"
                        />
                    
                        <x-form.input
                                id="avatar"
                                class="block w-full"
                                type="file"
                                name="avatar"
                                :value="old('avatar')"
                                required
                                autofocus
                                placeholder="{{ __('Avatar') }}"
                            />
                        
                    </div>
                        <!-- Name -->
                    <div class="space-y-2">
                            <x-form.label
                                for="name"
                                :value="__('Nom et prénoms')"
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
                                    :value="old('name')"
                                    required
                                    autofocus
                                    placeholder="{{ __('Nom et prénoms') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                    </div>
                 </div>
                
                <div class="grid grid-cols-1  gap-6">
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
                                    :value="old('email')"
                                    required
                                    placeholder="{{ __('Email') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                    </div>

                        <!-- Birthday -->
                    <div class="space-y-2 birth">
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
                                    :value="old('birthday')"
                                    required
                                    placeholder="{{ __('Date de naissance') }}"
                                />
                 
                               <!--  <x-form.input
                                    withicon
                                    data-beatpicker="true"
                                    data-beatpicker-extra="customOptions"
                                    data-beatpicker-module="footer"
                                    data-beatpicker-position="['*','*']"
                                    data-beatpicker-disable="{from:[2006,1,1],to:'>'},{from:[1977,12,31],to:'<'}"
                                    data-beatpicker-format="['DD','MM','YYYY'],separator:'-'"
                                    id="birthday"
                                    class="block w-full"
                                    type="text"
                                    name="birthday"
                                    :value="old('birthday')"
                                    required
                                    placeholder="{{ __('Date de naissance') }}"
                                /> -->
                            
                            </x-form.input-with-icon-wrapper>    
                            
                    </div>
                </div>

                <div class="grid grid-cols-1  gap-6">
                        <!-- phone -->
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
                                    type="tel"
                                    name="phone"
                                    :value="old('phone')"
                                    required
                                    placeholder="{{ __('Téléphone') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                           

                            
                     </div>


                    @php($data = \App\Models\Pays::get())
                    
                        <div class="space-y-2">
                            <x-form.label
                                for="nationalite"
                                :value="__('Nationalité')"
                            />
                                        <select name="nationalite" required class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 @error('pays_id') border-red-500 @enderror">
                                            <option value="" {{old('nationalite')=='' ? 'selected':''}}>Selectionnez</option>
                                            
                                            @php($paysArray = array())

                                            @foreach($data as $pays)
                                            @php($paysArray[] = $pays->name)
                                            @endforeach

                                            @php (sort($paysArray))

                                            @foreach($paysArray as $pays)
                                            @if(strpos($pays, ':') !== false)
                                            @php($class='hide-country')
                                            @else
                                            @php($class='')
                                            @endif
                                            <option value="{{$pays}}" class="{{$class}}" {{old('nationalite')==$pays ? 'selected':''}}>{{$pays}}</option>
                                            @endforeach
                                           
                                        </select>
                        </div>
                        @error('nationalite')
                        <div class="text-red-600">{{$message}}</div>
                        @enderror


                        <!-- Adresse -->
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
                                    :value="old('address')"
                                    placeholder="{{ __('Adresse') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                    </div>
                </div>

                <div class="grid grid-cols-1  gap-6">
                        <!-- Password -->
                    <div class="space-y-2">
                            <x-form.label
                                for="password"
                                :value="__('Mot de passe')"
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
                                    <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="password_confirmation"
                                    class="block w-full"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    placeholder="{{ __('Confirmez le mot de passe') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                    </div>
                 </div>

                 <div class="grid grid-cols-1 gap-6">
                     @php($year = \App\Models\Edition::where('status', 1)->first())
                    <div class="space-y-2 forcond">
                            <x-form.input
                                id="check-cond"
                                class="block check-cond"
                                type="checkbox"
                                name="conditions"
                                required
                            />
                            <label for="conditions">
                                <a id="mySizeChart">
                                Je confirme avoir pris connaissance des conditions de participation au Prix Pierre Castel {{ $year->year }}
                                </a>
                            </label>
                         
                    </div>
                 </div>

                        <div class="btn-register">
                            <x-button class="justify-center w-full gap-2">
                                <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                                <span>{{ __('S\'enregistrer') }}</span>
                            </x-button>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Déjà enregistré ?') }}
                            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                                {{ __('Se connecter') }}
                            </a>
                        </p>
                </div>
                </div>
        </form>
  
        


<div id="mySizeChartModal" class="ebcf_modal">

  <div class="ebcf_modal-content">
    <span class="ebcf_close">&times;</span>
    <iframe src="{{asset('Prix-Pierre-Castel-2023-Reglement-et-calendrier.pdf')}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>

  </div>

</div>

</x-guest-layout>
