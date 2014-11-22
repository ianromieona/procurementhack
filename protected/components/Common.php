<?php 
	/**
	 * @author Ian <ianromie@gmail.com>
	 * Common functions
	 */
	class Common
	{
		function pre($array,$exit){
			echo "<pre>";
			print_r($array);
			echo "</pre>";
			if($exit){
				exit;
			}
		}
		function hashPassword($password){
			return md5($password);
		}
	}

?>