<?php 
	$path_assets = base_url()."assets/"; 
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];
?>
<style type="text/css">
.btn-pay-cash {
  background-color: #1E88E5;
  border: 1px solid #42a5f5;
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  width: 200px; /* Set a width if needed */
  height: 50px;
  display: block; /* Make the buttons appear below each other */
  margin:0 auto;
  padding-top: 15px;
}

.btn-pay-cash:not(:last-child) {
  border-bottom: none; /* Prevent double borders */
}

/* Add a background color on hover */
.btn-pay-cash:hover {
  background-color: #42a5f5;
}
#box-pay-cash{
	height: 100px;
	padding-top: 20px;
}
</style>
<div class="content">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<ul class="nav nav-pills">
			   <li role="presentation" onclick="change_box('pay_cash', this)" class="active"><a href="#"><?php echo $this->lang->line('pay_cash'); ?></a></a></li>
			   <li role="presentation" onclick="change_box('transfer', this)"><a href="#"><?php echo $this->lang->line('transfer_money'); ?></a></li>
			  <!-- <li role="presentation"><a href="#">Messages</a></li> -->
			</ul>
		</div>
	</div>
	<hr>
	<div class="row payment" id="box-transfer">

		<form id="form-data" name="form-data" method="post">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
					<?php echo $this->lang->line('bank_transfer'); ?> :
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
					<select id="slBookStatus" name="slBookStatus" class="form-control">
						<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
						<?php  
							foreach ($bank as $key => $value) {
								$name = ($_COOKIE[$keyword.'Lang'] == "th") ? $value->name_th : $value->name_th;
								echo '<option value="'.$value->id.'">'.$name.'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
					<?php echo $this->lang->line('amount'); ?> :
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
					<input type="text" name="amount" id="amount" value="<?php echo $amount; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
					<?php echo $this->lang->line('date'); ?> :
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
					<input type="text" name="date_transfer" id="date_transfer">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
					<?php echo $this->lang->line('time'); ?> :
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
					<select id="slTimeTransfer_H" name="slTimeTransfer_H" class="form-control" style="width: 50px;float: left;">
						<?php 
							for ($i=0; $i < 24; $i++) { 
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
					</select>
					<div style="float: left;margin: 7px;"> : </div>
					<select id="slTimeTransfer_S" name="slTimeTransfer_S" class="form-control" style="width: 50px;float: left;">
						<?php 
							for ($i=0; $i < 60; $i++) { 
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
				<div class="col-lg-6 col-md-6 col-sm-8 col-xs-10 text-right">
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
					<?php echo $this->lang->line('transfer_to_bank'); ?> :
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
					<select id="slTransferToBank" name="slTransferToBank" class="form-control">
						<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
						<?php  
							foreach ($bank_list as $key => $value) {
								$name = ($_COOKIE[$keyword.'Lang'] == "th") ? $value->name_th : $value->name_th;
								echo '<option value="'.$value->id.'">'.$name.' ('.$value->account_number.')</option>';
							}
						?>
					</select>
				</div>
			</div>
			
		</form>
	</div>

	<div class="row payment" id="box-pay-cash">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<div class="btn-pay-cash" onclick="payment_pay_cash()">
				<?php echo $this->lang->line('accept_cash'); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		change_box('pay_cash');
		$(".nav-pills li").eq(0).addClass('active');
    });
	function change_box( box, obj ) {
		$(".payment").hide();
		$(".nav-pills .active").removeClass("active");
		switch( box ){
			case "pay_cash" : $("#box-pay-cash").show(); break;
			case "transfer" : $("#date_transfer").val( moment().format('D-MM-YYYY') ); $("#box-transfer").show(); break;
		}
		$(obj).addClass( "active" );
	}

	function payment_pay_cash(){
		var status = "already_paid";
		var BookID = $("#cs_book_id").val();
		chang_status('already_paid', BookID);
	}
</script>