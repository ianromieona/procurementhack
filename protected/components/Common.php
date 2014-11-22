<?php 
	/**
	 * @author Ian <ianromie@gmail.com>
	 * Common functions
	 */
	class Common
	{
		static function pre($array,$exit){
			echo "<pre>".print_r($array)."</pre>";
			if($exit){
				exit;
			}
		}
		function hashPassword($password){
			return md5($password);
		}
	}

?>