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
		}
		$(obj).addClass( "active" );
	}

	function payment_pay_cash(){
		var status = "already_paid";
		var BookID = $("#cs_book_id").val();
		chang_status('already_paid', BookID);
	}
</script>