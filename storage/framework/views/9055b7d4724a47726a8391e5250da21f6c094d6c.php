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
            Liste des Candidats
        </h2>
     <?php $__env->endSlot(); ?>

    <div >

        <?php if(Session::has('message')): ?>
            <div class="bg-green-300 text-green-700 rounded px-2 py-3">
                <?php echo e(Session::get('message')); ?>

            </div>
        <?php endif; ?>

     <!--    <div class="grid justify-items-stretch my-3">
            <a href="<?php echo e(route('users.create')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end">Create Filiale</a>
        </div>
        
 -->
        <table class="table table-striped table-bordered nowrap" style="width:100%" id="tableau">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Année</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pays</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Présélectionné ?</th>
                <th class="relative px-6 py-3"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <?php ($index = 1); ?>
            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
               
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($index); ?></td>
               
                    <td class="px-6 py-4 whitespace-nowrap imgthumb"> 
                        <?php if($candidats->users->getFirstMediaUrl('avatar_user','thumb')): ?>
                        <img src="<?php echo e($candidats->users->getFirstMediaUrl('avatar_user','thumb')); ?>" alt="" srcset="">
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($candidats->users->name); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($candidats->users->email); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($candidats->edition->year); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($candidats->pays->name); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if($candidats->status == 0): ?>   
                        <span class="flex justify-self-end orange">
                        <i class="fa fa-battery-empty"></i>  &nbsp;<?php echo e(_('Brouillon')); ?> 
                        </span>
                        <?php elseif($candidats->status == 1): ?>
                        <span class="flex justify-self-end vert">
                        <i class="fa fa-battery-full"></i>  &nbsp;  <?php echo e(_('Candidature Validée')); ?> 
                        </span>
                        <?php elseif($candidats->status == 2): ?>
                        <span class="flex justify-self-end rouge">
                        <i class="fa fa-battery-empty"></i>  &nbsp; <?php echo e(_('Candidature rejétée')); ?> 
                        </span>
                        <?php elseif($candidats->status == 3): ?>
                        <span class="flex justify-self-end rouge">
                        <i class="fa fa-battery-slash"></i>  &nbsp; <?php echo e(_('En attente de validation')); ?> 
                        </span>
                        <?php endif; ?>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if($candidats->preselected == 0): ?>   
                        <span class="flex justify-self-end rouge">
                         <strong><i class="fa fa-battery-empty"></i>  &nbsp;<?php echo e(_('NON')); ?> </strong> 
                        </span>
                        <?php elseif($candidats->preselected == 1): ?>
                        <span class="flex justify-self-end vert">
                         <strong><i class="fa fa-battery-full"></i>  &nbsp;  <?php echo e(_('OUI')); ?> </strong> 
                        </span>
                        <?php endif; ?>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="<?php echo e(route('candidats.show', [$candidats->id])); ?>" class="text-blue-500 cand-fa"> <i class="fa fa-eye"></i></a>
                    </td>
                 
                   <!--  <td class="px-6 py-4 whitespace-nowrap">
                        <form method="post" action="<?php echo e(route('users.destroy', [$candidats->id])); ?>" id="deleteForm<?php echo e($candidats->id); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-500" onclick="event.preventDefault(); if(confirm('Are you sure to delete?')) {document.getElementById('deleteForm<?php echo e($candidats->id); ?>').submit();} else {return false;} ">Delete</button>
                        </form>
                    </td> -->
                </tr>
                   <?php ($index++); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div colspan="5" class="px-6 py-4 whitespace-nowrap">No data to display</div>
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
<?php endif; ?><?php /**PATH /Applications/MAMP/htdocs/prix-catel-online/resources/views/admin/candidats/index.blade.php ENDPATH**/ ?>