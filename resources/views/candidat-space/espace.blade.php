<x-candidat-layout>
      
         <x-slot name="header">
            <div class="gap-4 md:flex-row md:items-center md:justify-between">
            
                <h2 class="text-xl font-semibold leading-tight ">
                    {{ __('Mon espace') }}
                </h2>
            
            </div>

            @if($data && $data->status == 0)
            <div class="gap-4 md:flex-row md:items-center md:justify-between">
                <div class="grid justify-items-stretch my-3">
                       <form method="post" action="{{route('candidats.validation', [$data->id])}}" id="validForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="3">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end" onclick="event.preventDefault(); if(confirm('Êtes-vous sur de vouloir valider ?')) {document.getElementById('validForm').submit();} else {return false;} ">{{_('Je valide ma candidature')}} </button>
                            <p> <i>(*) Une fois validée, vous ne pouvez plus la modifier</i> </p>
                        </form>
                </div>
             </div>
            @endif 
            @if($data)
            <div class="gap-4 md:flex-row md:items-center md:justify-between">
                <div class="grid justify-items-stretch my-3">
                    <span class="flex justify-self-end"><strong>{{_('Statut de votre candidature')}}  </strong></span>
                    @if($data->status ==0)
                        <span class="flex justify-self-end orange">
                        <i class="fa fa-battery-empty"></i>  &nbsp;{{_('Brouillon')}} 
                        </span>
                    @endif
                    @if($data->status ==1)
                        <span class="flex justify-self-end vert">
                        <i class="fa fa-battery-full"></i>  &nbsp;  {{_('Candidature Validée')}} 
                        </span>
                    @endif
                    @if($data->status ==2)
                        <span class="flex justify-self-end rouge">
                        <i class="fa fa-battery-empty"></i>  &nbsp; {{_('Candidature rejétée')}} 
                        </span>
                    @endif
                    @if($data->status ==3)
                        <span class="flex justify-self-end orange">
                        <i class="fa fa-battery-empty"></i>  &nbsp;{{_('En attente de validation')}} 
                        </span>
                    @endif
                </div>
             </div>
            @endif
           
        </x-slot>
       
    <div class="space-y-6">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Mon CV
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                @if($data)
                        @if($data->getFirstMediaUrl('candidat_cv'))

                            @php ( $mediaItems = $data->getMedia('candidat_cv'))
                           
                            @if($mediaItems[0]->getTypeFromExtension() == 'image')
                            <img src="{{$mediaItems[0]->original_url}}"/>
                            @elseif($mediaItems[0]->getTypeFromExtension() == 'pdf')
                            <iframe src="{{$mediaItems[0]->original_url}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            @else
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucun document ') }}</div>
                            @endif

                        @endif
                    @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                    @endif
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Copie de ma pièce d'identité
                </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                    @if($data)
                            @if($data->getFirstMediaUrl('candidat_identite'))

                            @php ( $mediaItems = $data->getMedia('candidat_identite'))

                            {{--$mediaItems[0]->id--}}<br>
                            @if($mediaItems[0]->getTypeFromExtension() == 'image')
                            <img src="{{$mediaItems[0]->original_url}}"/>
                            @elseif($mediaItems[0]->getTypeFromExtension() == 'pdf')
                            <iframe src="{{$mediaItems[0]->original_url}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            @else
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                            @endif
                                
                            @endif
                    @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                    @endif
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                       Présentation juridique de mon entreprise
                    </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                    @if($data)
                        @if($data->getFirstMediaUrl('candidat_juridique_entreprise'))

                            @php ( $mediaItems = $data->getMedia('candidat_juridique_entreprise'))

                            {{--$mediaItems[0]->id--}}<br>
                            @if($mediaItems[0]->getTypeFromExtension() == 'image')
                            <img src="{{$mediaItems[0]->original_url}}"/>
                            @elseif($mediaItems[0]->getTypeFromExtension() == 'pdf')
                            <iframe src="{{$mediaItems[0]->original_url}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            @else
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                            @endif

                            @endif
                        @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                    @endif
                    </div>
                    </div>
            </div>

            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    Présentation commerciale de mon entreprise
                    </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-collapseFour" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">  
                    @if($data)        
                        @if($data->getFirstMediaUrl('candidat_juridique_commerciale'))

                            @php ( $mediaItems = $data->getMedia('candidat_juridique_commerciale'))

                            {{--$mediaItems[0]->id--}}<br>
                            @if($mediaItems[0]->getTypeFromExtension() == 'image')
                            <img src="{{$mediaItems[0]->original_url}}"/>
                            @elseif($mediaItems[0]->getTypeFromExtension() == 'pdf')
                            <iframe src="{{$mediaItems[0]->original_url}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            @else
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                            @endif

                            @endif
                        @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                    @endif
                    </div>
                    </div>
            </div>

            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                    Présentation des états financiers de mon entreprise à N-1
                    </button>
                    </h2>
                    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                    @if($data)  
                        @if($data->getFirstMediaUrl('candidat_exercice'))

                                @php ( $mediaItems = $data->getMedia('candidat_exercice'))

                                {{--$mediaItems[0]->id--}}<br>
                                @if($mediaItems[0]->getTypeFromExtension() == 'image')
                                <img src="{{$mediaItems[0]->original_url}}"/>
                                @elseif($mediaItems[0]->getTypeFromExtension() == 'pdf')
                                <iframe src="{{$mediaItems[0]->original_url}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                                @else
                                <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                                @endif

                                @endif
                        @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                    @endif
                    </div>
                    </div>
            </div>
            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                    Présentation détaillée de mon projet de développement
                    </button>
                    </h2>
                    <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                    @if($data)
                        @if($data->getFirstMediaUrl('candidat_details_projet'))

                            @php ( $mediaItems = $data->getMedia('candidat_details_projet'))

                            {{--$mediaItems[0]->id--}}<br>
                            @php($ext = pathinfo($mediaItems[0]->original_url, PATHINFO_EXTENSION))
                            @if($mediaItems[0]->getTypeFromExtension() == 'image')
                            <img src="{{$mediaItems[0]->original_url}}"/>
                            @elseif($mediaItems[0]->getTypeFromExtension() == 'pdf')
                            <iframe src="{{$mediaItems[0]->original_url}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            @else
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                            @endif

                            @endif
                        @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                    @endif
                    </div>
                    </div>
            </div>

            <br><br>
                            <h5>Documents facultatifs </h5>
                            
            
            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                    Quelques images de mon activité
                    </button>
                    </h2>
                    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        @if($data)
                            @if($data->getMedia('images_activity'))

                                @php ( $mediaItems = $data->getMedia('images_activity'))
                                <div class="col-md-12">
                                    <div class="row">
                                    @foreach ($mediaItems as $mediaItem)
                                    <div class="activ-img slide col-md-4"> 
                                    <img src="{{$mediaItem->original_url}}"/>
                                    </div>
                                    @endforeach
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                
                            
                            @else
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                            @endif
                        @endif
                        </div>
                    </div>
            </div>


            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingHeight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseHeight" aria-expanded="false" aria-controls="flush-collapseHeight">
                    Logo et réseaux sociaux de mon entreprise
                    </button>
                    </h2>
                    <div id="flush-collapseHeight" class="accordion-collapse collapse" aria-labelledby="flush-headingHeight" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      @if($data)
                        @if($data->getMedia('candidat_logo_entreprise'))

                            @php ( $mediaItems = $data->getMedia('candidat_logo_entreprise'))

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3" id="logo_company">
                                        <img src="{{$data->getFirstMediaUrl('candidat_logo_entreprise')}}"/>
                                    </div>

                                    <div class="col-md-9">
                                        @if($data->lien_rx)
                                        @php($link = json_decode($data->lien_rx))
                                        <ul>
                                          @foreach ($link as $lien)
                                             <li><a href="{{ $lien->lien }}" target="_blank">{{ $lien->source }}</a></li>
                                           @endforeach
                                        </ul>
                                        @endif
                                    </div> 
                              
                                </div>
                                <div class="clear"></div>
                            </div>
                            
                           
                        @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('Aucune donnée') }}</div>
                        @endif
                      @endif
                    </div>
                </div>
             </div>

            </div>
       <div class="clear"></div>
    </div>
</x-candidat-layout>

