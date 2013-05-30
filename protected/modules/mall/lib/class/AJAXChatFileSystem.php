<?php
/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license GNU Affero General Public License
 * @link https://blueimp.net/ajax/
 * @edited Ingwie Phoenix <ingwie2000@googlemail.com>
 */
// Debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Class to provide methods for file system access:
class AJAXChatFileSystem extends Controller {
	
	// completly overwritten...
	public static function getFileContents($file) {
		try{
			$real=Yii::getPathOfAlias("chat").$file;
			ob_start();
			if(file_exists($file))
				include($file);
			else
				include($real);
		
			$buffer = '<?xml version="1.0" encoding="[CONTENT_ENCODING/]"?>'."\n";
			$buffer.= ob_get_contents();

			ob_end_clean();
			return( $buffer );
		} catch (Exception $e) { echo "Error: "; print_r($e); }
	}

}
?>