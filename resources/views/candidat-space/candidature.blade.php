<x-candidat-layout>
        <x-slot name="header">
            <div class="gap-4 md:flex-  md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight text-center">
                    {{ __('Soumettre ma candidature') }}
                </h2>
            
            </div>
        </x-slot>
     <div class="space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       
        <form method="POST" action="{{ route('candidature.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6" id="cand-form">
                    
                       
                    <!-- Photo et CV-->
                    <div class="grid grid-cols-1 gap-6">

                       <div class="space-y-2">
                            <x-form.label
                                for="pays_id"
                                :value="__('Select country')"
                            />
                           
                                <select name="pays_id" required class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 @error('pays_id') border-red-500 @enderror">
                                    <option value="" {{old('pays_id')=='' ? 'selected':''}}>Select country</option>
                                        @php
                                        $data = collect($data)->sortBy('name')->all();
                                        @endphp

                                        @foreach($data as $pays)
                                            @if(strpos($pays->name, '(RDC)') !== false)
                                                @php($class='hide-country')
                                            @else
                                                @php($class='')
                                            @endif
                                            <option value="{{$pays->id}}"  class="{{$class}}" {{old('pays_id')==$pays->id ? 'selected':''}}>{{$pays->name}}</option>
                                        @endforeach

                                </select>
                        </div>
                      

                        <div class="space-y-2">
                            <x-form.label
                                for="cv"
                                :value="__('Mon CV (pdf)')"
                            />

                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                   <!--  <x-heroicon-o-document-duplicate aria-hidden="true" class="w-5 h-5" /> -->
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="cv"
                                    class="block w-full form-control"
                                    type="file"
                                    name="cv"
                                    :value="old('cv')"
                                    placeholder="{{ __('Mon CV') }}"
                                />
                                <x-form.error :messages="$errors->get('cv')" />
                            </x-form.input-with-icon-wrapper>
                        </div>


                    </div>

                    <!-- Copie de le pièce et Présentation juridique-->
                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-2">
                            <x-form.label
                                for="identite"
                                :value="__('Copie de ma pièce d\'identité')"
                            />

                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <!-- <x-heroicon-o-camera aria-hidden="true" class="w-5 h-5" /> -->
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="identite"
                                    class="block w-full form-control"
                                    type="file"
                                    name="identite"
                                    :value="old('identite')"
                                    required
                                    placeholder="{{ __('Copie de ma pièce d\'identité') }}"
                                />
                                <x-form.error :messages="$errors->get('identite')" />
                            </x-form.input-with-icon-wrapper>
                        </div>

                        <div class="space-y-2">
                            <x-form.label
                                for="juridique_entreprise"
                                :value="__('Présentation juridique de mon entreprise (pdf)')"
                            />

                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                   <!--  <x-heroicon-o-document-duplicate aria-hidden="true" class="w-5 h-5" /> -->
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="juridique_entreprise"
                                    class="block w-full form-control"
                                    type="file"
                                    name="juridique_entreprise"
                                    :value="old('juridique_entreprise')"
                                    required
                                    placeholder="{{ __('Présentation juridique de mon entreprise') }}"
                                />
                                <x-form.error :messages="$errors->get('juridique_entreprise')" />
                            </x-form.input-with-icon-wrapper>
                        </div>


                    </div>

                    <!-- Une présentation commerciale de l’entreprise et Une présentation de l’exercice N-1-->
                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-2">
                            <x-form.label
                                for="juridique_commerciale"
                                :value="__('Présentation commerciale de mon entreprise (pdf)')"
                            />

                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                   <!--  <x-heroicon-o-document-duplicate aria-hidden="true" class="w-5 h-5" /> -->
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="juridique_commerciale"
                                    class="block w-full form-control"
                                    type="file"
                                    name="juridique_commerciale"
                                    :value="old('juridique_commerciale')"
                                    required
                                    placeholder="{{ __('Présentation commerciale de mon entreprise') }}"
                                />
                                <x-form.error :messages="$errors->get('juridique_commerciale')" />
                            </x-form.input-with-icon-wrapper>
                        </div>

                        <div class="space-y-2">
                            <x-form.label
                                for="exercice"
                                :value="__('Présentation des états financiers de mon entreprise à N-1 (pdf) ')"
                            />

                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                   <!--  <x-heroicon-o-document-duplicate aria-hidden="true" class="w-5 h-5" /> -->
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="exercice"
                                    class="block w-full form-control"
                                    type="file"
                                    name="exercice"
                                    :value="old('exercice')"
                                    required
                                    placeholder="{{ __('Présentation des états financiers de mon entreprise à N-1') }}"
                                />
                                <x-form.error :messages="$errors->get('exercice')" />
                            </x-form.input-with-icon-wrapper>
                        </div>


                    </div>

                    <!-- Une présentation détaillée du projet -->
                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-2">
                            <x-form.label
                                for="details_projet"
                                :value="__('Présentation détaillée de mon projet de développement (pdf)')"
                            />

                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                   <!--  <x-heroicon-o-document-duplicate aria-hidden="true" class="w-5 h-5" /> -->
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="details_projet"
                                    class="block w-full form-control"
                                    type="file"
                                    name="details_projet"
                                    :value="old('details_projet')"
                                    required
                                    placeholder="{{ __('Présentation détaillée de mon projet de développement') }}"
                                />
                                <x-form.error :messages="$errors->get('details_projet')" />
                            </x-form.input-with-icon-wrapper>
                        </div>

                       
                    </div>

                    <div class="fac">
                        <hr>
                        <h5>Documents facultatifs </h5>
                         <br><br>
                          <!-- Une présentation détaillée du projet -->
                            <div class="grid grid-cols-1 gap-6">
                                <div class="space-y-2">
                                    <x-form.label
                                        for="logo_entreprise"
                                        :value="__('Logo de mon entreprise')"
                                    />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                        <!--  <x-heroicon-o-document-duplicate aria-hidden="true" class="w-5 h-5" /> -->
                                        </x-slot>

                                        <x-form.input
                                            withicon
                                            id="logo_entreprise"
                                            class="block w-full form-control"
                                            type="file"
                                            name="logo_entreprise"
                                            :value="old('logo_entreprise')"
                                            placeholder="{{ __('Logo de mon entreprise') }}"
                                        />
                                        <x-form.error :messages="$errors->get('logo_entreprise')" />
                                    </x-form.input-with-icon-wrapper>
                                </div>

                                <div class="space-y-2">
                                    <x-form.label
                                        for="images_activity"
                                        :value="__('Quelques images de mon activité')"
                                    />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                        <!--  <x-heroicon-o-document-duplicate aria-hidden="true" class="w-5 h-5" /> -->
                                        </x-slot>

                                        <x-form.input
                                            withicon
                                            id="images_activity"
                                            class="block w-full form-control"
                                            type="file"
                                            multiple
                                            name="images_activity[]"
                                            :value="old('images_activity')"
                                            placeholder="{{ __('Quelques images de mon activité') }}"
                                        />
                                        <x-form.error :messages="$errors->get('images_activity')" />
                                    </x-form.input-with-icon-wrapper>
                                </div>

                            
                            </div>

                            <div class="grid  grid-cols-1 gap-6 mt-10">
                                <div class="panel panel-default">

                                       <div class="panel-heading">Site web et réseaux sociaux de mon entreprise</div><br>
                                        <div class="panel-body">
                                    

                                              <div class="col-lg-12 space-y-2">
                                                    <div id="row">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-danger"
                                                                    id="DeleteRow" type="button">
                                                                    <i class="fa fa-trash"></i>
                                                                   
                                                                </button>
                                                            </div>
                                                            <select name="source_lien[]" id="source_lien" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 @error('source_lien') border-red-500 @enderror">
                                                                
                                                                <option value="Site Web" >Site Web</option>
                                                                <option value="Facebook" >Facebook</option>
                                                                <option value="Twitter" >Twitter</option>
                                                                <option value="LinkedIn" >LinkedIn</option>
                                                                <option value="Instagram" >Instagram</option>
                                                               
                                                            </select>
                                                            <x-form.input
                                                                id="lien_rx"
                                                                class="block w-full form-control py-0"
                                                                type="text"
                                                                name="lien_rx[]"
                                                                :value="old('lien_rx.0', '')"
                                                                placeholder="{{ __('Ajouter un lien') }}"
                                                            />
                                                           
                                                        </div>
                                                    </div>
                                
                                                    <div id="newinput"></div>
                                                    
                                                    <button id="Adder" type="button"
                                                        class="btn btn-dark">
                                                        <i class="fa fa-plus"></i> Ajouter
                                                      
                                                    </button>
                                                   

                                            </div>
                                            <div class="clear"></div>
                                    
                                        </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 py-3 gap-6">
                                    
                                    <div class="space-y-2 forcond">
                                            <x-form.input
                                                id="check-cond"
                                                class="block check-cond"
                                                type="checkbox"
                                                name="certified"
                                                required
                                            />
                                            <label for="certified">
                                                <a href="#" id="mySizeChart">
                                                  Je certifie que toutes les informations renseignées ci-dessus sont exactes
                                                </a>
                                            </label>
                                        
                                    </div>
                            </div>

                            <div class="grid grid-cols-1 gap-6">
                                    
                                    <div class="space-y-2 forcond">
                                            <x-form.input
                                                id="check-cond"
                                                class="block check-cond"
                                                type="checkbox"
                                                name="accepted"
                                                required
                                            />
                                            <label for="accepted">
                                                <a href="#" id="mySizeChart">
                                                	En soumettant ce formulaire, j'accepte que les informations saisies soient exploitées afin de traiter ma demande. 
                                                </a>
                                            </label>
                                        
                                    </div>
                            </div>

                            
                        </div>

                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white   focus:outline-none focus:ring-2 focus:ring-offset-2 btn-mitsu">
                        Soumettre
                    </button>
                </div>
            </div>
        </form>
</div>
</div>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>


<script type="text/javascript">
 
 $("#Adder").click(function () {
     newRowAdd =
     '<div id="row"> <div class="input-group ">' +
     '<div class="input-group-prepend">' +
     '<button class="btn btn-danger" id="DeleteRow" type="button">' +
     '<i class="fa fa-trash"></i> </button> </div>' +
     '<select name="source_lien[]" id="source_lien" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 "><option value="Site Web" >Site Web</option><option value="Facebook" >Facebook</option><option value="Twitter" >Twitter</option><option value="LinkedIn" >LinkedIn</option><option value="Instagram" >Instagram</option></select>' +
     '<input type="text" class="form-control px-4 m-input" value="{{ old('"lien_rx.0"', '') }}" name="lien_rx[]" placeholder="Ajouter un lien"> </div> </div>';

     $('#newinput').append(newRowAdd);
 });

 $("body").on("click", "#DeleteRow", function () {
     $(this).parents("#row").remove();
 })
</script>


</x-candidat-layout>

