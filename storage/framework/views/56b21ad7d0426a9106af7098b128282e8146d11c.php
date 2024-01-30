<div class="flex-shrink-0  bloc-pierre-castel-home " id="jeune">
    <div class="row">
      
         
        <div class="texte-pierre-castel-jeune col-xs-12 col-sm-12 col-md-12 col-lg-12 flex  gap-1 bloc-gris">
             <div class="text-sm text-gray-600 dark:text-gray-400 ">
               <p>
               <?php ($edition = \App\Models\Edition::where('status',1)->first()); ?>
                <?php if($edition): ?>
                <h4><?php echo e($edition->name); ?></h4>
                <?php endif; ?>
               
                Le Fonds Pierre Castel – Agir avec l’Afrique et ses partenaires Brakina, Bracongo, Boissons du Cameroun, Castel Algérie, Solibra et Star, lancent les appels à candidature pour la 6ème édition du Prix Pierre Castel, du 03 avril au 03 mai 2023.
               </p>
              

             </div>
        </div>
    </div>

</div>
<?php /**PATH /var/www/top-patissier.net/resources/views/components/home/prix-jeune.blade.php ENDPATH**/ ?>