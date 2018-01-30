<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$twofactormethods = JAuthenticationHelper::getTwoFactorMethods();
$app              = JFactory::getApplication();

// Output as HTML5
$this->setHtml5(true);

$fullWidth = 1;

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add template js
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'offline.css', array('version' => 'auto', 'relative' => true));

 

// Logo file or site title param
$sitename = $app->get('sitename');

$templatePath = $this->baseurl . '/templates/' . $this->template;
$imgPath = $templatePath . '/img/';

if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . $imgPath . 'logo.png" alt="' . $sitename . '" width="137" height="111 />';

}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
</head>
<body>
  <div id="wrapper">
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
    <div  >
<div style="text-align: center; margin-bottom: 20px; padding-top: 30px;">
              <strong>
                <?php if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) !== '') : ?>
                    <span class="block"><?php echo $app->get('offline_message'); ?></span>
                <?php elseif ($app->get('display_offline_message', 1) == 2) : ?>
                    <span class="block"><?php echo JText::_('JOFFLINE_MESSAGE'); ?></span>
                <?php endif; ?>
              </strong>
            </div>

            <div class="clear"></div>
            <div style="text-align: center;">
                <jdoc:include type="message" />
                <form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login">
                    <div class="block">
                        <label for="username" style="line-height: 30px; padding-right: 5px;"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
                        <input name="username" id="username" type="text" title="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" />
                    </div>

                    <div class="block">
                        <label for="password"  style="line-height: 30px;"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
                        <input type="password" name="password" id="password" title="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" />
                    </div>

                    <?php if (count($twofactormethods) > 1) : ?>
                        <label for="secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
                        <input type="text" name="secretkey" id="secretkey" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" />
                    <?php endif; ?>

                    <input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGIN'); ?>" style="color: #fff; padding: 10px 40px; background: #20003f; margin-top: 10px; border: 1px solid; border-radius: 5px;" />

                    <input type="hidden" name="option" value="com_users" />
                    <input type="hidden" name="task" value="user.login" />
                    <input type="hidden" name="return" value="<?php echo base64_encode(JUri::base()); ?>" />
                    <?php echo JHtml::_('form.token'); ?>
                </form>
            </div>
    </div>
  </div>
</body>
</html>
