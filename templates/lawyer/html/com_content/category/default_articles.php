<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

// Create some shortcuts.
$params    = &$this->item->params;
$n         = count($this->items);
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

// Check for at least one editable article
$isEditable = false;

if (!empty($this->items))
{
	foreach ($this->items as $article)
	{
		if ($article->params->get('access-edit'))
		{
			$isEditable = true;
			break;
		}
	}
}

// For B/C we also add the css classes inline. This will be removed in 4.0.
JFactory::getDocument()->addStyleDeclaration('
.hide { display: none; }
.table-noheader { border-collapse: collapse; }
.table-noheader thead { display: none; }
');

$tableClass = $this->params->get('show_headings') != 1 ? ' table-noheader' : '';
?>

<div class="page-header">
    <h2> <?php echo $this->escape($this->category->title); ?> </h2>
</div>


<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">
<?php if ($this->params->get('filter_field') !== 'hide' || $this->params->get('show_pagination_limit')) : ?>
	<fieldset class="filters btn-toolbar clearfix">
		<legend class="hide"><?php echo JText::_('COM_CONTENT_FORM_FILTER_LEGEND'); ?></legend>
		<?php if ($this->params->get('filter_field') !== 'hide') : ?>
			<div class="btn-group">
				<?php if ($this->params->get('filter_field') !== 'tag') : ?>
					<label class="filter-search-lbl element-invisible" for="filter-search">
						<?php echo JText::_('COM_CONTENT_' . $this->params->get('filter_field') . '_FILTER_LABEL') . '&#160;'; ?>
					</label>
					<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="inputbox" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_CONTENT_' . $this->params->get('filter_field') . '_FILTER_LABEL'); ?>" />
				<?php else : ?>
					<select name="filter_tag" id="filter_tag" onchange="document.adminForm.submit();" >
						<option value=""><?php echo JText::_('JOPTION_SELECT_TAG'); ?></option>
						<?php echo JHtml::_('select.options', JHtml::_('tag.options', true, true), 'value', 'text', $this->state->get('filter.tag')); ?>
					</select>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ($this->params->get('show_pagination_limit')) : ?>
			<div class="btn-group pull-right">
				<label for="limit" class="element-invisible">
					<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		<?php endif; ?>

		<input type="hidden" name="filter_order" value="" />
		<input type="hidden" name="filter_order_Dir" value="" />
		<input type="hidden" name="limitstart" value="" />
		<input type="hidden" name="task" value="" />
	</fieldset>

	<div class="control-group hide pull-right">
		<div class="controls">
			<button type="submit" name="filter_submit" class="btn btn-primary"><?php echo JText::_('COM_CONTENT_FORM_FILTER_SUBMIT'); ?></button>
		</div>
	</div>

<?php endif; ?>

<?php if (empty($this->items)) : ?>
	<?php if ($this->params->get('show_no_articles', 1)) : ?>
		<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
	<?php endif; ?>
<?php else : ?>

<ul class="ui-datalist-data">
	<?php foreach ($this->items as $i => $article) : ?>

   <li class="ui-datalist-item item-<?php echo $i; ?>" >
       <?php if ($isEditable) : ?>
       <div class="right">
           <?php if ($article->params->get('access-edit')) : ?>
               <?php echo JHtml::_('icon.edit', $article, $params); ?>
           <?php endif; ?>
       </div>
       <div class="clear"></div>
       <?php endif; ?>

       <?php
       $isNotPublish = $article->state == 0;
       $isPublish = strtotime($article->publish_up) > strtotime(JFactory::getDate());
       $isExpire = (strtotime($article->publish_down) < strtotime(JFactory::getDate())) && $article->publish_down != JFactory::getDbo()->getNullDate();
       ?>

       <div class="ui-datalist-container <?php $isNotPublish || $isPublish || $isExpire ? 'warning' : ''?>">
           <div class="ui-datalist-container-header">
               <div class="left ui-datalist-h-title">
                   <span><?php echo $this->escape($article->title); ?></span>

                   <?php if ($isNotPublish) { ?>
                       &nbsp;<span class="list-published label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
                   <?php } ?>

                   <?php if ($isPublish) { ?>
                       &nbsp;<span class="list-published label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
                   <?php } ?>

                   <?php if ($isExpire) { ?>
                       &nbsp;<span class="list-published label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
                   <?php } ?>
               </div>
               <?php if (JLanguageAssociations::isEnabled() && $this->params->get('show_associations')) : ?>
               <div class="left" style="margin-left: 10px;">
                  <?php $associations = ContentHelperAssociation::displayAssociations($article->id); ?>
                  <?php foreach ($associations as $association) : ?>
                      <?php if ($this->params->get('flags', 1)) : ?>
                          <?php $flag = JHtml::_('image', 'mod_languages/' . $association['language']->image . '.gif', $association['language']->title_native, array('title' => $association['language']->title_native), true); ?>
                          &nbsp;<a href="<?php echo JRoute::_($association['item']); ?>"><?php echo $flag; ?></a>&nbsp;
                      <?php else : ?>
                          <?php $class = 'label label-association label-' . $association['language']->sef; ?>
                          &nbsp;<a class="' . <?php echo $class; ?> . '" href="<?php echo JRoute::_($association['item']); ?>"><?php echo strtoupper($association['language']->sef); ?></a>&nbsp;
                      <?php endif; ?>
                  <?php endforeach; ?>
               </div>
               <?php endif; ?>

               <?php if ($this->params->get('list_show_date')) : ?>
               <div class="right ui-datalist-h-date">
                   <span>
                       <?php echo JHtml::_('date', $article->displayDate, $this->escape($this->params->get('date_format', JText::_('DATE_FORMAT_LC3')))); ?>
                   </span>
               </div>
                <?php endif; ?>
               <div class="clear"></div>

	           <?php if ($this->params->get('list_show_author', 1)) : ?>
               <div class="ui-datalist-h-author">
                   <?php if (!empty($article->author) || !empty($article->created_by_alias)) : ?>
                       <?php $author = $article->author ?>
                       <?php $author = $article->created_by_alias ?: $author; ?>
                       <?php if (!empty($article->contact_link) && $this->params->get('link_author') == true) : ?>
                           <?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', $article->contact_link, $author)); ?>
                       <?php else : ?>
                           <?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
                       <?php endif; ?>
                   <?php endif; ?>
               </div>
	           <?php endif; ?>
           </div>
           <div class="ui-datalist-container-body">
               <span>
                    <?php
                        $cont = '';

                        if (isset($article->introtext))
                        {
                            $cont = $article->introtext;
                        }
                        else
                        {
                            $cont = $article->fulltext;
                        }
                        $cont    = str_replace(array("\r\n", "\r"), "", $cont);
                        $pattern = "/<p\s?(.*?)>(.*?)<\/p>/";
                        $matches = null;

                        $countMatches = preg_match_all($pattern, $cont, $matches, PREG_SET_ORDER);

                        if ($countMatches > 0)
                        {
                            $text = '';

                            for ($i = 0; $i <= $countMatches - 1; $i++)
                            {
                                if ($i === 0)
                                {
                                    $text = $matches[0][2];
                                }
                                else
                                {
                                    $text = $text . ' ' . $matches[$i][2];
                                }
                            }

                            $cont = trim(mb_substr($text, 0, 300));

                        }
                        else
                        {
                            $cont = trim(mb_substr($cont, 0, 300));
                        }
                    ?>
                   <?php echo trim($cont); ?>
				</span><a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language)); ?>">
                   <i class="arrow-lft"></i>
               </a>
           </div>
       </div>
   </li>

    <?php endforeach; ?>
</ul>
<?php endif; ?>

<?php if (!empty($this->items)) : ?>

	<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
		<div class="pagination" style="text-align: center;">
<!--			--><?php //if ($this->params->def('show_pagination_results', 1)) : ?>
<!--				<p class="counter pull-right">-->
<!--					--><?php //echo $this->pagination->getPagesCounter(); ?>
<!--				</p>-->
<!--			--><?php //endif; ?>

			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>

<?php endif; ?>
</form>