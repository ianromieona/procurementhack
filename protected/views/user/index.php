<div class="container">
	<div class="row-fluid">
		<div class="span4">
			<div class="well userinfo">
				<h1><?php echo $user->user_firstname; ?><i class="fa fa-edit pull-right editProfile" tool-tip="Edit"></i></h1>
				<span class='muted'><i class="fa fa-envelope"></i> <?php echo $user->email; ?></span><br>
				<span class='muted'><i class="fa fa-user"></i> <?php echo $user->mobile; ?></span><br>
				<span class='muted'><i class="fa fa-briefcase"></i> <?php echo $user->address; ?></span><br>
				<h6><b>Filters:</b> </h6>
				<b>Approved Budget Range:</b> <span class='text-error'>₱ <?php echo ($filters->approved_budget)?$filters->approved_budget:"None"; ?></span><br>
				<b>Tags:</b> <span class='text-error'><?php echo ($filters->tags)?$filters->tags:"None"; ?></span><br>
				<b>Classification:</b> <span class='text-error'><?php echo ($filters->classification)?$filters->classification:"None"; ?></span><br>
				<b>Categories:</b> <span class='text-error'><?php if($cat){ foreach($cat as $key => $data){ echo $data['category_name'].', '; } } else { echo "None"; } ?></span><br>
			</div>
			<div class="well useredit" style="display:none">
				<form method="POST">
					
					<br>
					<h2><input type="text" name="User[name]" class="span12" placeholder="Fullname" value="<?php echo $user->user_firstname; ?>"><h2>
					<input type="text" name="User[email]" class="span12" placeholder="Email" value="<?php echo $user->email; ?>"><br>
					<input type="text" name="User[mobile]" class="span12" placeholder="Mobile" value="<?php echo $user->mobile; ?>"><br>
					<input type="text" name="User[address]" class="span12" placeholder="Company" value="<?php echo $user->address; ?>"><br>
					<input type="password" name="User[password]" class="span12" placeholder="Password"><br>
					<input type="text" name="budget" class="span12" placeholder="Budget Range" value="<?php echo $filters->approved_budget; ?>"><br>
					<input type="text" name="tags" placeholder="Tags" class="tm-input span3"/><br>
					<input type="text" name="classification" class="span12" placeholder="Classification" value="<?php echo $filters->classification; ?>"><br>
					<input type="text" name="cat" placeholder="Categories" class="cat-input span4"/><br>
					<input type="submit" name="submit" value="Update" class="btn btn-danger pull-right"><span class="btn btn-danger pull-right canceleditProfile">Cancel</span>
				</form>
			</div>
		</div>

		<div class="span8">
			<div class="well">
					
				<?php if($get){ ?>
					<?php foreach ($get as $key => $value) { ?>
					<div class="row-fluid">
						<div class="span12">
							<label class="labels"><a href="<?php echo $this->createUrl('project/view',array('id'=>$value['ref_id']));?>"><?php echo $value['tender_title'];?></a></label>
							<?php if($value['description']){?>
							<p><?php echo substr($value['description'], strlen($value['description']),300);?></p>
							<?php }else{echo "No Description";} ?>
							<span class="text-info">Publish Date <?php echo $value['publish_date'];?></span>
						</div>	
					</div> 
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<style>
.muted{
	color: #555 !important;
	font-size: 12px !important;
}
.editProfile:hover{
	color: #E74C3C !important;
	cursor: pointer;
}
.well{
	background: #fff !important;
}
</style>
<?php
$tag = explode('|',$filters['tags']);
$tags = "";
$tags2 = "";
foreach($tag as $val){
	$tags = $tags.'"'.$val.'", ';
}
foreach($cat as $key=>$val){
	$tags2 = $tags2.'"'.$val['category_name'].'", ';
}
?>
<script>
	$(document).ready(function(){
		var result2= "";

		$(".editProfile").click(function(){
			$(".userinfo").hide();
			$('.useredit').fadeIn('slow');
		})

		$(".canceleditProfile").click(function(){
			$(".useredit").hide();
			$('.userinfo').fadeIn('slow');
		})

		$(".tm-input").tagsManager({
	      	prefilled: [<?php echo trim($tags, ","); ?>],
	    });
	   
	    jQuery(".cat-input").tagsManager({
	      prefilled: [<?php echo trim($tags2, ","); ?>]
	    });
	 
	    // jQuery(".cat-input").typeahead({
	    //   name: 'countries',
	    //   limit: 15,
	    //   prefetch: ''
	    // 	}).on('typeahead:selected', function (e, d) {
	 
	    //   tagApi.tagsManager("pushTag", d.value);
	 
	    // });
		// $(".cat-input").live('keyup',function(){ 
		// 	$.ajax({
		// 		url:"<?php echo $this->createUrl('/user/getCategory'); ?>",
		// 		type:'GET',
		// 		success:function(result){
		// 			console.log(result);
		// 			result2=result;
		// 		}
		// 	})
		// })
		data = new Array();
	    jQuery(".cat-input").typeahead({
	        source: function(){
		        $.ajax({
					url:"<?php echo $this->createUrl('/user/getCategory'); ?>",
					type:'GET',
					success:function(result){
						data = new Array();
						obj = $.parseJSON(result)
						for (var i = 0; i < obj.length; i++) {
							data.push(obj[i]['business_category']);
						}
					}
				})	
				return data;
	        },
	        displayField: 'business_category',
		})
	})
</script>