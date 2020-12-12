

<?php if(in_array("show", $actions)): ?>
    <a class="" title="<?php echo app('translator')->getFromJson('rapyd::rapyd.show'); ?>" href="<?php echo $uri; ?>?show=<?php echo $id; ?>"><span class="glyphicon glyphicon-eye-open"> </span></a>
<?php endif; ?>
<?php if(in_array("modify", $actions)): ?>
    <a class="" title="<?php echo app('translator')->getFromJson('rapyd::rapyd.modify'); ?>" href="<?php echo $uri; ?>?modify=<?php echo $id; ?>"><span class="glyphicon glyphicon-edit"> </span></a>
<?php endif; ?>
<?php if(in_array("delete", $actions)): ?>
    <a class="text-danger" title="<?php echo app('translator')->getFromJson('rapyd::rapyd.delete'); ?>" href="<?php echo $uri; ?>?delete=<?php echo $id; ?>"><span class="glyphicon glyphicon-trash"> </span></a>
<?php endif; ?>
