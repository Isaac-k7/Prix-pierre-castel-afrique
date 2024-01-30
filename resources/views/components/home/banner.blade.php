<div class="flex-shrink-0 " id="banner">
        <div class="bg-head-home">
            <div class="design-home flex items-center justify-center gap-1 text-sm text-gray-600 dark:text-gray-400">
                <div class="center-banner">
                   @php($edition = \App\Models\Edition::where('status',1)->first())
                   <h1> 
                    @if ($edition)
                        {{ $edition->name }} <br>Edition {{ $edition->year }} 
                    @endif
                   </h1> 
                   <p>
                    @if ($edition)
                    <a href="{{ route('getcandidat-view') }}" class="LinkIn bouton3"> <strong>S'inscrire</strong></a>
                    @endif
            
                </p>
                </div>
            </div>
                
        </div>
         
        <div class="flex-shrink-0">
             <img src="{{ asset('assets/images/fdd_pc_sans_logo.jpeg') }}" >
        </div>

</div>
