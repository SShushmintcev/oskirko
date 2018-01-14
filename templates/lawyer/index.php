<?php

//defined('_JEXEC') or die;
defined('_JEXEC') or die('Restricted access');


JLoader::import('joomla.filesystem.file');

JHtml::_('behavior.framework', true);

$app = JFactory::getApplication();

$doc = $app->getDocument();
$doc->setGenerator(null);

$params = $app->getTemplate(true)->params;

$date = JFactory::getDate();
$cur_year = JHtml::_('date', $date, 'Y');

$templatePath = $this->baseurl . '/templates/' . $this->template;

$showWrapMenu = $this->params->get('show-wrap-menu') === '1' ? true : false;

$imgPath = $templatePath . '/img/';

$this->setHtml5(true);

$menu = $app->getMenu();
$lang = JFactory::getLanguage();
$is_home_page = $menu->getActive() == $menu->getDefault($lang->getTag());

$isLeftSide = !!$this->getBuffer('modules','left-side');

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add template scripts
JHtml::_('script', 'templates/' . $this->template . '/scripts/ui.js', array('version' => 'auto'));

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', true);

// Add Stylesheets
JHtml::_('stylesheet', 'templates/system/css/system.css', array('version' => 'auto'));
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));


?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
    <meta name="HandheldFriendly" content="true"/>
    <meta name="apple-mobile-web-app-capable" content="YES"/>
    <jdoc:include type="head"/>
</head>
<body>
<div id="wrapper">

    <div id="lHeader">
        <div class="l-header l-container">
            <div class="l-header-logo left">
                <a href="<?php echo $this->baseurl ?>">
                    <img src="<?php echo $imgPath . 'logo.png' ?>" width="137" height="111"/>
                </a>
            </div>
            <div class="l-header-content left">
                <div class="left h-title-container">
                    <a href="<?php echo $this->baseurl ?>">
                        <span class="block h-title"><?php echo JText::_('TPL_LAWYER_OSKIRKO_TITLE'); ?></span>
                        <span class="block h-cons"><?php echo JText::_('TPL_LAWEYR_CONSULTATION'); ?></span>
                    </a>
                </div>
                <div class="left h-body-container">
                    <jdoc:include type="modules" name="header-body"/>
                </div>
                <div class="left h-body-command">
                    <div class="left">
                        <jdoc:include type="modules" name="search"/>
                    </div>
                    <div class="left">
                        <!--<jdoc:include type="modules" name="letter"/>-->
                        <a href="/index.php/component/mailto/?tmpl=component&amp;template=lawyer&amp;link=ee10c040a13a577f18f9075a254cf695ac623f55" title="Отправить ссылку другу" onclick="window.open(this.href,'win2','width=400,height=350,menubar=yes,resizable=yes'); return false;" rel="nofollow">
                            <input id="searchButton" type="image" src="<?php echo $imgPath . 'letter.png' ?>" /></a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="l-header-law"></div>
            <div class="l-header-check"></div>
            <div class="clear"></div>
        </div>
    </div>

    <div id="lContent">
        <div class="lc-content l-container">
            <div class="l-main-menu">
                <jdoc:include type="modules" name="main-menu"/>
            </div>
            <div class="l-content">
                <div class="l-cont-head <?php echo $is_home_page ? 'l-cont-head-home' : ''; ?>">
                    <div class="left c-left-cont">
                        <?php if ($is_home_page) { ?>
                            <jdoc:include type="modules" name="wrapper-menu"/>
                        <?php } else { ?>
                            <jdoc:include type="modules" name="left-side"/>

                            <?php if (!$isLeftSide) { ?>
                                <jdoc:include type="modules" name="wrapper-menu"/>
                            <?php } ?>

                            <jdoc:include type="modules" name="position-1"/>
                        <?php } ?>
                    </div>
                    <div class="left c-center-cont <?php echo $is_home_page ? 'c-center-cont-fix' : ''; ?>">
                        <div class="c-center-body">
                            <?php if ($is_home_page) { ?>
                                <jdoc:include type="modules" name="main-video"/>
                                <div>
                                    urls
                                </div>
                            <?php } else { ?>
                                <jdoc:include type="modules" name="breadcrumbs"/>
                                <jdoc:include type="component"/>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="left c-right-cont">
                        <jdoc:include type="modules" name="right"/>
                        <?php if (!$is_home_page) { ?>
                            <jdoc:include type="modules" name="position-2"/>
                        <?php } ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php if ($is_home_page) { ?>
                    <div class="l-cont-body">
                        <div class="left c-bot-left-cont">
                            <jdoc:include type="modules" name="bottom-left"/>
                        </div>
                        <div class="left c-bot-center-cont">
                            <jdoc:include type="modules" name="bottom-center"/>
                        </div>
                        <div class="left c-bot-right-cont">
                            <jdoc:include type="modules" name="bottom-right"/>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="l-cont-footer">
                        <jdoc:include type="modules" name="bottom"/>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

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
                        <li><a href="#"><img src="<?php echo $imgPath . 'social/linkedin.png' ?>"/></a></li>
                        <li><a href="#"><img src="<?php echo $imgPath . 'social/twitter.png' ?>"/></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div id="myModal" class="my-modal">-->

    <!-- Modal content -->
<!--    <div class="modal-content">-->
<!--        <span class="close">&times;</span>-->
<!--        <p>Some text in the Modal..</p>-->
<!--    </div>-->

<!--</div>-->
</body>
</html>