<?php

defined('_JEXEC') or die;

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');
JLoader::register('ModArticlesNewsHelper', JPATH_SITE . '/modules/mod_articles_news/helper.php');

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

class ModBlockWrapper
{
    public static function getData(&$params)
    {
        $data = new stdClass();
        $data->body = null;
        $data->title = "";
        $styleDictionary = array(
            0 => 'light',
            1 => 'dark'
        );

        $data->style = $styleDictionary[$params->get('styleblock')];
        $data->width = $params->get('width');
        $data->height = $params->get('height');
        $data->type = $params->get('selecttype');
        $data->category = $params->get('catid');
        $data->count = $params->get('count');
        $data->articleId = $params->get('article');

        try {
	        switch ($data->type) {
		        case '1' :
			        // $t = ModArticlesNewsHelper::getList($params);
			        $news = self::getNewsByCategory($params);

			        if (count($news)){
				        $data->title = $news[0]->category_title;
				        $data->body = $news;
				        break;
			        }

			        throw new Exception('News not found');

			        break;
		        case '2' :
			        $article = JTable::getInstance('content');
			        $article->load($data->articleId);

			        if (!$article->id) {
				        throw new Exception('The article not found');
			        }

			        $articleModel = JModelLegacy::getInstance('Article', 'ContentModel', array('ignore_request' => true));
			        $articleModel->setState('params', $params);

			        $article = $articleModel->getItem($data->articleId);

			        if ($article->state === '2' || $article->state === '0') {
				        throw new Exception('The article not publish');
			        }

			        $article->slug = $article->id . ':' . $article->alias;

			        $article->catslug = $article->catid . ':' . $article->category_alias;

			        $article->introtext = JHtml::_('content.prepare', $article->introtext, '', 'mod_block_wrapper.content');

			        $article->link = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language));

			        $data->title = $article->title;
			        $data->body = $article;
			        break;
		        default :
			        break;
	        }
        }
        catch (Exception $e) {
        	$data->title = 'Error';
        	$data->body = $e->getMessage();
        }

        return $data;
    }

    private static function getNewsByCategory(&$params)
    {
	    $model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

	    // Set application parameters in model
	    $app       = JFactory::getApplication();
	    $appParams = $app->getParams();
	    $model->setState('params', $appParams);

	    // Set the filters based on the module params
	    $model->setState('list.start', 0);
	    $model->setState('list.limit', (int) $params->get('count', 5));
	    $model->setState('filter.published', 1);
	    $model->setState('filter.archived', 1);

	    // This module does not use tags data
	    $model->setState('load_tags', false);

	    // Access filter
	    $access     = !JComponentHelper::getParams('com_content')->get('show_noauth');
	    $authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
	    $model->setState('filter.access', $access);

	    // Category filter
	    $model->setState('filter.category_id', $params->get('catid', array()));

	    // Filter by language
	    $model->setState('filter.language', $app->getLanguageFilter());

	    // Filer by tag
	    $model->setState('filter.tag', $params->get('tag'), array());

	    $model->setState('filter.featured', 'show');

	    // Set ordering
	    $ordering = $params->get('ordering', 'a.publish_up');
	    $model->setState('list.ordering', $ordering);

	    if (trim($ordering) === 'rand()')
	    {
		    $model->setState('list.ordering', JFactory::getDbo()->getQuery(true)->Rand());
	    }
	    else
	    {
		    $direction = $params->get('direction', 1) ? 'DESC' : 'ASC';
		    $model->setState('list.direction', $direction);
		    $model->setState('list.ordering', $ordering);
	    }

	    // Check if we should trigger additional plugin events
	    $triggerEvents = $params->get('triggerevents', 1);

	    // Retrieve Content
	    $items = $model->getItems();

	    foreach ($items as &$item)
	    {
		    $item->slug     = $item->id . ':' . $item->alias;

		    $item->catslug  = $item->catid . ':' . $item->category_alias;

		    if ($access || in_array($item->access, $authorised))
		    {
			    // We know that user has the privilege to view the article
			    $item->link     = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));
		    }
		    else
		    {
			    $item->link = new JUri(JRoute::_('index.php?option=com_users&view=login', false));
			    $item->link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)));
		    }


		    $item->introtext = JHtml::_('content.prepare', $item->introtext, '', 'mod_block_wrapper.content');
//
//		    if (!$params->get('image'))
//		    {
		    $item->introtext = preg_replace('/<img[^>]*>/', '', $item->introtext);
//		    }
//
//		    if ($triggerEvents)
//		    {
//			    $item->text = '';
//			    $app->triggerEvent('onContentPrepare', array ('com_content.article', &$item, &$params, 0));
//
//			    $results                 = $app->triggerEvent('onContentAfterTitle', array('com_content.article', &$item, &$params, 0));
//			    $item->afterDisplayTitle = trim(implode("\n", $results));
//
//			    $results                    = $app->triggerEvent('onContentBeforeDisplay', array('com_content.article', &$item, &$params, 0));
//			    $item->beforeDisplayContent = trim(implode("\n", $results));
//
//			    $results                   = $app->triggerEvent('onContentAfterDisplay', array('com_content.article', &$item, &$params, 0));
//			    $item->afterDisplayContent = trim(implode("\n", $results));
//		    }
//		    else
//		    {
			    $item->afterDisplayTitle    = '';
			    $item->beforeDisplayContent = '';
			    $item->afterDisplayContent  = '';
//		    }
	    }

	    return $items;
    }
}