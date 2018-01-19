<?php

defined('_JEXEC') or die('Restricted access');

$app = JFactory::getApplication();
$date = JFactory::getDate();
$cur_year = JHtml::_('date', $date, 'Y');

$templatePath = $this->baseurl . '/templates/' . $this->template;

$imgPath = $templatePath . '/img/';

$params = $app->getTemplate(true)->params;
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
    <meta name="HandheldFriendly" content="true"/>
    <meta name="apple-mobile-web-app-capable" content="YES"/>

    <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css"
          rel="stylesheet"/>
</head>
<body>

<div id="lHeader">
    <div class="l-header l-container">
        <div class="l-header-logo left">
            <a href="<?php echo $this->baseurl; ?>/index.php">
                <img src="<?php echo $imgPath . 'logo.png' ?>" width="137" height="111"/>
            </a>
        </div>
        <div class="l-header-content">
            <div class="left h-title-container">
                <a href="<?php echo $this->baseurl; ?>/index.php">
                    <span class="block h-title"><?php echo JText::_('TPL_LAWYER_OSKIRKO_TITLE'); ?></span>
                    <span class="block h-cons"><?php echo JText::_('TPL_LAWEYR_CONSULTATION'); ?></span>
                </a>
            </div>
        </div>
        <div class="l-header-law"></div>
        <div class="l-header-check"></div>
    </div>
    <div class="clear"></div>
</div>

<div class="clear"></div>

<div style="min-height: 450px;">
    <div class="lc-content l-container" style="min-height: 250px;">
        <div class="l-content" style="text-align: center;">
            <h2 style="margin: 0px; padding: 25px 0 25px 0;">

                <?php

                $message_text = '';

                switch ($this->error->getCode()) {
                    case 0:
                        $message_text = JText::_('JERROR_ALERTNOTEMPLATE');
                        break;
                    case 404:
                        $message_text = JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND');
                        break;
                    default:
                        $message_text = JText::_('JERROR_ERROR');
                }
                ?>
                <?php echo $this->error->getCode(); ?>&nbsp;
                <?php echo $message_text; ?>
            </h2>
            <a href="<?php echo $this->baseurl; ?>/index.php"><?php echo Jtext::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE') ?></a>
        </div>
    </div>
</div>

<div class="clear"></div>

<div id="lFooter">
    <div class="l-footer l-container">
        <div class="l-footer-content">
            <div class="left l-foot-left">
                <div class="l-footer-back"></div>
                <div class="l-footer-logo left">
                    <a href="<?php echo $this->baseurl ?>">
                        <img src="<?php echo $imgPath . 'logo-footer.png' ?>" width="72" height="59"/>
                    </a>
                </div>
                <div class="l-footer-title left l-footer-top">
                    <div class="lf-title-link">
                        <a href="<?php echo $this->baseurl ?>">
                            <span class="block f-title"><?php echo JText::_('TPL_LAWYER_OSKIRKO_TITLE'); ?></span>
                            <span class="block f-cons"><?php echo JText::_('TPL_LAWEYR_CONSULTATION'); ?></span>
                        </a>
                    </div>
                    <div class="lf-text lf-text-p"><span
                                class="block"><?php echo JText::_('TPL_LAWYER_PALATA'); ?></span></div>
                    <div class="lf-text lf-text-c"><span
                                class="block"><?php echo JText::_('TPL_LAWYER_CITY_PALATA'); ?></span></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="left l-footer-top l-foot-center">
                <jdoc:include type="modules" name="footer"/>
            </div>
            <div class="left l-footer-top l-foot-right">
                <jdoc:include type="modules" name="footer-contacts"/>
            </div>
            <div class="clear"></div>
        </div>

        <div class="separator"></div>

        <div class="l-footer-bottom">
            <div class="left">
                <span class="copyright">&copy;&nbsp;<?php echo JText::_('TPL_LAWYER_COPYRIGHT'); ?></span>
            </div>
            <div class="right">
                <ul class="footer-social g-list">
                    <li><a href="#"><img src="<?php echo $imgPath . 'social/facebook.png' ?>"/></a></li>
                    <li><a href="#"><img src="<?php echo $imgPath . 'social/twitter.png' ?>"/></a></li>
                    <li><a href="#"><img src="<?php echo $imgPath . 'social/twitter.png' ?>"/></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>
