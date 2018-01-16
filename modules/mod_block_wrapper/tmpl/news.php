<?php

defined('_JEXEC') or die;

$BWBodyHeight = $data->height;
$blockHeight = $data->height + 140;
?>

<div class="block-wrapper block-wrapper-<?php echo $data->style ?>" style="width: <?php echo $data->width ?>px;">
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
         style="height: <?php echo $BWBodyHeight ?>px;">
        <div class="block-wrapper-body-content">
            <ul class="bw-list">
				<?php foreach ($data->body as $item) : ?>
                    <li class="bw-list-item">
                        <div class="bw-list-item-date">
							<?php echo JHtml::_('date', $item->publish_up, 'd F Y'); ?>
                        </div>
                        <div class="bw-list-item-content">
							<span>
                                <?php
                                $cont = '';

                                if (isset($item->introtext))
                                {
	                                $cont = $item->introtext;
                                }
                                else
                                {
	                                $cont = $item->fulltext;
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

	                                $cont = trim(mb_substr($text, 0, 150));

                                }
                                else
                                {
	                                $cont = trim(mb_substr($cont, 0, 150));
                                }
                                ?>

                                <?php echo $cont ?>
								</span>
							<?php if ($showArticleLink) { ?>
                                &nbsp;<a href="<?php echo $document->baseurl . $item->link; ?>"><i
                                            class="arrow-lft"></i></a>
							<?php } ?>
                        </div>
                    </li>
				<?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="block-wrapper-footer bw-footer-<?php echo $data->style ?>">
		<?php if ($showFooter) { ?>
            <div class="bw-footer-content">

				<?php if (isset($footerUrlText)) { ?>
                    <a href="<?php echo $document->baseurl . $footerUrl ?>"><span><?php echo $footerUrlText; ?></span></a>
				<?php } else { ?>
                    <a href="<?php echo $document->baseurl . $footerUrl ?>"><span><?php echo JText::_('MOD_BLOCK_WRAPPER_FOOTER_LINK_ALL'); ?>
                            &nbsp;<?php echo mb_strtolower($data->title) ?></span></a>
				<?php } ?>
            </div>
		<?php } ?>
    </div>

</div>