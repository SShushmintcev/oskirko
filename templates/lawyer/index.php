<?php

defined('_JEXEC') or die;
//defined('_JEXEC') or die('Restricted access');

JLoader::import('joomla.filesystem.file');

JHtml::_('behavior.framework', true);

$app = JFactory::getApplication();
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
    <!--    <meta name="HandheldFriendly" content="true"/>-->
    <!--    <meta name="apple-mobile-web-app-capable" content="YES"/>-->
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

<div id="lMainMenu">
    <div class="l-main-menu l-container">
        <jdoc:include type="modules" name="main-menu"/>
    </div>
</div>

<div id="lContent">
    <div class="l-content l-container">
        <div class="left side-container">
            <jdoc:include type="modules" name="side-menu"/>
        </div>
        <div class="left">2</div>
        <div class="left">3</div>
        <div class="clear"></div>

        <div class="left">4</div>
        <div class="left">5</div>
        <div class="left">6</div>
        <div class="clear"></div>
        <div>MAP</div>
    </div>
</div>

<div class="clear"></div>

<div id="lFooter">
    <div class="l-footer l-container">
        <div class="l-footer-content">
            <!-- <jdoc:include type="modules" name="footer" style="" /> -->
        </div>

        <div>

            <div class="separator"></div>

            <div class="l-footer-bottom">

                <div class="left">
                    <span class="copyright">&copy; <?php echo JText::_('TPL_LAWYER_COPYRIGHT'); ?> <?php echo date('Y'); ?></span>
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