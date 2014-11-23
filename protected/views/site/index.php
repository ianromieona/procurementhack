<div id="morphsearch" class="morphsearch">
	<form class="morphsearch-form" method="POST" action="<?php echo Yii::app()->createAbsoluteUrl('project/search'); ?>">
		<input class="morphsearch-input" name="keyword" id="searchText" autocomplete="off" type="text" placeholder="Search..."/>
		<input type="hidden" name="location" id="location">
		<button class="morphsearch-submit" type="submit" value="search"><i class="fa fa-search"></i></button>
	</form>
	<div class="morphsearch-content">
		<div class="dummy-column nearby">
			<h1 class="loc">Projects in </h1>
		</div>
		<div class="dummy-column rated">
			<h1>Top Budgeted</h1>
		</div>
		<div class="dummy-column recent">
			<h1>Most Recent</h1>
		</div>
	</div><!-- /morphsearch-content -->
	<span class="morphsearch-close"></span>
</div><!-- /morphsearch -->
<div class="overlay"></div>
</div><!-- /container -->
<div id="banner">
	<div class="container intro_wrapper">
		<div class="inner_content">
			<a href="<?php echo Yii::app()->createAbsoluteUrl('site/login'); ?>"><span class="brand">TipBiz<br/><small style="padding-left:55px;color:#CC0000;font-weight:600">Be Aware</small></span></a>
		</div>
	</div>
</div>
<div class="loginLink"><a href="<?php echo Yii::app()->createAbsoluteUrl('sit/login'); ?>">LOGIN</a></div>
<div class="container wrapper analytics">
	<div class="pad30"></div>
	<h1 class="title">Organization Analysis</h1>
	<div class="row-fluid">
		<div class="span4 stat">
			<div class="text-center statTitle"><i class="icon fa fa-users"></i> Buyer Analysis</div>
			<div class="text-center statResult" id="buyer"><?php echo $buyer; ?></div>
			<div class="text-center sub">ORGANIZATION(S)</div>
		</div>
		<div class="span4 stat">
			<div class="text-center statTitle"><i class="icon fa fa-truck"></i> Supplier Analysis</div>
			<div class="text-center statResult" id="seller"><?php echo $seller; ?></div>
			<div class="text-center sub">ORGANIZATION(S)</div>
		</div>
		<div class="span4 stat">
			<div class="text-center statTitle"><i class="icon fa fa-pagelines"></i> CSO Analysis</div>
			<div class="text-center statResult" id="cso"><?php echo $cso; ?></div>
			<div class="text-center sub">ORGANIZATION(S)</div>
		</div>
	</div>
	<br/>
	<h1 class="title">Location Analysis</h1>
	<div class="row-fluid">
		<div class="span6 stat">
			<div class="text-center statTitle"><i class="icon fa fa-arrow-circle-up"></i> Most Projects</div>
			<div class="text-center statResult" id="loc1"><?php echo $location[0]['location']; ?></div>
			<div class="text-center sub"><?php echo $location[0]['count']; ?> PROJECT(S)</div>
		</div>
		<div class="span6 stat">
			<div class="text-center statTitle"><i class="icon fa fa-arrow-circle-down"></i> Least Projects</div>
			<div class="text-center statResult" id="loc2"><?php echo $location[count($location)-1]['location']; ?></div>
			<div class="text-center sub"><?php echo $location[count($location)-1]['count']; ?> PROJECT(S)</div>
		</div>
	</div>
	<br/>
	<h1 class="title">Bidder Analysis</h1>
	<div class="row-fluid">
		<div class="span6 stat">
			<div class="text-center statTitle"><i class="icon fa fa-arrow-circle-up"></i> Most Bids</div>
			<div class="text-center statResult2" id="bid1"><?php echo $bid[0]['bidder_name']; ?></div>
			<div class="text-center sub"><?php echo $bid[0]['count']; ?> BID(S)</div>
		</div>
		<div class="span6 stat">
			<div class="text-center statTitle"><i class="icon fa fa-arrow-circle-down"></i> Least Bids</div>
			<div class="text-center statResult2" id="bid2"><?php echo $bid[count($bid)-1]['bidder_name']; ?></div>
			<div class="text-center sub"><?php echo $bid[count($bid)-1]['count']; ?> BID(S)</div>
		</div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script>
