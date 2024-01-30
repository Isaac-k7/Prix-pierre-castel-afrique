<div class="flex-shrink-0 " id="banner">
        <div class="bg-head-home">
            <div class="design-home flex items-center justify-center gap-1 text-sm text-gray-600 dark:text-gray-400">
                <div class="center-banner">
                   <?php ($edition = \App\Models\Edition::where('status',1)->first()); ?>
                   <h1> 
                    <?php if($edition): ?>
                        <?php echo e($edition->name); ?> <br>Edition <?php echo e($edition->year); ?> 
                    <?php endif; ?>
                   </h1> 
                   <p>
                    <?php if($edition): ?>
                    <a href="<?php echo e(route('getcandidat-view')); ?>" class="LinkIn bouton3"> <strong>S'inscrire</strong></a>
                    <?php endif; ?>
            
                </p>
                </div>
            </div>
                
        </div>
         
        <div class="flex-shrink-0">
             <img src="<?php echo e(asset('assets/images/fdd_pc_sans_logo.jpeg')); ?>" >
        </div>

</div>
<?php /**PATH /Applications/MAMP/htdocs/prix-catel-online/resources/views/components/home/banner.blade.php ENDPATH**/ ?>