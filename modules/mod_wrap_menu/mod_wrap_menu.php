<?php

defined('_JEXEC') or die;

// Include the login functions only once
JLoader::register('ModWrapMenu', __DIR__ . '/helper.php');

$document = JFactory::getDocument();
$document->addStyleSheet("/media/" . $app->scope. "/css/wrapMenu.css");
$document->addScript("/media/" . $app->scope. "/js/wrapMenu.js");

$list = ModWrapMenu::getList($params);
$default = ModWrapMenu::getDefault();
$active = ModWrapMenu::getActive();

$path = $active->tree;
$active_id  = $active->id;
$default_id = $default->id;

$showPreview = !!$params->get('preview');

if (count($list)){
    require JModuleHelper::getLayoutPath('mod_wrap_menu');
}

