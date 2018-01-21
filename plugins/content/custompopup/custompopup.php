<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\String\StringHelper;

// Import library dependencies
jimport('joomla.plugin.plugin');

define('SPU_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'custompopup');

class PlgContentCustomPopup extends JPlugin
{
	function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		if ($context !== "com_content.article")
		{
			return;
		}

		$regex = "#{custompopup\s(.*?)\}(.*?){/custompopup}#s";

		if (!preg_match($regex, $article->text))
		{
			return;
		}

		$this->isAddScript = false;
		$this->observer    = "popup-show";

		$t = preg_replace_callback($regex, array('PlgContentCustomPopup', 'test'), $article->text, -1, $count);

		self::addScript();

		$article->text = $t;

		return true;
	}

	private function test(&$matches)
	{
		$html = '';

		$path          = JPluginHelper::getLayoutPath('content', 'custompopup', 'default');
		$this->blockId = '';
		$this->hidden  = ' style="display: none;"';
		$patternId     = '/(?<=id=)(.*)/';

		if (preg_match($patternId, $matches[1], $matchId))
		{
			$value         = preg_replace('/[\'\"]/', '', $matchId[1]);
			$this->blockId = $value;
		}

		$this->blockContent = $matches[2];

		ob_start();

		include $path;

		$html = ob_get_clean();

		return $html;
	}

	private function addScript()
	{
		echo '<script language="javascript" type="text/javascript">', chr(10);
		echo '<!--', chr(10);
		echo '	jQuery(document).ready(function() {', chr(10);
		echo '      var that = this;', chr(10);
		echo '      that.popup = null;', chr(10);
		echo '      jQuery(".' . $this->observer . '").hover(function(e){
	                 var target = e.currentTarget;	                 
	                 var targetId = target.id;	                 
	                 var block = document.getElementById("block-" + targetId + "");
	                 
	                 if (block) {	                    
	                    var parentPosition = jQuery(target.parentElement).offset();
                        var targetPosition = jQuery(target).offset();

                        var jBlock = jQuery(block);
                        var blockWidth = jBlock.width();
	                    
	                    var options = {
			                target: target,
			                top: targetPosition.top - parentPosition.top + 60,
			                size: target.offsetWidth + 50,
			                content: block.innerHTML,
			                width: blockWidth < 450 ? 450 : (blockWidth >= 600 ? 590 : blockWidth + 40)
			            };
			
			            that.popup = new ui.popup(options);
			            that.popup.show();	                 
	                 }
	                },function(e){
					    if (that.popup !== null) {
	                        that.popup.close();
	                        that.popup = null;
	                    }
				    },);', chr(10);
		echo '	});', chr(10);

		echo '	-->', chr(10);
		echo '</script>', chr(10);
	}
}

?>