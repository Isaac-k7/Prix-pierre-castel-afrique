<x-app-layout>
<div >  
      
        <x-slot name="header">
        @if($data)
          <div > 
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('message'))
                    <div class="bg-green-300 text-green-700 rounded px-2 py-3">
                        {{Session::get('message')}}
                    </div>
                    @endif
                </div>
                <div class="col-md-6">
                   <div class="gap-4 md:flex-row md:items-center md:justify-between info-users">
                        <div class="grid justify-items-stretch my-3">
                            @if($data->users->getFirstMediaUrl('avatar_user','thumb'))
                                <img src="{{ $data->users->getFirstMediaUrl('avatar_user','thumb') }}" alt="" srcset="">
                                @endif
                        </div>
                        <div class="grid justify-items-stretch my-3">
                            <h2 class="text-xl font-semibold leading-tight ">
                                {{ $data->users->name }}
                            </h2>
                              {{ $data->users->email }}<br>
                            {{ $data->users->address }} | {{ $data->pays->name }}<br>
                            @php($newDate ='')
                            @if($data->users->birthday)
                            @php($newDate = \Carbon\Carbon::createFromFormat('Y-m-d', $data->users->birthday)->format('d/m/Y'))
                            @endif
                            
                            Née le : {{ $newDate ? $newDate : '' }}<br>
                            Tel : {{ $data->users->phone }}<br>
                         
                         Edition: {{ $data->edition->year }}

                        </div>
                        
                    
                    </div>

                </div> 
                <div class="col-md-6">
                    @if($data)
                        <div class="gap-4 md:flex-row md:items-center md:justify-between actions-btn">
                                 @php($userrole = Auth::user()->role->slug)
                                 @if($userrole =='admin' && $data->status == 3 && $data->preselected == 0 )
                                    <div class="grid justify-items-stretch my-3">
                                       <form method="post" action="{{route('candidats.preselection', [$data->id])}}" id="preselectForm">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="preselected" value="1">
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end" onclick="event.preventDefault(); if(confirm('Êtes-vous sûre?')) {document.getElementById('preselectForm').submit();} else {return false;} "> {{_('Présélectionner')}} </button>
                                         </form>
                                            
                                    </div>
                                @endif

                                @if($userrole =='filiale' && $data->preselected == 0 )
                                 <p><i>{{_("Le candidat n'a pas encore présélectionné par l'administrateur")}}</i> </p>
                                @endif

                         @if($data->preselected == 1 ) 
                                @if($data->status == 0 ) 
                                @php($class="d-none")
                                @endif

                                @if($data->status == 1 ) 
                                @php($class="d-none")
                                @endif

                                @if($data->status == 2 ) 
                                @php($class="d-none")
                                @endif

                                @if($data->status == 3) 
                                @php($class="")
                                @endif
                                    <div class="grid justify-items-stretch {{ $class }} my-3">
                                       <form method="post" action="{{route('candidats.update', [$data->id])}}" id="acceptForm">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end" onclick="event.preventDefault(); if(confirm('Are you sure to accept?')) {document.getElementById('acceptForm').submit();} else {return false;} ">{{_('Acceptée')}} </button>
                                           
                                        </form>
                                    </div>
                            
                                    <div class="grid justify-items-stretch {{ $class }} my-3">
                              
                                        <button data-route="{{route('candidats.update', [$data->id])}}" id="reject"  class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end" onclick="rejectConfirmation({{$data->id}})">{{_('Rejetée')}} </button>
                                    </div>

                                    <div class="grid justify-items-stretch {{ $class }} my-3">
                                        <form method="post" action="{{route('candidats.update', [$data->id])}}" id="draftForm">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="0">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end" onclick="event.preventDefault(); if(confirm('Are you sure put in draft?')) {document.getElementById('draftForm').submit();} else {return false;} "> {{_('Brouillon')}} </button>
                                        </form>
                                    
                                    </div>
                           @endif
                        </div>
                    
                        <div class="gap-4 md:flex-row md:items-center md:justify-between">
                            <div class="grid justify-items-stretch my-3">
                                <span class="flex justify-self-end"><strong>{{_('Statut')}} </strong></span>
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
                                    <span class="flex justify-self-end black">
                                    <i class="fa fa-battery-empty"></i>  &nbsp; {{_('En attente de validation')}} 
                                    </span>
                                @endif
                            </div>
                            <div class="grid justify-items-stretch my-3" style="text-align: right;">
                                <a href="mailto:{{ $data->users->email }}" target="_blank" rel="noopener noreferrer">Envoyez un email à {{ $data->users->name }}</a>
                            </div>
                        </div>
                     @endif

                </div> 
                  
            </div>    
           
           </div>
        @endif
        </x-slot>
  
