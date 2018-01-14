<?php

defined('_JEXEC') or die;

?>

<ul class="menu style-menu side-menu" id="wrapMenu">
    <?php foreach ($list as $i => &$item)
    {
        $class = 'item-' . $item->id;

        if ($item->id == $default_id)
        {
            $class .= ' default';
        }

        if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
        {
            $class .= ' current';
        }

        if (in_array($item->id, $path))
        {
            $class .= ' active';
        }
        elseif ($item->type === 'alias')
        {
            $aliasToId = $item->params->get('aliasoptions');

            if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
            {
                $class .= ' active';
            }
            elseif (in_array($aliasToId, $path))
            {
                $class .= ' alias-parent-active';
            }
        }

        if ($item->type === 'separator')
        {
            $class .= ' divider';
        }

        if ($item->parent)
        {
            $class .= ' parent';
        }

        echo '<li class="' . $class . '" style="background:' . $item->style->background . '; color: ' . $item->style->color .'; position: relative; display: block;">';

        switch ($item->type) :
            case 'separator':
            case 'component':
            case 'heading':
            case 'url':
                require JModuleHelper::getLayoutPath('mod_wrap_menu', 'default_' . $item->type);
                break;

            default:
                require JModuleHelper::getLayoutPath('mod_wrap_menu', 'default_url');
                break;
        endswitch;

        echo '</li>';
    }
    ?></ul>