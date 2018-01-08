<?php

defined('_JEXEC') or die('Restricted access');

$doc = JFactory::getDocument();
$origin = $doc->base;
$uniqid	= $module->id;
$y_id = $params->get ('y_id');
$y_title = $params->get ('y_title');
$width = $params->get ('width',300);
$height = $params->get ('height',225);

require(JModuleHelper::getLayoutPath('mod_youtube'));