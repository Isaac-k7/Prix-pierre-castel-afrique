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
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                <?php echo e(__('Tableau de bord')); ?>

            </h2>
           
        </div>
     <?php $__env->endSlot(); ?>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <?php echo __("Bonjour $name<br> Vous êtes connecté !"); ?>

    </div>
    <div class="spacer">
        <p></p>
    </div>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="row">
            <div class="col-md-5 table-responsive">

                 <h6 class="text-center py-10"> <strong>Candidature par pays</strong> </h6>
                <table class="table table-hover table-striped " style="width:100%">
                <tbody class="bg-white divide-y divide-gray-200">
                
                <?php $__empty_1 = true; $__currentLoopData = json_decode($bycountry); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <?php if(strpos($country->name, '(RDC)') !== false): ?>
                        <?php ($class='d-none'); ?>
                      <?php else: ?>
                        <?php ($class=''); ?>
                      <?php endif; ?>
                  <tr class="<?php echo e($class); ?>">
                    <td><?php echo e($country->name); ?></td>
                    <td>
                    <?php ($cand = \App\Models\Candidature::where('pays_id',$country->id)->pluck('pays_id')->count()); ?>
                    <?php echo e($cand); ?>

                      
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr> <td>Aucun enregistrement</td> </tr>
                <?php endif; ?>
                </tbody>
                </table>
              
           
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6">
              <!--  <h6 class="text-center py-10"> <strong>Graph par pays</strong> </h6>
               <canvas id="canvas" height="360" width="600"></canvas> -->
            </div>
        </div>
       
    </div>
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var pays = <?php   echo $pays; ?>;
    var user = <?php echo $user; ?>;
    var barChartData = {
        labels: pays,
        datasets: [{
            label: 'Nombre de candidatures',
            backgroundColor: "#91df84",
            data: user
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: ''
                }
            }
        });
    };
</script> -->
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /var/www/top-patissier.net/resources/views/dashboard.blade.php ENDPATH**/ ?>