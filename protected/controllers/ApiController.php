<div class="header">
	<form>
	<div class="row-fluid">
		<div class="span6">
		<input type="text" name="searchField" class="bigSearch input-xlarge searchFor" placeholder="SEARCH">
		</div>
	</div>
	</form>
</div>
<div id="banner">
	<div class="container intro_wrapper">
	<div class="inner_content">
	<h1>Inspiration</h1>
	<h1 class="title">Dribbble Photostream</h1>
	
	<h1 class="intro">
	Web design is the creation of <span class="hue">digital environments</span>, that <span>facilitate</span> and encourage human activity; 
	<span>reflect </span> or adapt to individual voices and content. - Jeffrey Zeldman</h1>
	</div>
	</div>
</div>
<div class="listContainer">
	<div class="row-fluid">
		<div class="span4">
		</div>
		<div class="span4">
		</div>
		<div class="span4">
		</div>
	</div>
</div>
<div class="searchBox hide">
</div>
<style>
	.listContainer{
		margin-top:10px;
		margin-left:20px;
		margin-right:20px;
		padding:5px;
	}
	.bigSearch{
		height:25px !important;
		margin-top:23px;
		margin-left:10px;
		font-size:18px !important;
	}
	.searchBox{
		position:fixed; 
		top:0; 
		left:0; 
		background:rgba(0,0,0,0.9); 
		z-index:5; 
		width:100%; 
		height:100%;
	}
</style>
<script>
	$(document).ready(function(){
		
	});
</script>
<?php

class ApiController extends Controller
{
	public function actionCallData(){
		$query = $_GET['query'];
		$data = PhilgepsApi::listPhilgepsData($query);

		return $data;
	}
}