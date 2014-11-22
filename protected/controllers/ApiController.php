<?php

class ApiController extends Controller
{
	public function actionCallData(){
		$query = $_GET['query'];
		$data = PhilgepsApi::listPhilgepsData($query);

		echo json_encode($data);
	}
}