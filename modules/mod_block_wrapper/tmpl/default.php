<?php

defined('_JEXEC') or die;

$cont = '';
if (isset($data->body->introtext)) {
    $cont = $data->body->introtext;
} else {
    $cont = $data->body->fulltext;
}

$BWBodyHeight = $data->height;
$blockHeight = $data->height + 136;

$cont = str_replace(array("\r\n", "\r"), "", $cont);
//$pattern = "/<p\s?(.*?)>(.*?)<\/p>/";
//$matches = null;
//
//
//if (preg_match($pattern, $cont, $matches, PREG_OFFSET_CAPTURE)) {
//    $cont = $matches[2][0];
//}

//$existIFRAME = null;
//
//if (!preg_match("/iframe/", $cont, $existIFRAME, PREG_OFFSET_CAPTURE)) {
//    $bodylength = mb_strlen($cont);
//
//    if ($bodylength > $blockHeight) {
//
//        $strLength = $showArticleLink ? $blockHeight - 3 : $blockHeight;
//
//        $cont = trim(mb_substr($cont, 0, $strLength));
//    }
//}
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
         style="height: <?php echo $BWBodyHeight ?>px">
        <div class="block-wrapper-body-content">
            <?php echo html_entity_decode($cont) ?>
            <?php if ($showArticleLink) { ?>
                &nbsp;<a href="<?php echo $document->baseurl . $data->body->link; ?>"><i class="arrow-lft"></i></a>
            <?php } ?>
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