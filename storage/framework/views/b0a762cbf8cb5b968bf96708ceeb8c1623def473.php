<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div >  
      
         <?php $__env->slot('header', null, []); ?> 
        <?php if($data): ?>
          <div > 
            <div class="row">
                <div class="col-md-12">
                    <?php if(Session::has('message')): ?>
                    <div class="bg-green-300 text-green-700 rounded px-2 py-3">
                        <?php echo e(Session::get('message')); ?>

                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                   <div class="gap-4 md:flex-row md:items-center md:justify-between info-users">
                        <div class="grid justify-items-stretch my-3">
                            <?php if($data->users->getFirstMediaUrl('avatar_user','thumb')): ?>
                                <img src="<?php echo e($data->users->getFirstMediaUrl('avatar_user','thumb')); ?>" alt="" srcset="">
                                <?php endif; ?>
                        </div>
                        <div class="grid justify-items-stretch my-3">
                            <h2 class="text-xl font-semibold leading-tight ">
                                <?php echo e($data->users->name); ?>

                            </h2>
                              <?php echo e($data->users->email); ?><br>
                            <?php echo e($data->users->address); ?> | <?php echo e($data->pays->name); ?><br>
                            <?php ($newDate =''); ?>
                            <?php if($data->users->birthday): ?>
                            <?php ($newDate = \Carbon\Carbon::createFromFormat('Y-m-d', $data->users->birthday)->format('d/m/Y')); ?>
                            <?php endif; ?>
                            
                            Née le : <?php echo e($newDate ? $newDate : ''); ?><br>
                            Tel : <?php echo e($data->users->phone); ?><br>
                         
                         Edition: <?php echo e($data->edition->year); ?>


                        </div>
                        
                    
                    </div>

                </div> 
                <div class="col-md-6">
                    <?php if($data): ?>
                        <div class="gap-4 md:flex-row md:items-center md:justify-between actions-btn">
                                 <?php ($userrole = Auth::user()->role->slug); ?>
                                 <?php if($userrole =='admin' && $data->status == 3 && $data->preselected == 0 ): ?>
                                    <div class="grid justify-items-stretch my-3">
                                       <form method="post" action="<?php echo e(route('candidats.preselection', [$data->id])); ?>" id="preselectForm">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <input type="hidden" name="preselected" value="1">
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end" onclick="event.preventDefault(); if(confirm('Êtes-vous sûre?')) {document.getElementById('preselectForm').submit();} else {return false;} "> <?php echo e(_('Présélectionner')); ?> </button>
                                         </form>
                                            
                                    </div>
                                <?php endif; ?>

                                <?php if($userrole =='filiale' && $data->preselected == 0 ): ?>
                                 <p><i><?php echo e(_("Le candidat n'a pas encore présélectionné par l'administrateur")); ?></i> </p>
                                <?php endif; ?>

                         <?php if($data->preselected == 1 ): ?> 
                                <?php if($data->status == 0 ): ?> 
                                <?php ($class="d-none"); ?>
                                <?php endif; ?>

                                <?php if($data->status == 1 ): ?> 
                                <?php ($class="d-none"); ?>
                                <?php endif; ?>

                                <?php if($data->status == 2 ): ?> 
                                <?php ($class="d-none"); ?>
                                <?php endif; ?>

                                <?php if($data->status == 3): ?> 
                                <?php ($class=""); ?>
                                <?php endif; ?>
                                    <div class="grid justify-items-stretch <?php echo e($class); ?> my-3">
                                       <form method="post" action="<?php echo e(route('candidats.update', [$data->id])); ?>" id="acceptForm">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end" onclick="event.preventDefault(); if(confirm('Are you sure to accept?')) {document.getElementById('acceptForm').submit();} else {return false;} "><?php echo e(_('Acceptée')); ?> </button>
                                           
                                        </form>
                                    </div>
                            
                                    <div class="grid justify-items-stretch <?php echo e($class); ?> my-3">
                              
                                        <button data-route="<?php echo e(route('candidats.update', [$data->id])); ?>" id="reject"  class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end" onclick="rejectConfirmation(<?php echo e($data->id); ?>)"><?php echo e(_('Rejetée')); ?> </button>
                                    </div>

                                    <div class="grid justify-items-stretch <?php echo e($class); ?> my-3">
                                        <form method="post" action="<?php echo e(route('candidats.update', [$data->id])); ?>" id="draftForm">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <input type="hidden" name="status" value="0">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end" onclick="event.preventDefault(); if(confirm('Are you sure put in draft?')) {document.getElementById('draftForm').submit();} else {return false;} "> <?php echo e(_('Brouillon')); ?> </button>
                                        </form>
                                    
                                    </div>
                           <?php endif; ?>
                        </div>
                    
                        <div class="gap-4 md:flex-row md:items-center md:justify-between">
                            <div class="grid justify-items-stretch my-3">
                                <span class="flex justify-self-end"><strong><?php echo e(_('Statut')); ?> </strong></span>
                                <?php if($data->status ==0): ?>
                                    <span class="flex justify-self-end orange">
                                    <i class="fa fa-battery-empty"></i>  &nbsp;<?php echo e(_('Brouillon')); ?> 
                                    </span>
                                <?php endif; ?>
                                <?php if($data->status ==1): ?>
                                    <span class="flex justify-self-end vert">
                                    <i class="fa fa-battery-full"></i>  &nbsp;  <?php echo e(_('Candidature Validée')); ?> 
                                    </span>
                                <?php endif; ?>
                                <?php if($data->status ==2): ?>
                                    <span class="flex justify-self-end rouge">
                                    <i class="fa fa-battery-empty"></i>  &nbsp; <?php echo e(_('Candidature rejétée')); ?> 
                                    </span>
                                <?php endif; ?>

                                <?php if($data->status ==3): ?>
                                    <span class="flex justify-self-end black">
                                    <i class="fa fa-battery-empty"></i>  &nbsp; <?php echo e(_('En attente de validation')); ?> 
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="grid justify-items-stretch my-3" style="text-align: right;">
                                <a href="mailto:<?php echo e($data->users->email); ?>" target="_blank" rel="noopener noreferrer">Envoyez un email à <?php echo e($data->users->name); ?></a>
                            </div>
                        </div>
                     <?php endif; ?>

                </div> 
                  
            </div>    
           
           </div>
        <?php endif; ?>
         <?php $__env->endSlot(); ?>
  
