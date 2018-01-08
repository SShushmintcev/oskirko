<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;


class JFormRuleIsArticle extends JFormRule
{
    public function test(SimpleXMLElement $element, $value, $group = null, Registry $input = null, JForm $form = null)
    {
        $type = $input['params']->selecttype;

        if ($type === "2" && !isset($value))
        {
            return false;
        }

        return true;
    }
}
