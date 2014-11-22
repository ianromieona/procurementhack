<div class="header">
		<div class="container">
		<!--logo-->
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<i class="fa fa-bars"></i></button>
					<div class="logo">
						 <!-- <a href="index.html"><img src="img/logo.png" alt="" class="animated bounceInDown"></a>   -->
					</div>
					<!--menu-->
					   <nav id="main_menu">
					<div class="nav-collapse collapse">
						<ul class="nav nav-pills">
							<li class="<?php echo (Yii::app()->user->isGuest) ? "hidden" : ""; ?>"><a href="<?php echo (Yii::app()->user->isGuest) ? $this->createUrl('site/login'):$this->createUrl('site/logout');?>"><?php echo (Yii::app()->user->isGuest)? "Login": "Logout";?></a></li>
							<li  class="active"><a href="<?php echo (Yii::app()->user->isGuest) ? $this->createUrl('site/login'):"#";?>"><?php echo (Yii::app()->user->isGuest)? "Register / Login": Yii::app()->user->name;?></a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div>