<?php if($data): ?>  
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
                <?php if($data): ?>
                        <?php if($data->getFirstMediaUrl('candidat_cv')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_cv')); ?>
                            
                            <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                            <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                            <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                            <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            <?php else: ?>
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No document ')); ?></div>
                            <?php endif; ?>

                        <?php endif; ?>
                    <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                    <?php endif; ?>
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
                    <?php if($data): ?>
                            <?php if($data->getFirstMediaUrl('candidat_identite')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_identite')); ?>

                            <br>
                            <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                            <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                            <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                            <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            <?php else: ?>
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                            <?php endif; ?>
                                
                            <?php endif; ?>
                    <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                    <?php endif; ?>
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
                    <?php if($data): ?>
                        <?php if($data->getFirstMediaUrl('candidat_juridique_entreprise')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_juridique_entreprise')); ?>

                            <br>
                            <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                            <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                            <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                            <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            <?php else: ?>
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                            <?php endif; ?>

                            <?php endif; ?>
                        <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                    <?php endif; ?>
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
                    <?php if($data): ?>        
                        <?php if($data->getFirstMediaUrl('candidat_juridique_commerciale')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_juridique_commerciale')); ?>

                           
                            <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                            <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                            <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                            <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            <?php else: ?>
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                            <?php endif; ?>

                            <?php endif; ?>
                        <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                    <?php endif; ?>
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
                    <?php if($data): ?>  
                        <?php if($data->getFirstMediaUrl('candidat_exercice')): ?>

                                <?php ( $mediaItems = $data->getMedia('candidat_exercice')); ?>

                                <br>
                                <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                                <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                                <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                                <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                                <?php else: ?>
                                <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                                <?php endif; ?>

                                <?php endif; ?>
                        <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                    <?php endif; ?>
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
                       <?php if($data): ?>
                        <?php if($data->getFirstMediaUrl('candidat_details_projet')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_details_projet')); ?>

                            <br>
                            <?php ($ext = pathinfo($mediaItems[0]->original_url, PATHINFO_EXTENSION)); ?>
                            <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                            <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                            <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                            <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            <?php else: ?>
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                            <?php endif; ?>

                            <?php endif; ?>
                        <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                      <?php endif; ?>
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
                        <?php if($data): ?>
                            <?php if($data->getMedia('images_activity')): ?>

                                <?php ( $mediaItems = $data->getMedia('images_activity')); ?>
                                <div class="col-md-12">
                                    <div class="row">
                                    <?php $__currentLoopData = $mediaItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mediaItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="activ-img slide col-md-4"> 
                                    <img src="<?php echo e($mediaItem->original_url); ?>"/>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                
                            
                            <?php else: ?>
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                            <?php endif; ?>
                        <?php endif; ?>
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
                      <?php if($data): ?>
                        <?php if($data->getMedia('candidat_logo_entreprise')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_logo_entreprise')); ?>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3" id="logo_company">
                                    <?php $__currentLoopData = $mediaItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mediaItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="<?php echo e($mediaItem->original_url); ?>"/>
                                  
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <div class="col-md-9">
                                        <?php ($link = json_decode($data->lien_rx)); ?>
                                        <?php if($link): ?>
                                        <ul>
                                          <?php $__currentLoopData = $link; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <li><a href="<?php echo e($lien->lien); ?>" target="_blank"><?php echo e($lien->source); ?></a></li>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                    </div> 
                              
                                </div>
                                <div class="clear"></div>
                            </div>
                            
                           
                        <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('No data to display')); ?></div>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                </div>
             </div>

            </div>

       </div>
      </div>
    <?php endif; ?>
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /var/www/top-patissier.net/resources/views/admin/candidats/show.blade.php ENDPATH**/ ?>