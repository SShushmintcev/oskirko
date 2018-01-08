<?php

defined('_JEXEC') or die;

// Include the login functions only once
JLoader::register('ModBlockWrapper', __DIR__ . '/helper.php');
$app = JFactory::getApplication();

$document = JFactory::getDocument();
$document->addStyleSheet("/media/" . $app->scope. "/css/blockWrapper.css");

$data = ModBlockWrapper::getData($params);

require JModuleHelper::getLayoutPath('mod_block_wrapper');
