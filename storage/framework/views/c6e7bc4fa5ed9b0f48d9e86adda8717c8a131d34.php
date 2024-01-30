<div class="flex-shrink-0  bloc-partenaire" id="partenaire">       
       <div class="bloc-partenaire-home" bis_skin_checked="1">
			
			    	<div class="intro-projets" bis_skin_checked="1">
                      <h2>LES PARTENAIRES</h2>
                      <p>Ils soutiennent le Fonds Pierre Castel - Agir avec l'Afrique.</p>
                    
			    	</div>

			
       <div class="bloc-liste-partenaire-home" bis_skin_checked="1">
             <div class="widgetHighlightPost col-xs-12 col-sm-12 col-md-12 col-lg-12">

               
               <section class="trigger section gutter-horizontal bg-gray gutter-vertical--m gutter-horizontal">
               <div class="customer-logos slider">
                 <?php ($partenaires = \App\Models\Partenaire::where('status',1)->get()); ?>
                  <?php $__empty_1 = true; $__currentLoopData = $partenaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partenaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                  <div class="slide-in-right slide"> 
                     <img src="<?php echo e($partenaire->getFirstMediaUrl('logo_partenaire')); ?>" title="<?php echo e($partenaire->name); ?>" alt="<?php echo e($partenaire->name); ?>">
                  </div>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                   <p></p>
                  <?php endif; ?>
             
                </div>
               </section>

            </div>
          </div> 

	  	</div>
</div>
<?php /**PATH /var/www/top-patissier.net/resources/views/components/home/bloc-partenaire.blade.php ENDPATH**/ ?>