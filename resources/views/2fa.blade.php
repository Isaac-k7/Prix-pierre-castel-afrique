<x-guest-layout>
<x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <div id="my-content" class="relative items-top justify-center  bg-gray-100 dark:bg-gray-900 sm:items-center py-20 sm:pt-0">

        
            <div class="card">
                <div class="card-header"> Verification de l'authentification à 2 facteurs</div>
  
                <div class="card-body">
                    <form method="POST" action="{{ route('2fa.post') }}">
                        @csrf
                      
                        <p class="text-center">Confirmez qu'il s'agit bien de vous en entrant le code d'identification qui vous a été envoyé sur : {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->email,  -2) }}</p>
                   
                        @if ($message = Session::get('success'))
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                      <strong>{{ $message }}</strong>
                                  </div>
                              </div>
                            </div>
                        @endif
  
                        @if ($message = Session::get('error'))
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                      <strong>{{ $message }}</strong>
                                  </div>
                              </div>
                            </div>
                        @endif
  
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">Entrez le Code</label>
  
                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>
  
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
  
                        <div class="form-group row mb-0 py-10 my-6">
                            <div class="col-md-6 ">
                                <a class="btn btn-link" href="{{ route('2fa.resend') }}">Renvoyez le code?</a>
                            </div>
                    
                            <div class="col-md-6 ">
                            <x-button class="jpx-4 py-3 bg-gray-50 text-right sm:px-6">
                                <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                                <span>{{ __('Valider') }}</span>
                            </x-button>
                               
  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
  
</x-auth-card>
</x-guest-layout>