<table width="100%" class="merger">
    <?php $__currentLoopData = $MainOrganisations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Main): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <thead>
        <th><?php echo e($Main->address); ?>  </th>
        <th>
            <?php $__currentLoopData = $Main->Companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Companies): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($Companies->name); ?> (Code: <?php echo e($Companies->code); ?>) <br />
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </th>

        </thead>
        <tbody>
        <?php $__currentLoopData = $Main->SubOrganisations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($Sub->name); ?></td>
                <td><?php echo e($Sub->code); ?></td>
            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php /**PATH /Users/andrewelliott/code/codereview-projects/resources/views/merger/list.blade.php ENDPATH**/ ?>