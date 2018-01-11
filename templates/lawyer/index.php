<?php

//defined('_JEXEC') or die;
defined('_JEXEC') or die('Restricted access');


JLoader::import('joomla.filesystem.file');

JHtml::_('behavior.framework', true);

$app = JFactory::getApplication();

$doc = $app->getDocument();
$doc->setGenerator(null);


$date = JFactory::getDate();
$cur_year = JHtml::_('date', $date, 'Y');
$csite_name = $app->get('sitename');


$templatePath = $this->baseurl . '/templates/' . $this->template;

$imgPath = $templatePath . '/img/';

$this->setHtml5(true);

$params = $app->getTemplate(true)->params;

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add template scripts
JHtml::_('script', 'templates/' . $this->template . '/scripts/ui.js', array('version' => 'auto'));

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false);

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

            <div class="left">
                <jdoc:include type="modules" name="position-0"/>
            </div>
            <div class="left">
                letter
            </div>
            <div class="clear"></div>
        </div>
        <div class="l-header-law"></div>
        <div class="l-header-check"></div>
    </div>
    <div class="clear"></div>
</div>

<div class="clear"></div>

<div id="lContent">
    <div class="lc-content l-container">
        <div class="l-main-menu">
            <jdoc:include type="modules" name="main-menu"/>
        </div>
        <div class="l-content">
            <div class="l-cont-head">
                <div class="left c-left-cont">
                    <jdoc:include type="modules" name="side-menu"/>
                </div>
                <div class="left c-center-cont">
                    <div class="c-center-body">
                        <jdoc:include type="modules" name="main-video"/>
                        <div>
                            urls
                        </div>
                    </div>
                </div>
                <div class="left c-right-cont">
                    <jdoc:include type="modules" name="right"/>
                </div>
                <div class="clear"></div>
            </div>
            <div class="l-cont-body">
                <div class="left c-bot-left-cont"><jdoc:include type="modules" name="bottom-left"/></div>
                <div class="left c-bot-center-cont"><jdoc:include type="modules" name="bottom-center"/></div>
                <div class="left c-bot-right-cont"><jdoc:include type="modules" name="bottom-right"/></div>
                <div class="clear"></div>
            </div>

            <div class="l-cont-footer">
                <jdoc:include type="modules" name="bottom"/>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
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
                        <img src="<?php echo $imgPath . 'logo.png' ?>" width="97" height="68"/>
                    </a>
                </div>

                <div class="l-footer-title left l-footer-top">
                    <div class="lf-title-link">
                        <a href="<?php echo $this->baseurl ?>">
                            <span class="block f-title"><?php echo JText::_('TPL_LAWYER_OSKIRKO_TITLE'); ?></span>
                            <span class="block f-cons"><?php echo JText::_('TPL_LAWEYR_CONSULTATION'); ?></span>
                        </a>
                    </div>
                    <div class="lf-text lf-text-p"><span class="block"><?php echo JText::_('TPL_LAWYER_PALATA'); ?></span></div>
                    <div class="lf-text lf-text-c"><span class="block"><?php echo JText::_('TPL_LAWYER_CITY_PALATA'); ?></span></div>
                </div>

                <div class="clear"></div>
            </div>

            <div class="left l-footer-top l-foot-center"><jdoc:include type="modules" name="footer" style="" /></div>
            <div class="left l-footer-top l-foot-right">contacts</div>
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


<div class="clear"></div>


<div>
    <jdoc:include type="modules" name="debug" style="none"/>
</div>

<!--<script type="text/javascript">-->
<!--    jQuery(document).ready(function($){-->
<!--        $(function() {-->
<!---->
<!--            // add dropdown to the list element that contains first dropdown list-->
<!--            $('ul.nav.menu > li.parent').addClass('dropdown');-->
<!--            // add dropdown-toggle, data-toggle and disabled to the main dropdown <a> (allows it to work correctly on the ipad, requiring a rollover to show the menu-->
<!--            $('ul.nav.menu > li.parent > a').addClass('dropdown-toggle').attr('data-toggle', 'dropdown').attr('disabled', '');-->
<!--            // adds dropdown-menu to the first dropdown (basically the whole first menu)-->
<!--            $('ul.nav.menu > li.parent > ul.nav-child').addClass('dropdown-menu');-->
<!--            // add dropdown-submenu to the list element that contains the submenu (this adds the arrow to the element)-->
<!--            $('ul.nav-child > li.parent').addClass('dropdown-submenu');-->
<!--            // add dropdown menu to the submenu ul (basically the whole other menu) and style it with nav-child-sub-->
<!--            $('ul.nav-child > li.parent > ul.nav-child').addClass('dropdown-menu').removeClass('nav-child').addClass('nav-child');-->
<!---->
<!--        });-->
<!--    });-->
<!--</script>-->

</body>
</html>