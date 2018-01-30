<?php

defined('_JEXEC') or die;

// Include the login functions only once
JLoader::register('ModBlockWrapper', __DIR__ . '/helper.php');
$app = JFactory::getApplication();

$document = JFactory::getDocument();
$document->addStyleSheet("/media/" . $app->scope. "/css/blockWrapper.css");

$data = ModBlockWrapper::getData($params);

$type = $params->get('selecttype');

$showFooter = $params->get('footer') === "1";
$footerUrl = $params->get('all_list');

$footerUrlText = $params->get('all_list_text');

$showTitle = $params->get('title') === "1";
$title_text = $params->get('title_text');

$showArticleLink = $params->get('article_link') === '1';

$layout = $data->type === '1' ? 'news' : 'default';

require JModuleHelper::getLayoutPath('mod_block_wrapper', $layout);