@if($data)  
    <div class="space-y-6">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    CV
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
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No document ') }}</div>
                            @endif

                        @endif
                    @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                    @endif
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Copie de la pièce d’identité
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
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                            @endif
                                
                            @endif
                    @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                    @endif
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Présentation juridique de l’entreprise
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
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                            @endif

                            @endif
                        @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                    @endif
                    </div>
                    </div>
            </div>

            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        Présentation commerciale de l’entreprise 
                    </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-collapseFour" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">  
                    @if($data)        
                        @if($data->getFirstMediaUrl('candidat_juridique_commerciale'))

                            @php ( $mediaItems = $data->getMedia('candidat_juridique_commerciale'))

                           
                            @if($mediaItems[0]->getTypeFromExtension() == 'image')
                            <img src="{{$mediaItems[0]->original_url}}"/>
                            @elseif($mediaItems[0]->getTypeFromExtension() == 'pdf')
                            <iframe src="{{$mediaItems[0]->original_url}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            @else
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                            @endif

                            @endif
                        @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                    @endif
                    </div>
                    </div>
            </div>

            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                        Présentation de l’exercice N-1 des éléments financiers de l’entreprise
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
                                <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                                @endif

                                @endif
                        @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                    @endif
                    </div>
                    </div>
            </div>
            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                        Présentation détaillée du projet de développement à soutenir 
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
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                            @endif

                            @endif
                        @else
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                      @endif
                      </div>
                    </div>
            </div>


            <br><br>
                            <h5>Documents facultatifs </h5>
                            
            
            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                       Quelques images de l'activité
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
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                            @endif
                        @endif
                        </div>
                    </div>
            </div>


            <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingHeight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseHeight" aria-expanded="false" aria-controls="flush-collapseHeight">
                       Logo et réseaux sociaux de l'entreprise
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
                                    @foreach ($mediaItems as $mediaItem)
                                    <img src="{{$mediaItem->original_url}}"/>
                                  
                                    @endforeach
                                    </div>

                                    <div class="col-md-9">
                                        @php($link = json_decode($data->lien_rx))
                                        @if($link)
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
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap">{{ __('No data to display') }}</div>
                        @endif
                      @endif
                    </div>
                </div>
             </div>

            </div>

       </div>
      </div>
    @endif
    </div>

<!-- SweetAlert2 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>

<script>
     function rejectConfirmation(id) {
 
        var button = $("#reject");
        var sa_title;
        var sa_type;
        var sa_msg;
        Swal.fire({
            title: "<h6>Motif du rejet</h6>",
            input: "textarea",
            inputPlaceholder: "Laissez vide si il n'y a pas de motif et valider...",
            showCancelButton: true,
            confirmButtonColor: "#1FAB45",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Valider",
            cancelButtonText: "Annuler",
            buttonsStyling: true,
         /*    inputValidator: function(textarea) {
								if (textarea.length<1) {
                                    return !textarea && 'Veuillez entrer un motif!'
								}
            }, */
            preConfirm: function(textarea) {
            
                return new Promise(function(resolve, reject) {

                    // Make jQuery Ajax-request
                    $.ajax({
                        //data       : {'telephone=' + text +'telephone=' + text},
                        data       : {note:textarea, id:id, status:2, _method: 'PUT'},
                        dataType   : 'json',
                        method     : 'POST',
                        url        : button.data('route'),
                    
                        beforeSend: function (request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function(){
                                    location.reload();
                                },2000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        /* 	sa_title = 'Success!';
                            sa_msg = ' Candidature rejété.';
                            sa_type = 'success';
                            resolve(); */
                        },
                        error: function(response) {
                            // Set content for failure-sweetalert
                            sa_title = 'Oops!';
                            sa_msg = 'Quelque chose s\'est mal passé. Veuillez réessayer ou nous contacter.';
                            sa_type = 'error';
                            reject('Veuillez réessayer');
                        }
                    });
                });
            },
            allowOutsideClick: true
        }).then(function () {       
            swal({
							title: sa_title,
							html: sa_msg + "",
							type: sa_type
						}).then(function() {
						}).catch(swal.noop());
       
        }, 
        function (dismiss) {
        if (dismiss === "cancel") {
            swal(
            "Cancelled",
                "Canceled Note",
            "error"
            )
        }
        })

    }
</script>
</x-app-layout>