$(document).ready(function(){
	//get location
	navigator.geolocation.getCurrentPosition(function(position) {
		var pos = new google.maps.LatLng(position.coords.latitude,
		                             position.coords.longitude);
		$lat = position.coords.latitude;
		$lng = position.coords.longitude;
		$.ajax({
			url:"https://maps.googleapis.com/maps/api/geocode/json?latlng="+$lat+","+$lng,
			type:'GET',
			success:function(result){
				$('#location').val(result['results']['2']['address_components']['0']['long_name']);
				$('.loc').append(result['results']['2']['address_components']['0']['long_name']);
				//get current location
				$location = result['results']['2']['address_components']['0']['long_name'];
				//API call url
				$url = "<?php echo Yii::app()->createAbsoluteUrl('api/callData'); ?>";
				//queries
				$queryNearby =  'Select ref_id, tender_title, description, publish_date, closing_date, location from "baccd784-45a2-4c0c-82a6-61694cd68c9d" b LEFT JOIN "116b0812-23b4-4a92-afcc-1030a0433108" l ON b.ref_id = l.refid WHERE l.location=\''+$location+'\' order by b.publish_date desc limit 5 offset 0';
				$queryRated =  'Select ref_id, tender_title, description, publish_date, closing_date, approved_budget from "baccd784-45a2-4c0c-82a6-61694cd68c9d" b order by b.approved_budget desc limit 5 offset 0';
				$queryRecent =  'Select ref_id, tender_title, description, publish_date, closing_date, location from "baccd784-45a2-4c0c-82a6-61694cd68c9d" b LEFT JOIN "116b0812-23b4-4a92-afcc-1030a0433108" l ON b.ref_id = l.refid order by b.publish_date desc limit 5 offset 0';

				//ajax call for nearby projects
				$.ajax({
					url:$url+"?query="+$queryNearby,
					type:'json',
					success:function(result){
						$resultData = jQuery.parseJSON(result);
						if($resultData.length > 0){
							for($counter = 0; $counter < $resultData.length; $counter++){
								console.log($resultData[$counter]);
								$title = ($resultData[$counter]['tender_title'])?$resultData[$counter]['tender_title']:"No Title";
								$('.nearby').append('<div class="dummy-media-object"><a href="<?php echo Yii::app()->createAbsoluteUrl("project")?>/'+$resultData[$counter]['ref_id']+'"><h2 class="title">'+$title+'</h2></a>'
														   +'<div class="infoNear"><br/><small><b>Date Published: </b>'+$resultData[$counter]['publish_date']
									                       +'</small><br/><small><b>Closing Date: </b>'+$resultData[$counter]['closing_date']
									                       +'</small></div></div>');
							}
						}else{
							$('.nearby').append('<a class="dummy-media-object"><h1>No Projects to Show</h1></a>');
						}
					},
					error:function(err){
						console.log('error:'+err);
					}
				});
				
				//ajax call for top rated projects
				$.ajax({
					url:$url+"?query="+$queryRated,
					type:'json',
					success:function(result){
						$resultData = jQuery.parseJSON(result);
						if($resultData.length > 0){
							for($counter = 0; $counter < $resultData.length; $counter++){
								console.log($resultData[$counter]);
								$title = ($resultData[$counter]['tender_title'])?$resultData[$counter]['tender_title']:"No Title";
								$budget = $resultData[$counter]['approved_budget'];
								$('.rated').append('<div class="dummy-media-object"><a href="<?php echo Yii::app()->createAbsoluteUrl("project")?>/'+$resultData[$counter]['ref_id']+'"><h2 class="title">'+$title+'</h2></a>'
														   +'<div class="infoRated"><br/><small><b>Approved Budget: </b> Php'+$budget
									                       +'<br/><small><b>Date Published: </b>'+$resultData[$counter]['publish_date']
									                       +'</small><br/><small><b>Closing Date: </b>'+$resultData[$counter]['closing_date']
									                       +'</small></div></div>');
							}
						}else{
							$('.rated').append('<a class="dummy-media-object"><h1>No Projects to Show</h1></a>');
						}
					},
					error:function(err){
						console.log('error:'+err);
					}
				});

				//ajax call for top recent projects
				$.ajax({
					url:$url+"?query="+$queryRecent,
					type:'json',
					success:function(result){
						$resultData = jQuery.parseJSON(result);
						if($resultData.length > 0){
							for($counter = 0; $counter < $resultData.length; $counter++){
								console.log($resultData[$counter]);
								$title = ($resultData[$counter]['tender_title'])?$resultData[$counter]['tender_title']:"No Title";
								$('.recent').append('<div class="dummy-media-object"><a href="<?php echo Yii::app()->createAbsoluteUrl("project")?>/'+$resultData[$counter]['ref_id']+'"><h2 class="title">'+$title+'</h2></a>'
														   +'<div class="infoRecent"><br/><small><b>Date Published: </b>'+$resultData[$counter]['publish_date']
									                       +'</small><br/><small><b>Closing Date: </b>'+$resultData[$counter]['closing_date']
									                       +'</small></div></div>');
							}
						}else{
							$('.recent').append('<a class="dummy-media-object"><h1>No Projects to Show</h1></a>');
						}
					},
					error:function(err){
						console.log('error:'+err);
					}
				});
				
			}
		});
		
	}, function() {
	    alert('Map not loaded.');
	});

	var morphSearch = document.getElementById( 'morphsearch' ),
		input = morphSearch.querySelector( 'input.morphsearch-input' ),
		ctrlClose = morphSearch.querySelector( 'span.morphsearch-close' ),
		isOpen = isAnimating = false,
		// show/hide search area
		toggleSearch = function(evt) {
			// return if open and the input gets focused
			if( evt.type.toLowerCase() === 'focus' && isOpen ) return false;

			var offsets = morphsearch.getBoundingClientRect();
			if( isOpen ) {
				classie.remove( morphSearch, 'open' );
				$('.morphsearch-input').removeClass('active');
				// trick to hide input text once the search overlay closes 
				// todo: hardcoded times, should be done after transition ends
				if( input.value !== '' ) {
					setTimeout(function() {
						classie.add( morphSearch, 'hideInput' );
						setTimeout(function() {
							classie.remove( morphSearch, 'hideInput' );
							input.value = '';
						}, 300 );
					}, 500);
				}
				
				input.blur();
			}
			else {
				classie.add( morphSearch, 'open' );
				$('.morphsearch-input').addClass('active');
			}
			isOpen = !isOpen;
		};

	// events
	input.addEventListener( 'focus', toggleSearch );
	ctrlClose.addEventListener( 'click', toggleSearch );
	// esc key closes search overlay
	// keyboard navigation events
	document.addEventListener( 'keydown', function( ev ) {
		var keyCode = ev.keyCode || ev.which;
		if( keyCode === 27 && isOpen ) {
			toggleSearch(ev);
		}
	} );
});
</script>
<style>
.morphsearch {
	width: 200px;
	min-height: 40px;
	background: #FFFFFF;
	position: absolute;
	z-index: 10000;
	top: 13px;
	right: 50px;
	-webkit-transform-origin: 100% 0;
	transform-origin: 100% 0;
	-webkit-transition-property: min-height, width, top, right;
	transition-property: min-height, width, top, right;
	-webkit-transition-duration: 0.5s;
	transition-duration: 0.5s;
	-webkit-transition-timing-function: cubic-bezier(0.7,0,0.3,1);
	transition-timing-function: cubic-bezier(0.7,0,0.3,1);
}

