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

	public static function sendMessage($service_number, $access_token, $message){
		$senderAddressSuffix = substr(Yii::app()->params["shortCode"], strlen(Yii::app()->params["shortCode"])-4);
		$url = str_replace(' ', '%20',"http://developer.globelabs.com.ph/smsmessaging/v1/outbound/{senderAddress}/requests?access_token={access_token}");
		$url = str_replace('{senderAddress}',$senderAddressSuffix, $url);
		$url = str_replace('{access_token}',$access_token, $url);
		//Common::pre($url, true);
		$service_number = strlen($service_number) == 10 ? "0".$service_number : $service_number;
		$params = array(
			'senderAddress' => "tel:".$senderAddressSuffix,
			'address'=> "tel:".$service_number,
			'message'=> $message
		);
		Common::pre(json_encode($params), true);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$result = json_decode(curl_exec($ch),TRUE);
		curl_close($ch);
		Common::pre($result);
	}
}

?>