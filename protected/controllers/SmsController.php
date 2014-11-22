<?php

class SmsController extends Controller
{
	function actionRedirect(){
		$formdata = serialize($_GET);
		$formdata = unserialize($formdata);

		if(isset($formdata["code"])){
			$url = str_replace(' ', '%20',"http://developer.globelabs.com.ph/oauth/access_token");
			$params = array(
				'app_id'=>Yii::app()->params["appId"],
				'app_secret'=>Yii::app()->params["appSecret"],
				'code'=>$formdata["code"]
			);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			$result = json_decode(curl_exec($ch),TRUE);
			curl_close($ch);

			Common::pre($result["access_token"], true);

			if(isset($result)){
				Yii::app()->session["access_token"] = $result["access_token"];
				$user 		 = Users::model()->findByPk(Yii::app()->user->id);
				//Common::pre(Yii::app()->user, true);
				$user->auth_token = $result["access_token"];
				$user->mobile = $result["subscriber_number"];
				$user->save(false);
			}else{
				return "error";
			}
			$this->redirect("/site/index");
		}
	}

	function actionFetch(){
		$formdata = serialize($_POST);
		$formdata = unserialize($formdata);
		$hasResult = true;
		/*if(isset($formdata)){
			$param = $formdata;
			$query = PhilGeps::searchWithFilter($param);
			$result = PhilGeps::listPhilgepsData($query);

		}*/

		if($hasResult){
			$list = Users::model()->findAll("auth_token <> ''");
			//Common::pre($list, true);
			foreach ($list as $value) {
				$mobile = $value["mobile"];
				$access_token = $value["auth_token"];
				$message = "This is a message";
				Common::sendMessage($mobile, $access_token, $message);
			}
		}

	}


}