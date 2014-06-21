<?php

$hook_version = 1;
$hook_array = Array();

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(10, 'Retrieve Password', 'custom/modules/Tasks/CustomTasks.php','CustomTasks', 'retrievePass');
?>