.morphsearch.open {
	width: 100%;
	min-height: 100%;
	top: 0px;
	right: 0px;
}

.morphsearch-form {
	width: 100%;
	height: 40px;
	margin: 0 auto;
	position: relative;
	-webkit-transition-property: width, height, -webkit-transform;
	transition-property: width, height, transform;
	-webkit-transition-duration: 0.5s;
	transition-duration: 0.5s;
	-webkit-transition-timing-function: cubic-bezier(0.7,0,0.3,1);
	transition-timing-function: cubic-bezier(0.7,0,0.3,1);
}

.morphsearch.open .morphsearch-form {
	width: 80%;
	height: 160px;
	-webkit-transform: translate3d(0,3em,0);
	transform: translate3d(0,3em,0);
}

.morphsearch-input {
	width: 100%;
	height: 60px !important;
	padding: 0 10% 0 10px;
	font-weight: 700;
	border: transparent;
	background: transparent;
	font-size: 20px !important;
	color: #ec5a62;
	-webkit-transition: font-size 0.5s cubic-bezier(0.7,0,0.3,1);
	transition: font-size 0.5s cubic-bezier(0.7,0,0.3,1);
}

.morphsearch-input::-ms-clear { /* remove cross in IE */
    display: none;
}

.morphsearch.hideInput .morphsearch-input {
	color: transparent;
	-webkit-transition: color 0.3s;
	transition: color 0.3s;
}

