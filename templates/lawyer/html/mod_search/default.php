<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

$doc = JFactory::getDocument();
$templatePath = $doc->baseurl . '/templates/' . $doc->template;
$imgPath = $templatePath . '/img/';

if ($width)
{
	$moduleclass_sfx .= ' ' . 'mod_search' . $module->id;
	$css = 'div.mod_search' . $module->id . ' input[type="search"]{ width:auto; }';
	JFactory::getDocument()->addStyleDeclaration($css);
	$width = ' size="' . $width . '"';
}
else
{
	$width = '';
}
?>
<div class="search<?php echo $moduleclass_sfx; ?>">
	<form id="searchForm" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-inline" style="display: none">
		<?php
			$output = '<label for="mod-search-searchword' . $module->id . '" class="element-invisible">' . $label . '</label> ';
			$output .= '<input name="searchword" id="mod-search-searchword' . $module->id . '" maxlength="' . $maxlength . '"  class="inputbox search-query input-medium" type="search"' . $width;
			$output .= ' placeholder="' . $text . '" />';

			echo $output;
		?>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</form>
    <input id="searchButton" class="pointer" type="image" src="<?php echo $imgPath . 'search.png' ?>" />
</div>
