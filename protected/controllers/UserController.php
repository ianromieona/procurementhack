<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		$user = Users::model()->findByPk(Yii::app()->user->id);
		$filters = Filters::model()->findByAttributes(array('userId'=>Yii::app()->user->id));
		$cat = Categories::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
		if(isset($_POST['submit'])){
			Users::userEdit($_POST['User'],$_POST['budget'],$_POST['classification'],$_POST['hidden-tags'],$_POST['hidden-cat']);
			$this->redirect('user/index');
		}

		$this->render('index',array('user'=>$user,'filters'=>$filters,'cat'=>$cat));
	}

	public function actionGetCategory(){
		$q = "Select distinct(business_category) from \"baccd784-45a2-4c0c-82a6-61694cd68c9d\" b";
		$cat = PhilgepsApi::listPhilgepsData($q);
		echo json_encode($cat);
	}

}