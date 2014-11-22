<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		$user = Users::model()->findByPk(Yii::app()->user->id);

		$this->render('index',array('user'=>$user));
	}

}