/* placeholder */
.morphsearch-input::-webkit-input-placeholder {
	color: #c2c2c2;
}

.morphsearch-input:-moz-placeholder {
	color: #c2c2c2;
}

.morphsearch-input::-moz-placeholder {
	color: #c2c2c2;
}

.morphsearch-input:-ms-input-placeholder {
	color: #c2c2c2;
}

/* hide placeholder when active in Chrome */
.gn-search:focus::-webkit-input-placeholder {
	color: transparent;
}

input[type="text"] { /* reset normalize */
	-webkit-box-sizing: border-box; 
	box-sizing: border-box;	
}

.morphsearch-input:focus,
.morphsearch-submit:focus {
	outline: none;
}

.morphsearch-submit {
	position: absolute;
	width: 80px;
	height: 80px;
	text-indent: 0px;
	font-size:30px;
	color:#FFFFFF;
	overflow: hidden;
	right: 0;
	top: 30%;
	background-size: 100%;
	border: none;
	pointer-events: none;
	transform-origin: 50% 50%;
	-webkit-transform: translate3d(-30px,-50%,0) scale3d(0,0,1);
	transform: translate3d(-30px,-50%,0) scale3d(0,0,1);
}

.morphsearch.open .morphsearch-submit {
	pointer-events: auto;
	opacity: 1;
	-webkit-transform: translate3d(-30px,-50%,0) scale3d(1,1,1);
	transform: translate3d(-30px,-50%,0) scale3d(1,1,1);
	-webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
	transition: opacity 0.3s, transform 0.3s;
	-webkit-transition-delay: 0.5s;
	transition-delay: 0.5s;
}

.morphsearch-close {
	width: 36px;
	height: 36px;
	position: absolute;
	right: 1em;
	top: 1em;
	overflow: hidden;
	text-indent: 100%;
	cursor: pointer;
	pointer-events: none;
	opacity: 0;
	-webkit-transform: scale3d(0,0,1);
	transform: scale3d(0,0,1);
}

.morphsearch.open .morphsearch-close {
	opacity: 1;
	pointer-events: auto;
	-webkit-transform: scale3d(1,1,1);
	transform: scale3d(1,1,1);
	-webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
	transition: opacity 0.3s, transform 0.3s;
	-webkit-transition-delay: 0.5s;
	transition-delay: 0.5s;
}

