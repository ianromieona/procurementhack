<?php
/**
* 
*/
class ProjectController extends Controller
{
	
	function actionView(){
		$this->render('view');
	}

	function actionSearch(){
		Common::pre($_POST,true);
	}
}
?>