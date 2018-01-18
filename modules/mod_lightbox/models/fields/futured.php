<?php 
/**
 * @package Huge IT portfolio
 * @author Huge-IT
 * @copyright (C) 2014 Huge IT. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @website		http://www.huge-it.com/
 **/
 
defined('_JEXEC') or die('Restricted access');


class JFormFieldFutured extends JFormField {

    protected $type = 'ckillustration';
    
    protected function getInput() {
        $module = strrchr(dirname(dirname(__FILE__)), 'mod_');
        $doc = JFactory::getDocument();
        $doc->addScript(JURI::root(true) . "/media/mod_lightbox/js/admin.js");
        $doc->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js");
        $doc->addScript(JURI::root(true) . "/media/mod_lightbox/js/jscolor/jscolor.js");
        $doc->addScript(JURI::root(true) . "/media/mod_lightbox/js/simple-slider.js");
        
        
        JHtml::stylesheet('media/mod_lightbox/css/simple-slider.css');
        JHtml::stylesheet('media/mod_lightbox/css/style.css');
        JHtml::stylesheet('media/mod_lightbox/css/admin.style.css');
        JHtml::stylesheet('media/mod_lightbox/css/futured.style.css');

         
        $type_ = $this->element['type_'];
		if($type_== "text"){
                    return '<div class="element hugeitmicro-item">
                 		<div class="title-block"><h3><p>Soon we will introduce to you our new wonderful pluginds.</p></h3></div>
                            </div>';
                }
    }

    
	


}

