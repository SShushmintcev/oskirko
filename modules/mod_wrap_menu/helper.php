<?php

defined('_JEXEC') or die;

class ModWrapMenu
{
    public static function getList(&$params)
    {
        $app = JFactory::getApplication();
        $menu = $app->getMenu();

        // Get active menu item
        //$base = self::getBase($params);
        $user = JFactory::getUser();
        $levels = $user->getAuthorisedViewLevels();
        asort($levels);
        $key = 'menu_items' . $params . implode(',', $levels);
        $cache = JFactory::getCache('mod_wrap_menu', '');

        if ($cache->contains($key)) {
            $items = $cache->get($key);
        } else {
            $items = $menu->getItems('menutype', $params->get('menutype'));
            $hidden_parents = array();
            $lastitem = 0;

            $defaultColor = array(
                0 => new StyleObject('#20003f', '#f5f0f1'),
                1 => new StyleObject('#2d626c', '#f5f0f1'),
                2 => new StyleObject('#9ec0cd', '#161616'),
                3 => new StyleObject('#f3e8ea', '#161616'),
                4 => new StyleObject('#bcb6c7', '#161616'),
            );

            if ($items) {
                foreach ($items as $i => $item) {
                    $item->preview = new stdClass();
                    $item->preview ->body = '';
                    $item->preview ->title = '';

                    if ($i <= 5) {
                        $item->style = $defaultColor[$i];
                    } else {
                        $item->style = new StyleObject(self::randomColor(), '#161616');
                    }

                    $item->parent = false;

                    if (isset($items[$lastitem]) && $items[$lastitem]->id == $item->parent_id && $item->params->get('menu_show', 1) == 1) {
                        $items[$lastitem]->parent = true;
                    }

                    // Exclude item with menu item option set to exclude from menu modules
                    if (($item->params->get('menu_show', 1) == 0) || in_array($item->parent_id, $hidden_parents)) {
                        $hidden_parents[] = $item->id;
                        unset($items[$i]);
                        continue;
                    }

                    $item->deeper = false;
                    $item->shallower = false;
                    $item->level_diff = 0;

                    if (isset($items[$lastitem])) {
                        $items[$lastitem]->deeper = ($item->level > $items[$lastitem]->level);
                        $items[$lastitem]->shallower = ($item->level < $items[$lastitem]->level);
                        $items[$lastitem]->level_diff = ($items[$lastitem]->level - $item->level);
                    }

                    $lastitem = $i;
                    $item->active = false;
                    $item->flink = $item->link;

                    // Reverted back for CMS version 2.5.6
                    switch ($item->type) {
                        case 'separator':
                            break;

                        case 'component':
                            $item->flink = 'index.php?Itemid=' . $item->id;

                            // Get article by ID and get introtext;
                            $matches = null;
                            if (preg_match('/&id=(.*)/', $item->link, $matches, PREG_OFFSET_CAPTURE)) {
                                $articleId = $matches[1][0];


	                            $articleModel = JModelLegacy::getInstance('Article', 'ContentModel', array('ignore_request' => true));
	                            $articleModel->setState('params', $params);
	                            $article = $articleModel->getItem($articleId);

                                //$article = JControllerLegacy::getInstance('Content')->getModel('Article')->getItem($articleId);

                                if ($article) {
                                    $cont = str_replace(array("\r\n", "\r"), "", $article->introtext);

                                    if($cont){
//	                                  $pattern = "/<p ?(.*?)>(.*)<\/p>/";
//                                    $matchResults = null;
//
//                                    if (preg_match($pattern, $cont, $matchResults, PREG_OFFSET_CAPTURE)) {
//                                        $item->preview->body = $matchResults[2][0];
//                                    } else {
	                                    $item->preview->body = $cont;
//                                    }
	                                    $item->preview->title = $item->title;
                                    }
                                }
                            }

                            break;

                        case 'heading':
                            // No further action needed.
                            break;

                        case 'url':
                            if ((strpos($item->link, 'index.php?') === 0) && (strpos($item->link, 'Itemid=') === false)) {
                                // If this is an internal Joomla link, ensure the Itemid is set.
                                $item->flink = $item->link . '&Itemid=' . $item->id;
                            }
                            break;

                        case 'alias':
                            $item->flink = 'index.php?Itemid=' . $item->params->get('aliasoptions');
                            break;

                        default:
                            $item->flink = 'index.php?Itemid=' . $item->id;
                            break;
                    }

                    if ((strpos($item->flink, 'index.php?') !== false) && strcasecmp(substr($item->flink, 0, 4), 'http')) {
                        $item->flink = JRoute::_($item->flink, true, $item->params->get('secure'));
                    } else {
                        $item->flink = JRoute::_($item->flink);
                    }

                    // We prevent the double encoding because for some reason the $item is shared for menu modules and we get double encoding
                    // when the cause of that is found the argument should be removed
                    $item->title = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8', false);
                    $item->anchor_css = htmlspecialchars($item->params->get('menu-anchor_css', ''), ENT_COMPAT, 'UTF-8', false);
                    $item->anchor_title = htmlspecialchars($item->params->get('menu-anchor_title', ''), ENT_COMPAT, 'UTF-8', false);
                    $item->anchor_rel = htmlspecialchars($item->params->get('menu-anchor_rel', ''), ENT_COMPAT, 'UTF-8', false);
                    $item->menu_image = $item->params->get('menu_image', '') ?
                        htmlspecialchars($item->params->get('menu_image', ''), ENT_COMPAT, 'UTF-8', false) : '';
                    $item->menu_image_css = htmlspecialchars($item->params->get('menu_image_css', ''), ENT_COMPAT, 'UTF-8', false);
                }

                if (isset($items[$lastitem])) {
                    $items[$lastitem]->deeper = ((1 ?: 1) > $items[$lastitem]->level);
                    $items[$lastitem]->shallower = ((1 ?: 1) < $items[$lastitem]->level);
                    $items[$lastitem]->level_diff = ($items[$lastitem]->level - (1 ?: 1));
                }
            }

            $cache->store($items, $key);
        }

        return $items;
    }

    public static function getActive()
    {
        $menu = JFactory::getApplication()->getMenu();

        return $menu->getActive() ?: self::getDefault();
    }

    public static function getDefault()
    {
        $menu = JFactory::getApplication()->getMenu();
        $lang = JFactory::getLanguage();

        // Look for the home menu
        if (JLanguageMultilang::isEnabled()) {
            return $menu->getDefault($lang->getTag());
        } else {
            return $menu->getDefault();
        }
    }

    private static function randomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}

class StyleObject
{
    public $background;
    public $color;

    public function __construct($background = null, $color = null)
    {
        $this->background = $background;
        $this->color = $color;
    }
}