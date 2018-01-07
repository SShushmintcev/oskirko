<?php

defined('_JEXEC') or die;

// Include the login functions only once
JLoader::register('ModWrapMenu', __DIR__ . '/helper.php');

$list = ModWrapMenu::getList($params);
$default = ModWrapMenu::getDefault();
$active = ModWrapMenu::getActive();

$path = $active->tree;
$active_id  = $active->id;
$default_id = $default->id;

if (count($list)){
    require JModuleHelper::getLayoutPath('mod_wrap_menu');
}

