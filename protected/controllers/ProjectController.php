<?php
/**
* 
*/
class ProjectController extends Controller
{

	public function actionView($id){
		$data = "Select ref_no, procuring_entity_org, tender_title, l.location, solicitation_no, trade_agreement, procurement_mode, classification, business_category, approved_budget, client_agency_org, contact_person, contact_person_address, description, tender_status, publish_date, b.modified_date, closing_date from \"baccd784-45a2-4c0c-82a6-61694cd68c9d\" b LEFT JOIN \"116b0812-23b4-4a92-afcc-1030a0433108\" l ON b.ref_id = l.refid WHERE b.ref_id = '".$id."'";
		$pdata = PhilgepsApi::listPhilgepsData($data);
		$item = "Select * from \"daa80cd8-da5d-4b9d-bb6d-217a360ff7c1\" a where ref_id='".$id."'";
		$idata = PhilgepsApi::listPhilgepsData($item);
		// $param['pdateFrom'] = '2009-06-10T00:00:00';
		// $param['pdateTo'] = '2009-06-20T00:00:00';
		// $param['budgetMin'] = 100;
		// $param['budgetMax'] =101;
		// $param['location']= "Batangas";
		// $param['category'] = array('Pest Control Services','Surveying Services');
		// $param['searchTags'] = array('Publication','Serv');
		// Common::pre(PhilgepsApi::searchWithFilter($param),true);
		// Common::pre(PhilgepsApi::listPhilgepsData(PhilgepsApi::searchWithFilter($param)),true);
		$this->render('view',array('data'=>$pdata[0],'refId'=>$id,'items'=>$idata));
	}
}
?>