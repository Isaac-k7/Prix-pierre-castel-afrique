<x-candidat-layout>
   
        <x-slot name="header">
            <div class="gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight text-center">
                    {{ __('Modifier ma candidature') }}
                </h2>
               
            
            </div>
        </x-slot>
     <div class="space-y-6">
    @if($data)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p>
                    <strong>NB:</strong> <i>Laissez le champ vide si vous ne voulez pas le modifier.</i> 
                </p>
       
           <form method="POST" action="{{ route('candidature.update', [$data->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6" id="cand-form">
                    
                       
                    <!-- Photo et CV-->
                    <div class="grid grid-cols-1 gap-6">

                    <div class="space-y-2">
                             <x-form.label
                                    for="pays_id"
                                    :value="__('Select country')"
                                />
                                <select name="pays_id" required class="form-control focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 @error('pays_id') border-red-500 @enderror">
                                    <option value="" {{old('pays_id')=='' ? 'selected':''}}>select</option>
                                    @foreach($datapays as $pays)
                                        <option value="{{$pays->id}}" {{$data->pays->id==$pays->id ? 'selected':''}}>{{$pays->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('pays_id')
                            <div class="text-red-600">{{$message}}</div>
                            @enderror
                      

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
                                  <!--   <x-heroicon-o-camera aria-hidden="true" class="w-5 h-5" /> -->
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="identite"
                                    class="block w-full form-control"
                                    type="file"
                                    name="identite"
                                    :value="old('identite')"
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
                                    <!-- <x-heroicon-o-document-duplicate aria-hidden="true" class="w-5 h-5" /> -->
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="juridique_entreprise"
                                    class="block w-full form-control"
                                    type="file"
                                    name="juridique_entreprise"
                                    :value="old('juridique_entreprise')"
                                    placeholder="{{ __('Présentation juridique de mon entreprise (pdf)') }}"
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
                                    placeholder="{{ __('Présentation commerciale de mon entreprise (pdf)') }}"
                                />
                                <x-form.error :messages="$errors->get('juridique_commerciale')" />
                            </x-form.input-with-icon-wrapper>
                        </div>

                        <div class="space-y-2">
                            <x-form.label
                                for="exercice"
                                :value="__('Présentation des états financiers de mon entreprise à N-1 (pdf)')"
                            />

                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                  <!--   <x-heroicon-o-document-duplicate aria-hidden="true" class="w-5 h-5" /> -->
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="exercice"
                                    class="block w-full form-control"
                                    type="file"
                                    name="exercice"
                                    :value="old('exercice')"
                                    placeholder="{{ __('Présentation des états financiers de mon entreprise à N-1 (pdf)') }}"
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
                                 <!--    <x-heroicon-o-document-duplicate aria-hidden="true" class="w-5 h-5" /> -->
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="details_projet"
                                    class="block w-full form-control"
                                    type="file"
                                    name="details_projet"
                                    :value="old('details_projet')"
                                    placeholder="{{ __('Présentation détaillée de mon projet de développement (pdf)') }}"
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
                            <div class="grid grid-cols-1 row">
                                    @if($data)
                                        @if($data->getMedia('candidat_logo_entreprise'))
                                            
                                                <div class="col-md-2"> 
                                                <img src="{{$data->getFirstMediaUrl('candidat_logo_entreprise')}}"/>
                                                </div>
                                        @else
                                        
                                        @endif
                                    @endif
                                <div class="space-y-2 col-md-10">
                                    <x-form.label
                                        for="logo_entreprise"
                                        :value="__('Changer le logo de mon entreprise')"
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
                            </div>
                            <div class="grid grid-cols-1 mt-5">

                                <div class="space-y-2">
                                    <x-form.label
                                        for="images_activity"
                                        :value="__('Ajouter des images de mon activité')"
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
                                            placeholder="{{ __('Ajouter des images de mon activité') }}"
                                        />
                                        <x-form.error :messages="$errors->get('images_activity')" />
                                    </x-form.input-with-icon-wrapper>
                                </div>

                                <div class="accordion-item " id="editactivimg">
                                    <h2 class="accordion-header" id="flush-headingSeven">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                    Voir ou retirer des images de l'activité
                                    </button>
                                    </h2>
                                    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                        @if($data)
                                          
                                                @php ( $mediaItems = $data->getMedia('images_activity'))
                                                <div class="col-md-12">
                                                    <div class="row"> 
                                                    @forelse ($mediaItems as $mediaItem)
                                                   
                                                    <div class="activ-img slide col-md-4" id="imgRow" > 
                                                        <img src="{{$mediaItem->original_url}}"/>
                                                        <button class="btn btn-danger" id="DeleteImg" type="button" data-id="{{$mediaItem->uuid}}" data-url="{{ route('candidat.media', $mediaItem->uuid) }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    @empty
                                                       <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune image') }}</div>
                                                    @endforelse
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                        @endif
                                        </div>
                                    </div>
                            </div>

                                

                            
                            </div>

                            <div class="grid  grid-cols-1 gap-6 mt-10">
                                <div class="panel panel-default">

                                       <div class="panel-heading">Site web et réseaux sociaux de mon entreprise</div><br>
                                        <div class="panel-body">
                                    

                                              <div class="col-lg-12 space-y-2">
                                                   
                                                @if($data->lien_rx)   
                                                            @php($link = json_decode($data->lien_rx))
                                                            
                                                            @foreach ($link as $lien)
                                                                <div id="row">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <button class="btn btn-danger"
                                                                                id="DeleteRow" type="button">
                                                                                <i class="fa fa-trash"></i>
                                                                            
                                                                            </button>
                                                                        </div>
                                                                        <select name="source_lien[]" id="source_lien" required class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 @error('source_lien') border-red-500 @enderror">
                                                                
                                                                            <option value="{{$lien->source}}" >{{$lien->source}}</option>
                                                                         
                                                                        
                                                                        </select>
                                                                      
                                                                         <x-form.input
                                                                            id="lien_rx"
                                                                            class="block w-full form-control py-0"
                                                                            type="text"
                                                                            name="lien_rx[]"
                                                                            :value="old('lien_rx',  $lien->lien)"
                                                                        />
                                                                            
                                                                    
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                       @endif     
                                                    <div id="newinput"></div>
                                                    
                                                    <button id="rowAdder" type="button"
                                                        class="btn btn-dark">
                                                        <i class="fa fa-plus"></i>
                                                      
                                                    </button>
                                                   

                                            </div>
                                            <div class="clear"></div>
                                    
                                        </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white   focus:outline-none focus:ring-2 focus:ring-offset-2 btn-mitsu">
                        Modifier
                    </button>
                </div>
            </div>
        </form>
      </div>

    @else
     <p>{{_('Aucun candidature soumise')}}</p>
    @endif
</div>


<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>


<script type="text/javascript">
 
 $("#rowAdder").click(function () {
     newRowAdd =
     '<div id="row"> <div class="input-group ">' +
     '<div class="input-group-prepend">' +
     '<button class="btn btn-danger" id="DeleteRow" type="button">' +
     '<i class="fa fa-trash"></i> </button> </div>' +
     '<select name="source_lien[]" id="source_lien" required class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 "><option value="Site Web" >Site Web</option><option value="Facebook" >Facebook</option><option value="Twitter" >Twitter</option><option value="LinkedIn" >LinkedIn</option><option value="Instagram" >Instagram</option></select>' +
     '<input type="text" class="form-control px-4 m-input" value="{{ old('"lien_rx.0"', '') }}" name="lien_rx[]" placeholder="Ajouter un lien"> </div> </div>';

     $('#newinput').append(newRowAdd);
 });

 $("body").on("click", "#DeleteRow", function () {
     $(this).parents("#row").remove();
 })

 $(document).ready(function () {
            // delete on image
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("body").on("click", "#DeleteImg", function () {
                var userURL = $(this).data('url');
                var trObj = $(this);
            
                    if(confirm("Voulez-vous vraiment supprimer cette image ?") == true){
                            $.ajax({
                                url: userURL,
                                type: 'DELETE',
                                dataType: 'json',
                                success: function(data) {
                                    //alert(data.success);
                                    trObj.parents("#imgRow").remove();
                                }
                            });
                    }
            })
  });
</script>
</x-candidat-layout>

