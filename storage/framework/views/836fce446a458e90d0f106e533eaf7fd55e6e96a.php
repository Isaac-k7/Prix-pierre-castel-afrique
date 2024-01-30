<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des partenaires
        </h2>
     <?php $__env->endSlot(); ?>

    <div >

        <?php if(Session::has('message')): ?>
            <div class="bg-green-300 text-green-700 rounded px-2 py-3">
                <?php echo e(Session::get('message')); ?>

            </div>
        <?php endif; ?>

        <div class="grid justify-items-stretch my-3">
            <a href="<?php echo e(route('partenaire.create')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end"><?php echo e(_('Créer un partenaire')); ?></a>
        </div>
        

        <table class="min-w-full divide-y divide-gray-200" id="tableau">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="relative px-6 py-3"></th>
                <th class="relative px-6 py-3"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <?php ($index = 1); ?>
            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partenaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($index); ?></td>
               
                    <td class="px-6 py-4 whitespace-nowrap imgthumb"> 
                        <?php if($partenaire->getFirstMediaUrl('logo_partenaire','thumb')): ?>
                        <img src="<?php echo e($partenaire->getFirstMediaUrl('logo_partenaire','thumb')); ?>" alt="" srcset="">
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($partenaire->name); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $partenaire->status==1 ? '<span class="active"><i class="fa fa-check" aria-hidden="true"></i> Actif</span>':'<span class="inactive"><i class="fa fa-times" aria-hidden="true"></i> Inactif</span>'; ?></td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="<?php echo e(route('partenaire.edit', [$partenaire->id])); ?>" 
                        class="text-blue-500" ><i class="fa fa-pencil"></i></a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form method="post" action="<?php echo e(route('partenaire.destroy', [$partenaire->id])); ?>" id="deleteForm<?php echo e($partenaire->id); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-500" onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer?')) {document.getElementById('deleteForm<?php echo e($partenaire->id); ?>').submit();} else {return false;} ">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php ($index++); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div colspan="5" class="px-6 py-4 whitespace-nowrap">Aucune donnée à afficher</div>
            <?php endif; ?>
            </tbody>
        </table>

            <div class="my-3">
            <?php if($data): ?> <?php echo e($data->links()); ?> <?php endif; ?>
            </div>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH /Applications/MAMP/htdocs/prix-catel-online/resources/views/admin/partenaire/index.blade.php ENDPATH**/ ?>