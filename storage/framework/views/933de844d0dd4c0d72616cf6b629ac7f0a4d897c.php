
<style>
    .imgPreview img{
        width: 100px;
    }
</style>
<?php if (isset($component)) { $__componentOriginal71c0e7c38e14c452a91032b72c36ddb44dc8ba91 = $component; } ?>
<?php $component = App\View\Components\CandidatLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('candidat-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\CandidatLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

        <div class="error419">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="text-wrapper">
                            <div class="title" data-content="404">
                            SESSIONS EXPIRE
                            </div>

                            <div class="subtitle">
                            votre session a expiré , veuillez vous recconnecter.
                            </div>
                            <div class="connexion">
                            <a href="<?php echo e(route('login')); ?>" class="btn-log-guest text-sm text-gray-700 dark:text-gray-500 underline">Connexion</a>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c0e7c38e14c452a91032b72c36ddb44dc8ba91)): ?>
<?php $component = $__componentOriginal71c0e7c38e14c452a91032b72c36ddb44dc8ba91; ?>
<?php unset($__componentOriginal71c0e7c38e14c452a91032b72c36ddb44dc8ba91); ?>
<?php endif; ?>


<?php /**PATH /var/www/top-patissier.net/resources/views/errors/419.blade.php ENDPATH**/ ?>