<?php
/**
 * @package Joomly Contactus for Joomla! 2.5 - 3.x
 * @version 3.15
 * @author Artem Yegorov
 * @copyright (C) 2016- Artem Yegorov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
require_once JPATH_COMPONENT.'/controller.php';


class ContactusControllerFeedback extends ContactusController
{

	public function send()
	{
		$reply = array();	
		$reply = JRequest::get('post');
		$model= $this->getModel('feedback');
		$model->sendMessage($reply);
		$app = JFactory::getApplication();
		$app-> redirect(JRoute::_('index.php?option=com_contactus&view=list'));
	}

}
