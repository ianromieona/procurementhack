<div class="container">
	<div class="row-fluid">
		<div class="span4">
			<div class="well">
				<h2><?php echo $user->user_firstname; ?><i class="fa fa-edit pull-right editProfile" tool-tip="Edit"></i></h2>
				<span class='muted'><i class="fa fa-envelope"></i> <?php echo $user->email; ?></span><br>
				<span class='muted'><i class="fa fa-user"></i> <?php echo $user->mobile; ?></span>
			</div>
		</div>

		<div class="span8">
			<div class="well">
				b
			</div>
		</div>
	</div>
</div>
<style>
.muted{
	color: #555 !important;
	font-size: 11px !important;
}
.editProfile:hover{
	color: #E74C3C !important;
	cursor: pointer;
}
</style>