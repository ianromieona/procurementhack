<div class="container">
<br>
<br>
	<div class="row-fluid">
		<div class="span6">
			<center>
				<img src="<?php echo Yii::app()->request->baseUrl;?>/images/ph-map.png">
			</center>
		</div>
		<div class="span6">
			<div class="loginpanel">
				<?php
				$this->pageTitle=Yii::app()->name . ' - Login';
				?>

				<h1 class="logintitle">Login</h1>

				<p>Please fill out the following form with your login credentials:</p>

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
							<?php echo $form->labelEx($model,'username'); ?>
							<?php echo $form->textField($model,'username',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($model,'username'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($model,'password'); ?>
							<?php echo $form->passwordField($model,'password',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($model,'password'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo CHtml::submitButton('LOGIN',array('class'=>'pull-right btn btn-info')); ?>
							<?php echo CHtml::link('REGISTER','#',array('class'=>'registerBtn')); ?>
						</div>
					</div>

				<?php $this->endWidget(); ?>
				</div><!-- form -->
			</div><!-- form -->
			<div class="hide registerpanel">
				<h1 class="logintitle">Register</h1>

				<p>Please fill out the following form with your register credentials:</p>

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
							<?php echo $form->labelEx($modelr,'username'); ?>
							<?php echo $form->textField($modelr,'username',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($modelr,'username'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($modelr,'password'); ?>
							<?php echo $form->passwordField($modelr,'password',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($modelr,'password'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($modelr,'email'); ?>
							<?php echo $form->textField($modelr,'email',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($modelr,'email'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($modelr,'user_firstname'); ?>
							<?php echo $form->textField($modelr,'user_firstname',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($modelr,'user_firstname'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo $form->labelEx($modelr,'user_lastname'); ?>
							<?php echo $form->textField($modelr,'user_lastname',array('class'=>'input-block-level')); ?>
							<?php echo $form->error($modelr,'user_lastname'); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<?php echo CHtml::submitButton('REGISTER',array('class'=>'pull-right btn btn-info')); ?>
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