.morphsearch-close::before,
.morphsearch-close::after {
	content: '';
	position: absolute;
	width: 2px;
	height: 100%;
	top: 0;
	left: 50%;
	border-radius: 3px;
	opacity: 0.2;
	background: #000;
}

.morphsearch-close:hover.morphsearch-close::before,
.morphsearch-close:hover.morphsearch-close::after {
	opacity: 1;
}

.morphsearch-close::before {
	-webkit-transform: rotate(45deg);
	transform: rotate(45deg);
}

.morphsearch-close::after {
	-webkit-transform: rotate(-45deg);
	transform: rotate(-45deg);
}

.morphsearch-content {
	color: #333;
	margin-top: 4.5em;
	width: 100%;
	height: 0;
	overflow: hidden;
	padding: 0 10.5%;
	background: #FFFFFF;
	position: absolute;
	pointer-events: none;
	opacity: 0;
}

.morphsearch.open .morphsearch-content {
	opacity: 1;
	height: auto;
	overflow: visible; /* this breaks the transition of the children in FF: https://bugzilla.mozilla.org/show_bug.cgi?id=625289 */
	pointer-events: auto;
	-webkit-transition: opacity 0.3s 0.5s;
	transition: opacity 0.3s 0.5s;
}

.dummy-column {
	width: 30%;
	padding: 0 0 6em;
	float: left;
	opacity: 0;
	-webkit-transform: translate3d(0,100px,0);
	transform: translateY(100px);
	-webkit-transition: -webkit-transform 0.5s, opacity 0.5s;
	transition: transform 0.5s, opacity 0.5s;
}

.morphsearch.open .dummy-column:first-child {
	-webkit-transition-delay: 0.4s;
	transition-delay: 0.4s;
}

.morphsearch.open .dummy-column:nth-child(2) {
	-webkit-transition-delay: 0.45s;
	transition-delay: 0.45s;
}

.morphsearch.open .dummy-column:nth-child(3) {
	-webkit-transition-delay: 0.5s;
	transition-delay: 0.5s;
}

.morphsearch.open .dummy-column {
	opacity: 1;
	-webkit-transform: translate3d(0,0,0);
	transform: translate3d(0,0,0);
}

.dummy-column:nth-child(2) {
	margin: 0 5%;
}

.dummy-column h1 {
	font-family: 'Lato2';
	font-size: 1.5em;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-weight: 300;
	color: #333;
	padding: 0.5em 0;
}

.dummy-column h2 {
	font-size: 1.1em;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-weight: 400;
	color: #333;
	padding: 0.5em 0;
}

.round {
	border-radius: 50%;
}

.dummy-media-object {
	display: block;
	margin: 0.3em 0;
	cursor: pointer;
	border-radius: 5px;
	background: rgba(118,117,128,0.05);
}

.dummy-media-object:hover,
.dummy-media-object:focus {
	background: rgba(118,117,128,0.1);
}

.dummy-media-object img {
	display: inline-block;
	width: 50px;	
	margin: 0 10px 0 0;
	vertical-align: middle;
}

.dummy-media-object h3 {
	vertical-align: middle;
	font-size: 0.85em;
	display: inline-block;
	font-weight: 700;
	margin: 0 0 0 0;
	width: calc(100% - 70px);
	color: rgba(145,145,145,0.7);
}

.dummy-media-object:hover h3 {
	color: rgba(236,90,98,1);
}

.dummy-media-object h2 {
	padding:0.75em;
}

/* Overlay */
.overlay {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(0,0,0,0.5);
	opacity: 0;
	pointer-events: none;
	-webkit-transition: opacity 0.5s;
	transition: opacity 0.5s;
	-webkit-transition-timing-function: cubic-bezier(0.7,0,0.3,1);
	transition-timing-function: cubic-bezier(0.7,0,0.3,1);
}

