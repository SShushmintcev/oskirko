<?php

/**
 * Created by PhpStorm.
 * User: S.Shushmintsev
 * Date: 19.12.2017
 * Time: 17:25
 */

defined('_JEXEC') or die('Restricted access');

use Joomla\String\StringHelper;

$app = JFactory::getApplication();
$date = JFactory::getDate();
$cur_year = JHtml::_('date', $date, 'Y');
$csite_name = $app->get('sitename');


$imgPath = $this->baseurl . '/templates/' . $this->template;



// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));

?>
 <!DOCTYPE html>
 <html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
    <head>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
        <meta name="HandheldFriendly" content="true" />
        <meta name="apple-mobile-web-app-capable" content="YES" />
        <jdoc:include type="head" />
    </head>
    <body>

    <div id="lHeader">
        <div class="l-header l-container">

            <div class="l-header-logo left">
                <jdoc:include type="modules" name="header-logo" style="" />
            </div>
            <div class="l-header-content left">
                <jdoc:include type="modules" name="header-body" style="" />
            </div>
        </div>

        <div class="clear"></div>
      
    </div>

    <div class="clear"></div>

    <div id="lMainMenu">
    <div class="l-main-menu l-container">
                <jdoc:include type="modules" name="position-1" />
            </div>
    </div>

    <div class="lContent">        
        <div class="l-content l-container">        
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
                            <li><a href="#"><img src="<?php echo $imgPath . '/img/social/facebook.png' ?>"></a></li>
                            <li><a href="#"><img src="<?php echo $imgPath . '/img/social/linkedin.png' ?>"></a></li>
                            <li><a href="#"><img src="<?php echo $imgPath . '/img/social/twitter.png' ?>"></a></li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="clear"></div>

        

    <div>
        <jdoc:include type="modules" name="debug" style="none" />
    </div>
    </body>
 </html>