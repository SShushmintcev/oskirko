<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Import library dependencies
jimport('joomla.plugin.plugin');

class PlgContentCustomPopup extends JPlugin
{
    function onContentPrepare($context, &$article, &$params, $page = 0) {	//Load the plugin language file - not in contructor in case plugin called by third party components
	    $application = JFactory::getApplication();

	    if ($context !== "com_content.article"){
	    	return;
	    }

	    $regex = "#{custompopup\s(.*?)\}(.*?){/custompopup}#s";

	    if ( !preg_match($regex, $article->text)) {
		    return;
	    }

	    $doc =& JFactory::getDocument();
	    $headerstuff = $doc->getHeadData();


	    $countMatches = preg_match_all($regex, $article->text, $matches, PREG_SET_ORDER);

	    $bracket_reg = '/{+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^}]*\/*\s*}+/i';

	    $t = preg_replace( $bracket_reg, '', $matches[0] );


	    return true;
    }

	function onContentBeforeDisplay($context, $item, $params, $limitstart = 0) {

    	return '';
	}

    function onContentAfterDisplay($context, &$row, &$params, $limitstart = 0) {


	    return '';
    }
}

?>