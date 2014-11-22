<div class="container">
<br>
<br>
	<div class="row-fluid">
		<div class="span6 hidden-phone">
			<center>
				<img src="<?php echo Yii::app()->request->baseUrl;?>/images/ph-map.png">
			</center>
		</div>
		<div class="span6">
			<div class="loginpanel">
				<?php
				$this->pageTitle=Yii::app()->name . ' - Login';
				?>
				<div class="row-fluid">
					<div class="span6">
						<h1 class="logintitle">Login</h1>

						<p>Please fill out the following form with your login credentials:</p>
					</div>
				</div>
				<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'enableAjaxValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>

					<p class="note">Fields with <span class="required">*</span> are required.</p>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($model,'username',array('class'=>'labels')); ?>
							<?php echo $form->textField($model,'username',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($model,'username'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($model,'password',array('class'=>'labels')); ?>
							<?php echo $form->passwordField($model,'password',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($model,'password'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo CHtml::submitButton('LOGIN',array('name'=>'loginBtn','class'=>'pull-right btn btn-warning')); ?>
							<?php echo CHtml::link('REGISTER','#',array('class'=>'registerBtn')); ?>
						</div>
					</div>

				<?php $this->endWidget(); ?>
				</div><!-- form -->
			</div><!-- form -->
			<div class="hide registerpanel">
				<div class="row-fluid">
					<div class="span6">
						<h1 class="logintitle">Register</h1>

						<p>Please fill out the following form with your register credentials:</p>
					</div>
				</div>
				<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'register-form',
					'enableAjaxValidation'=>true,
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>

					<p class="note">Fields with <span class="required">*</span> are required.</p>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($modelr,'username',array('class'=>'labels')); ?>
							<?php echo $form->textField($modelr,'username',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($modelr,'username'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($modelr,'password',array('class'=>'labels')); ?>
							<?php echo $form->passwordField($modelr,'password',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($modelr,'password'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($modelr,'email',array('class'=>'labels')); ?>
							<?php echo $form->textField($modelr,'email',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($modelr,'email'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($modelr,'user_firstname',array('class'=>'labels')); ?>
							<?php echo $form->textField($modelr,'user_firstname',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($modelr,'user_firstname'); ?>
						</div>
					</div>
					<!-- <div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($modelr,'user_lastname',array('class'=>'labels')); ?>
							<?php echo $form->textField($modelr,'user_lastname',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($modelr,'user_lastname'); ?>
						</div>
					</div> -->
					<div class="row-fluid">
						<div class="span6">
							<?php echo CHtml::submitButton('REGISTER',array('name'=>'registerBtn','class'=>'pull-right btn btn-info')); ?>
							<?php echo CHtml::link('LOGIN','#',array('class'=>'loginBtn')); ?>
						</div>
					</div>

				<?php $this->endWidget(); ?>
				</div><!-- form -->
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('.registerBtn').on('click',function(){
		$('.loginpanel').slideUp('slow');
		$('.registerpanel').slideDown('fast');
		$('img').fadeOut(function(){ $(this).attr('src','<?php echo Yii::app()->request->baseUrl;?>/images/ph-map2.png').fadeIn('fast'); });
	})
	$('.loginBtn').on('click',function(){
		$('.loginpanel').slideDown('slow');
		$('.registerpanel').slideUp('fast');
		$('img').fadeOut(function(){ $(this).attr('src','<?php echo Yii::app()->request->baseUrl;?>/images/ph-map.png').fadeIn('fast'); });


	})
})
</script>
