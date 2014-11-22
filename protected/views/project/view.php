<div id="banner">
	<div class="container intro_wrapper">
		<div class="inner_content">
			<h1>Bid Notice Abstract</h1>
			<h1 class="title">Request for Quotation (RFQ)</h1>
		</div>
	</div>
</div>
<div class="semicontainer">
	<div class="row-fluid">
		<div class="span6">
			<div class="row-fluid">
				<div class="span4">
					<label class="labels">Reference Number</label>
				</div>
				<div class="span8">
					<label class="labels2 text-info"><?php echo $refId;?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label class="labels">Procuring Entity</label>
				</div>
				<div class="span8">
					<label class="labels2 text-error"><?php echo $data['procuring_entity_org'];?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label class="labels">Title</label>
				</div>
				<div class="span8">
					<label class="labels2"><?php echo $data['tender_title'];?></label>
				</div>
			</div>
			<div class="row-fluid ">
				<div class="span4">
					<label class="labels">Area of Delivery</label>
				</div>
				<div class="span8">
					<label class="labels2"><?php echo $data['location'];?></label>
				</div>
			</div>	
		</div>
		<div class="span6" style="text-align: center;">
			<a href="" class="btn btn-danger btn-large " >BID</a>
		</div>
	</div>
	<hr>
	</div>
</div>
<div class="semicontainer">
	<div class="row-fluid">
		<div class="span6">
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Solicitation Number:</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['solicitation_no'];?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Trade Agreement:</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['trade_agreement'];?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Procurement Mode:</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['procurement_mode'];?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Classification:</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['classification'];?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Category:</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['business_category'];?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Approved Budget for the Contract:</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['approved_budget'];?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Client Agency:	</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['client_agency_org'];?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Contact Person:	</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['contact_person'];?></label>
				</div>
			</div>
		</div>
		<div class="span6 br1">
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Status</label>
				</div>
				<div class="span7">
					<label class="labels2 text-success"><b><?php echo $data['tender_status'];?></b></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Associated Components</label>
				</div>
				<div class="span7">
					<label class="labels2">Order</label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Date Published	</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['publish_date'];?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Last Updated / Time	</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['modified_date'];?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5">
					<label class="labels">Closing Date / Time</label>
				</div>
				<div class="span7">
					<label class="labels2"><?php echo $data['closing_date'];?></label>
				</div>
			</div>
		</div>
	</div>
		<hr>
	<div class="row-fluid">
		<div class="span12">
			<div class="span12">
				<h2><span>Description</span></h2>
				<h5>Publication of Master list of ARB's</h5>
				<p><?php echo $data['description'];?></p>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="span12">
				<h3><span>Line Items</span></h3>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<?php if($items){ ?>
			<table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Item No.</th>
                        <th>Product/Service Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>UOM</th>
                        <th>Budget (PHP)</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $value) { ?>
                      <tr>
                        <td><?php echo $value['_id'];?></td>
                        <td><?php echo $value['item_name'];?></td>
                        <td><?php echo $value['item_description'];?></td>
                        <td><?php echo $value['qty'];?></td>
                        <td><?php echo $value['uom'];?></td>
                        <td><?php echo $value['budget'];?></td>
                      </tr>
                   <?php }?>
                    
                    </tbody>
                  </table>
                  <?php }else{ echo "No Items.";} ?>
		</div>
	</div>
<!-- 	<div class="row-fluid">
		<div class="span2">
			<label class="labels">Created By</label>
		</div>
		<div class="span2">
			<label class="labels2">2943299</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span2">
			<label class="labels">Date Created</label>
		</div>
		<div class="span2">
			<label class="labels2">2943299</label>
		</div>
	</div> -->
</div>