.morphsearch.open ~ .overlay {
	opacity: 1;
}

@media screen and (max-width: 53.125em) {
	.morphsearch-input {
		padding: 0 25% 0 10px;
	}
	.morphsearch.open .morphsearch-input {
		font-size: 2em;
	}
	.dummy-column {
		float: none;
		width: auto;
		padding: 0 0 2em;
	}
	.dummy-column:nth-child(2) {
		margin: 0;
	}
	.morphsearch.open .morphsearch-submit {
		-webkit-transform: translate3d(0,-50%,0) scale3d(0.5,0.5,1);
		transform: translate3d(0,-50%,0) scale3d(0.5,0.5,1);
	}
}

@media screen and (max-width: 60.625em) {
	.morphsearch {
		width: 80%;
		top: 10%;
		right: 10%;
	}
}

@font-face {
	font-weight: normal;
	font-style: normal;
	font-family: 'codropsicons';
	src:url('../fonts/codropsicons/codropsicons.eot');
	src:url('../fonts/codropsicons/codropsicons.eot?#iefix') format('embedded-opentype'),
		url('../fonts/codropsicons/codropsicons.woff') format('woff'),
		url('../fonts/codropsicons/codropsicons.ttf') format('truetype'),
		url('../fonts/codropsicons/codropsicons.svg#codropsicons') format('svg');
}

*, *:after, *:before { -webkit-box-sizing: border-box; box-sizing: border-box; }
.clearfix:before, .clearfix:after { content: ''; display: table; }
.clearfix:after { clear: both; }
.morphsearch-form > .active{
	background:transparent;
	border:none;
	height:90px !important;
	line-height:60px;
	font-size:60px !important;
}

input:focus{
	outline: none !important;
	box-shadow:none !important;
}
#searchText{ color:#333; }
.infoNear{
	background-color:#E74C3C;
	text-align:right;
	color:#FFFFFF;
	border-bottom-right-radius: 5px;
	border-bottom-left-radius: 5px;
	padding-left:0.75em;
	padding-right:0.75em;
	padding-bottom:0.75em;
}

.infoRated{
	background-color:#333;
	text-align:right;
	color:#FFFFFF;
	border-bottom-right-radius: 5px;
	border-bottom-left-radius: 5px;
	padding-left:0.75em;
	padding-right:0.75em;
	padding-bottom:0.75em;
}

.infoRecent{
	background-color:#D8B559;
	text-align:right;
	color:#FFFFFF;
	border-bottom-right-radius: 5px;
	border-bottom-left-radius: 5px;
	padding-left:0.75em;
	padding-right:0.75em;
	padding-bottom:0.75em;
}
.stat{
	background-color:#FFFFFF;
	padding:10px;
}
.statTitle{
	padding-top:10px;
	font-weight:bold;
	font-size:30px;
}
.statResult{
	padding-bottom:20px;
	margin-top:30px;
	font-weight:bold;
	font-size:60px;
}
.statResult2{
	padding-bottom:20px;
	margin-top:30px;
	font-weight:bold;
	font-size:20px;
}
.sub{ font-weight:bold; }
.icon{ color:#333; }
#banner{ background-color:#333 !important; }
#buyer{ color:#EB3F3C; }
#seller{ color: #416CB2; }
#cso{ color:#008500; }
#loc1{ color:#FF7100; }
#loc2{ color:#028E9B; }
#bid1{ color:#530FAD; }
#bid2{ color:#9FEE00; }

.brand{
	color:#FFFFFF;
	font-size:40px;
}

.loginLink{
	width:250px;
	text-align:center;
	padding:10px;
	background-color:#333333;
	float:right;
	font-size:15px;
	font-weight:bold;
	margin-right:20px;
	border-bottom-left-radius:10px;
	border-bottom-right-radius:10px;
	border-top:2px solid #57595B;
}

.loginLink > a{
	color:#FFFFFF;
}

</style>