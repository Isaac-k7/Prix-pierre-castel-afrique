<?php if (isset($component)) { $__componentOriginal71c0e7c38e14c452a91032b72c36ddb44dc8ba91 = $component; } ?>
<?php $component = App\View\Components\CandidatLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('candidat-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\CandidatLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
      
          <?php $__env->slot('header', null, []); ?> 
            <div class="gap-4 md:flex-row md:items-center md:justify-between">
            
                <h2 class="text-xl font-semibold leading-tight ">
                    <?php echo e(__('Mon espace')); ?>

                </h2>
            
            </div>

            <?php if($data && $data->status == 0): ?>
            <div class="gap-4 md:flex-row md:items-center md:justify-between">
                <div class="grid justify-items-stretch my-3">
                       <form method="post" action="<?php echo e(route('candidats.validation', [$data->id])); ?>" id="validForm">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="status" value="3">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end" onclick="event.preventDefault(); if(confirm('Êtes-vous sur de vouloir valider ?')) {document.getElementById('validForm').submit();} else {return false;} "><?php echo e(_('Je valide ma candidature')); ?> </button>
                            <p> <i>(*) Une fois validée, vous ne pouvez plus la modifier</i> </p>
                        </form>
                </div>
             </div>
            <?php endif; ?> 
            <?php if($data): ?>
            <div class="gap-4 md:flex-row md:items-center md:justify-between">
                <div class="grid justify-items-stretch my-3">
                    <span class="flex justify-self-end"><strong><?php echo e(_('Statut de votre candidature')); ?>  </strong></span>
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
                        <span class="flex justify-self-end orange">
                        <i class="fa fa-battery-empty"></i>  &nbsp;<?php echo e(_('En attente de validation')); ?> 
                        </span>
                    <?php endif; ?>
                </div>
             </div>
            <?php endif; ?>
           
         <?php $__env->endSlot(); ?>
       
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
                <?php if($data): ?>
                        <?php if($data->getFirstMediaUrl('candidat_cv')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_cv')); ?>
                           
                            <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                            <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                            <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                            <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            <?php else: ?>
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucun document ')); ?></div>
                            <?php endif; ?>

                        <?php endif; ?>
                    <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                    <?php endif; ?>
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
                    <?php if($data): ?>
                            <?php if($data->getFirstMediaUrl('candidat_identite')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_identite')); ?>

                            <br>
                            <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                            <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                            <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                            <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            <?php else: ?>
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                            <?php endif; ?>
                                
                            <?php endif; ?>
                    <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                    <?php endif; ?>
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
                    <?php if($data): ?>
                        <?php if($data->getFirstMediaUrl('candidat_juridique_entreprise')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_juridique_entreprise')); ?>

                            <br>
                            <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                            <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                            <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                            <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            <?php else: ?>
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                            <?php endif; ?>

                            <?php endif; ?>
                        <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                    <?php endif; ?>
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
                    <?php if($data): ?>        
                        <?php if($data->getFirstMediaUrl('candidat_juridique_commerciale')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_juridique_commerciale')); ?>

                            <br>
                            <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                            <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                            <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                            <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                            <?php else: ?>
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                            <?php endif; ?>

                            <?php endif; ?>
                        <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                    <?php endif; ?>
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
                    <?php if($data): ?>  
                        <?php if($data->getFirstMediaUrl('candidat_exercice')): ?>

                                <?php ( $mediaItems = $data->getMedia('candidat_exercice')); ?>

                                <br>
                                <?php if($mediaItems[0]->getTypeFromExtension() == 'image'): ?>
                                <img src="<?php echo e($mediaItems[0]->original_url); ?>"/>
                                <?php elseif($mediaItems[0]->getTypeFromExtension() == 'pdf'): ?>
                                <iframe src="<?php echo e($mediaItems[0]->original_url); ?>" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                                <?php else: ?>
                                <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                                <?php endif; ?>

                                <?php endif; ?>
                        <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                    <?php endif; ?>
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
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                            <?php endif; ?>

                            <?php endif; ?>
                        <?php else: ?>
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                    <?php endif; ?>
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
                            <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                            <?php endif; ?>
                        <?php endif; ?>
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
                      <?php if($data): ?>
                        <?php if($data->getMedia('candidat_logo_entreprise')): ?>

                            <?php ( $mediaItems = $data->getMedia('candidat_logo_entreprise')); ?>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3" id="logo_company">
                                        <img src="<?php echo e($data->getFirstMediaUrl('candidat_logo_entreprise')); ?>"/>
                                    </div>

                                    <div class="col-md-9">
                                        <?php if($data->lien_rx): ?>
                                        <?php ($link = json_decode($data->lien_rx)); ?>
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
                        <div colspan="5" class="px-6 py-4 whitespace-nowrap"><?php echo e(__('Aucune donnée')); ?></div>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                </div>
             </div>

            </div>
       <div class="clear"></div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c0e7c38e14c452a91032b72c36ddb44dc8ba91)): ?>
<?php $component = $__componentOriginal71c0e7c38e14c452a91032b72c36ddb44dc8ba91; ?>
<?php unset($__componentOriginal71c0e7c38e14c452a91032b72c36ddb44dc8ba91); ?>
<?php endif; ?>

<?php /**PATH /var/www/top-patissier.net/resources/views/candidat-space/espace.blade.php ENDPATH**/ ?>