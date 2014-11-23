<div id="morphsearch" class="morphsearch open">
	<form class="morphsearch-form" method="POST" action="<?php echo Yii::app()->createAbsoluteUrl('project/search'); ?>">
		<input class="morphsearch-input active" name="keyword" id="searchText" autocomplete="off" type="text" value="<?php echo $key; ?>" placeholder="Search...">
		<input type="hidden" name="location" id="location" value="Makati">
		<button class="morphsearch-submit" type="submit" value="search"><i class="fa fa-search"></i></button>
	</form>
	<div id="banner">
		<b>SEARCH RESULTS</b>
	</div>
	<?php if(Yii::app()->user->isGuest){ ?>
	<div class="loginLink"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/login'); ?>">LOGIN</a></div>
	<?php }else{ ?>
	<div class="loginLink"><a href="<?php echo Yii::app()->createAbsoluteUrl('user/index'); ?>">MY PROFILE</a></div>
	<div class="loginLink"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout'); ?>">LOGOUT</a></div>
	<?php } ?>
	<div class="morphsearch-content">
		<?php if(sizeOf($data) > 0){ ?>
			<div class="row-fluid">
			<?php if(($offset-1) != -1){ ?>
			<a class="pagination" href="<?php echo Yii::app()->createAbsoluteUrl('project/search',array('keyword'=>$key,'offset'=>($offset-1))); ?>"><div class="span1">Previous</div></a>
			<?php } ?>
			<?php if(($offset*10) <= $count){ ?>
			<a class="pagination" href="<?php echo Yii::app()->createAbsoluteUrl('project/search',array('keyword'=>$key,'offset'=>($offset+1))); ?>"><div class="span1">Next</div></a>
			<?php } ?>
			</div>
			<br/>
			<?php for($counter = 0; $counter < sizeOf($data); $counter++){ ?>
				<?php if(($counter%2) == 0){ ?>
					<div class="row-fluid">
				<?php } ?>
					<div class="span6">
						<div class="dummy-media-object">
							<a style="color:#333;" href="<?php echo Yii::app()->createAbsoluteUrl('/project/view',array('id'=>$data[$counter]['ref_id'])); ?>">
								<h2 class="title"><?php echo $data[$counter]['tender_title']; ?></h2>
							</a>
							<p class="lead">
								<?php echo $data[$counter]['description']; ?>
							</p>
							<div class="infoRated">
								<?php if(isset($data[$counter]['approved_budget'])){ ?>
								<br>
								<small>
									<b>Approved Budget: </b> Php<?php echo $data[$counter]['approved_budget']; ?>
								</small>
								<?php } ?>
								<br>
								<small>
									<b>Date Published: </b><?php echo $data[$counter]['publish_date']; ?>
									|
									<b>Closing Date: </b><?php echo $data[$counter]['closing_date']; ?>
								</small>
							</div>
						</div>
					</div>
				<?php if(($counter%2) != 0){ ?>
					</div>
				<?php } ?>
			<?php } ?>
			<div class="row-fluid">
			<?php if(($offset-1) != -1){ ?>
			<a class="pagination" href="<?php echo Yii::app()->createAbsoluteUrl('project/search',array('keyword'=>$key,'offset'=>($offset-1))); ?>"><div class="span1">Previous</div></a>
			<?php } ?>
			<?php if(($offset*10) <= $count){ ?>
			<a class="pagination" href="<?php echo Yii::app()->createAbsoluteUrl('project/search',array('keyword'=>$key,'offset'=>($offset+1))); ?>"><div class="span1">Next</div></a>
			<?php } ?>
			</div>
		<?php }else{ ?>
			<a class="dummy-media-object"><h1>No Projects to Show</h1></a>
		<?php } ?>

	</div>
</div>

<style>
.morphsearch {
	width: 200px;
	min-height: 40px;
	background: #FFFFFF;
	position: absolute;
	z-index: 10000;
	top: 30px;
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

.morphsearch.open {
	opacity: 1;
	pointer-events: auto;
	-webkit-transform: scale3d(1,1,1);
	transform: scale3d(1,1,1);
	-webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
	transition: opacity 0.3s, transform 0.3s;
	-webkit-transition-delay: 0.5s;
	transition-delay: 0.5s;
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
	font-family: 'Lato2' !important;
	font-size: 1.5em;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-weight: 300;
	color: #333;
	padding: 0.5em 0;
}

.dummy-column h2 {
	font-size: 1.1em !important;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-weight: 400;
	color: #333 !important;
	padding: 0.5em 0;
}

.round {
	border-radius: 50%;
}

.dummy-media-object {
	display: block;
	margin: 0.3em 0;
	cursor: pointer;
	background: rgba(118,117,128,0.05);
}}

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

#searchText{
	color:#333;
}

.infoRated{
	background-color:#555;
	text-align:right;
	color:#FFFFFF;
	padding-left:0.75em;
	padding-right:0.75em;
	padding-bottom:0.75em;
}

.span6{
	font-size: 1.1em !important;
	letter-spacing: 1px !important;
	text-transform: uppercase !important;
	font-weight: 400 !important;
	color: #333 !important;
	padding: 0.5em 0 !important;
}
h2{
	font-size: 1.1em !important;
	letter-spacing: 1px;
	text-transform: uppercase;
	font-weight: 400;
	width: 90%;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}
.lead{
	padding-left:30px;
	font-size:10px;
	width: 90%;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}
.pagination{
	color:#FFFFFF;
}
.pagination:hover{
	color:#FFFFFF;
}
.pagination > div{
	width:100px;
	text-align:center;
	text-transform: uppercase;
	font-weight:400;
	padding:5px;
	background-color:#333;
	border:1px solid #000000;
}
#banner{ 
	padding:20px;
	padding-left:200px;
	background-color:#333 !important;
	color:#FFFFFF;
	font-size:30px;
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
