<?php

/**
 * API from Philgeps.
 */

class PhilgepsApi extends CFormModel
{
	public static function listPhilgepsData($query){

		// guide for the table variable
		// award 		 =	539525df-fc9a-4adf-b33d-04747e95f120
		// bidders list	 = 	6427affb-e841-45b8-b0dc-ed267498724a
		// organization	 =	ec10e1c4-4eb3-4f29-97fe-f09ea950cdf1
		// bid line item =	daa80cd8-da5d-4b9d-bb6d-217a360ff7c1
		// bind info 	 = 	baccd784-45a2-4c0c-82a6-61694cd68c9d
		// project loc   = 	116b0812-23b4-4a92-afcc-1030a0433108
		// org business	 = 	58ea40bf-15e9-4c38-adef-fd93455d8c7e

		$url = str_replace(' ', '%20',"http://philgeps.cloudapp.net:5000/api/action/datastore_search_sql?sql=".$query);
		
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