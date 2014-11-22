<?php 
	/**
	 * @author Ian <ianromie@gmail.com>
	 * Common functions
	 */
	class Common
	{

	public static function pre($array,$exit=false){
			echo "<pre>";
			print_r($array);
			echo "</pre>";
			if($exit){
				exit;
			}
		}
	public static function hashPassword($password){
			return md5($password);
		}
	}

?>