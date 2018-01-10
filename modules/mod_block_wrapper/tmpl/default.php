<?php

defined('_JEXEC') or die;

$cont = '';
if (isset($data->body->introtext))
{
	$cont = $data->body->introtext;
}
else
{
	$cont = $data->body->fulltext;
}

$bodylenght = strlen($cont);

$BWBodyHeight = $data->height;
$blockHeight  = $data->height + 140;

$cont = str_replace(array("\r\n", "\r"), "", $cont);

if ($bodylenght > $BWBodyHeight)
{
	$pattern = "/<p>(.*)<\/p>/";
	$matches = null;
	preg_match($pattern, $cont, $matches, PREG_OFFSET_CAPTURE);

	if ($matches)
	{
		$cont = trim(substr($matches[1][0], 0, ($BWBodyHeight + 135)));
	}
	else
	{
		$cont = trim(substr($cont, 0, ($BWBodyHeight + 135)));
	}

//	$cont = $cont . " ...";
}
?>

<div class="block-wrapper block-wrapper-<?php echo $data->style ?>"
     style="width: <?php echo $data->width ?>px;">
    <div class="block-wrapper-title-line"></div>
    <div class="block-wrapper-title wrapper-title-<?php echo $data->style ?>">
        <div class="block-wrapper-check wrapper-check-<?php echo $data->style ?>"></div>
		<?php if ($showTitle) { ?>
            <span class="block-wrapper-text-title bw-title-<?php echo $data->style ?>">
            <?php echo mb_strtoupper($data->title) ?>
        </span>
		<?php } ?>
    </div>
    <div class="block-wrapper-body block-wrapper-body-<?php echo $data->style ?>"
         style="height: <?php echo $BWBodyHeight ?>px">
        <div class="block-wrapper-body-content" style="height: <?php echo $BWBodyHeight - 10 ?>px">
			<?php echo html_entity_decode($cont) ?>
			<?php if ($showArticleLink) { ?>
                &nbsp;<a href="<?php echo $document->baseurl . $data->body->link; ?>"><i>1</i></a>
			<?php } ?>
        </div>
    </div>

    <div class="block-wrapper-footer bw-footer-<?php echo $data->style ?>">
		<?php if ($showFooter) { ?>
            <div class="bw-footer-content">
                <a href="<?php echo $document->baseurl . $footerUrl ?>"><span><?php echo JText::_('MOD_BLOCK_WRAPPER_FOOTER_LINK_ALL'); ?>
                        &nbsp;<?php echo mb_strtolower($data->title) ?></span></a>
            </div>
		<?php } ?>
    </div>

</div>