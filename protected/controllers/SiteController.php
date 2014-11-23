<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		if(isset($_GET["successsubscribe"])){

			Yii::app()->user->setFlash('alert','You have successfully subscribed to notification');
		}
		$buyer = "Select COUNT(*) from \"ec10e1c4-4eb3-4f29-97fe-f09ea950cdf1\" where member_type_id = 2 AND org_status = 'Active'";
		$seller = "Select COUNT(*) from \"ec10e1c4-4eb3-4f29-97fe-f09ea950cdf1\" where member_type_id = 3 AND org_status = 'Active'";
		$cso = "Select COUNT(*) from \"ec10e1c4-4eb3-4f29-97fe-f09ea950cdf1\" where member_type_id = 7 AND org_status = 'Active'";

		$perLoc = "Select COUNT(*) as count, location from \"116b0812-23b4-4a92-afcc-1030a0433108\" group by location order by count DESC";

		$bids = "Select COUNT(*) as count, bidder_name from \"6427affb-e841-45b8-b0dc-ed267498724a\" group by bidder_name order by count DESC";
		$bCount = PhilgepsApi::listPhilgepsData($buyer);
		$sCount = PhilgepsApi::listPhilgepsData($seller);
		$cCount = PhilgepsApi::listPhilgepsData($cso);
		$perLocation = PhilgepsApi::listPhilgepsData($perLoc);
		$bid = PhilgepsApi::listPhilgepsData($bids);
		$this->render('index',array('buyer'=>$bCount[0]['count'],'seller'=>$sCount[0]['count'],'cso'=>$cCount[0]['count'],'location'=>$perLocation,'bid'=>$bid));
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex2()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		$this->render('index2');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(!Yii::app()->user->isGuest){
			$this->redirect(array('site/index'));
		}
		$model=new Users('login');
		$modelr=new Users('register');

		

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($modelr);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['Users']) && isset($_POST['loginBtn']))
		{
			$model->attributes=$_POST['Users'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				$this->redirect(Yii::app()->user->returnUrl);
			}else{
				Yii::app()->user->setFlash('alert','Invalid username/password');
			}
		}
		if(isset($_POST['Users']) && isset($_POST['registerBtn']))
		{
			$modelr->attributes=$_POST['Users'];
			$model->attributes=$_POST['Users'];
			$modelr->password=Common::hashPassword($_POST['Users']['password']);
			// validate user input and redirect to the previous page if valid

			if($modelr->validate() && $modelr->save(false)){

				if($model->login()){
					$this->redirect(array('site/index'));
				}
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model,'modelr'=>$modelr));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}