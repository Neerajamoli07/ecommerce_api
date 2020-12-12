

<div class="rpd-datagrid">
    <?php echo $__env->make('rapyd::toolbar', array('label'=>$label, 'buttons_right'=>$buttons['TR']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <div class="table-responsive">
        <table<?php echo $dg->buildAttributes(); ?>>
            <thead>
            <tr>
                <?php $__currentLoopData = $dg->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th<?php echo $column->buildAttributes(); ?>>
                        <?php if($column->orderby): ?>
                            <?php if($dg->onOrderby($column->orderby_field, 'asc')): ?>
                                <span class="glyphicon glyphicon-chevron-up"></span>
                            <?php else: ?>
                                <a href="<?php echo e($dg->orderbyLink($column->orderby_field,'asc')); ?>">
                                    <span class="glyphicon glyphicon-chevron-up"></span>
                                </a>
                            <?php endif; ?>
                            <?php if($dg->onOrderby($column->orderby_field, 'desc')): ?>
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            <?php else: ?>
                                <a href="<?php echo e($dg->orderbyLink($column->orderby_field,'desc')); ?>">
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php echo $column->label; ?>

                    </th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            </thead>
            <tbody>
            <?php if(count($dg->rows) == 0): ?>
                <tr><td colspan="<?php echo count($dg->columns); ?>"><?php echo trans('rapyd::rapyd.no_records'); ?></td></tr>
            <?php endif; ?>
            <?php $__currentLoopData = $dg->rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr<?php echo $row->buildAttributes(); ?>>
                    <?php $__currentLoopData = $row->cells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td<?php echo $cell->buildAttributes(); ?>><?php echo $cell->value; ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="btn-toolbar" role="toolbar">
        <?php if($dg->havePagination()): ?>
            <div class="pull-left">
                <?php echo $dg->links(); ?>

            </div>
            <div class="pull-right rpd-total-rows">
                <?php echo $dg->totalRows(); ?>

            </div>
        <?php endif; ?>
    </div>
</div>

