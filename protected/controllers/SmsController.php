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

			//Common::pre($result["access_token"], true);

			if(isset($result)){
				Yii::app()->session["access_token"] = $result["access_token"];
				$user 		 = Users::model()->findByPk(Yii::app()->user->id);
				//Common::pre($user, true);
				$user->auth_token = $result["access_token"];
				$user->mobile = $result["subscriber_number"];
				$user->save(false);
			}else{
				return "error";
			}
			$this->redirect("/procurementhack/site/index?successsubscribe");
		}
	}

	//curl -d "dateFrom=&dateTo=" "http://procurementhack.ngrok.com/procurementhack/"
	function actionFetch(){
		$formdata = serialize($_POST);
		$formdata = unserialize($formdata);
		$hasResult = false;
		if(isset($formdata)){
			$param = $formdata;
			$param["limit"] = 100;
			$param["offset"] = 0;
			$query = PhilGepsApi::searchWithFilter($param);
			//Common::pre($query, true);
			$result = PhilGepsApi::listPhilgepsData($query);
			//Common::pre($result, true);
			if($result){
				$hasResult = true;
				foreach ($result as  $value) {
					//Common::pre($value, true);
					$model = Post::model()->findByAttributes(array("ref_id" => $value['ref_id']));
					if(!$model)
						$model = new Post;
					$model->ref_id = $value['ref_id'];
					$model->publish_date = $value['publish_date'];
					$model->classification = $value['classification'];
					$model->description = $value['description'];
					$model->business_category = $value['business_category'];
					$model->location = $value['location'];
					$model->tender_title = $value['tender_title'];
					$model->save(false);
				}
			}
		}

		if($hasResult){
			$list = Users::model()->findAll("auth_token <> ''");
			//Common::pre($list, true);
			foreach ($list as $user) {
				$filters = Filters::model()->findByAttributes(array('userId'=>Yii::app()->user->id));
				$cat = Categories::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
				$params["tags"] = explode("|", $filters["tags"]);
				$params["classication"] = $filters["classification"];
				$params["category"] = array();
				foreach ($cat as $key => $value3) {
					array_push($params["category"], $value3["category_name"]);
				}
				//00Common::pre($params, true);
				$postlist = Post::model()->searchPost($params);
				//Common::pre($postlist, true);
				if($postlist){
					foreach ($postlist as $value2) {
						$a = PostUser::model()->findByAttributes(array("post_id" => $value2["id"], "user_id" => $user["id"]));
						if(!$a){
							$postuser = new PostUser;
							$postuser->post_id = $value2["id"];
							$postuser->user_id = $user["id"];
							//Common::pre($postuser, true);
							$postuser->save(false);
						}
					}
					$mobile = $user["mobile"];
					$access_token = $user["auth_token"];
					$message = "There are ".sizeof($postlist)." new post. Visit your account for details";
					//echo $message;
					Common::sendMessage($mobile, $access_token, $message);
				}else{
					echo "No updates for ".$user["id"]."<br>";
				}
			}
		}

	}


}