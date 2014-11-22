<?php

/**
 * API from Philgeps.
 */

class PhilgepsApi extends CFormModel
{
	public static function listPhilgepsData($table,$data = '*',$condition){
		$url = "http://philgeps.cloudapp.net:5000/api/action/datastore_search_sql?sql=SELECT ".$data." from '".$table."' ".$condition;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$result = json_decode(curl_exec($ch),TRUE);
		curl_close($ch);
		return $result;
	}
}