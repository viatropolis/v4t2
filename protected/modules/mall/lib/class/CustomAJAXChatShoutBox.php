<?php
/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license GNU Affero General Public License
 * @link https://blueimp.net/ajax/
 */

class CustomAJAXChatShoutBox extends CustomAJAXChat {

	function initialize() {
		// Initialize configuration settings:
		$this->initConfig();
	}

	function getShoutBoxContent() {
		$template = new AJAXChatTemplate($this, '/views/shoutbox.php');
		
		// Return parsed template content:
		return $template->getParsedContent();
	}	

}
?>