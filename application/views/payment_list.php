<?php 
	$path_assets = base_url()."assets/"; 
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];
?>

<style type="text/css">
	.row{ margin-top: 5px; }
	#box-manage{
		transition: 0.5s;
		width: 0px;
		min-height: 500px;
		right: 0px;
		float: right;
	}
	#box-show-search{
		transition: 0.5s;
		width: 100%;
		left: 0px;
		float: left;
	}
	.fa-edit{ color: green; }
	.fa{ cursor: pointer; }
	.fa-remove{ color: red; }
	.form-check-input{ cursor: pointer; }
	.error-form{ 
		border: 1px solid red !important;
	}
	.title_page{border-bottom: 1px solid #D9D9D9}

	.chip {
  display: inline-block;
  padding: 0 25px;
  height: 50px;
  /*font-size: 16px;*/
  line-height: 50px;
  border-radius: 25px;
  background-color: #f1f1f1;
}

.chip img {
  float: left;
  margin: 0 10px 0 -25px;
  height: 50px;
  width: 50px;
  border-radius: 50%;
}

/* Style the buttons */
.chip {
  border: none;
  outline: none;
  /*padding: 10px 16px;*/
  background-color: #f1f1f1;
  cursor: pointer;
  /*font-size: 18px;*/
}

/* Style the active class, and buttons on mouse-over */
.xactive, .chip:hover {
  background-color: #666;
  color: white;
}
</style>
<div class="row title_page">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h3 class="lang_manage_employee_data" style="font-weight: bold;"><?php echo $title;?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
		<button type="button" class="btn btn-secondary" onclick="to_add_data( '0' )" id="btn-toadd_data" style="margin-top: 10px; width: 100px;"><?php echo $this->lang->line('add'); ?></button>
		<button type="button" class="btn btn-warning" onclick="to_manage_data()" id="btn-tomanage_data" style="margin-top: 10px; width: 100px; display: none;"><?php echo $this->lang->line('cancel'); ?></button>
	</div>
</div>
<br>
<div id="box-show-search">
	<div class="box-search">
		<div class="row">
			<?php //  debug($bank); ?>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span class="lang_employee_code"><?php echo $this->lang->line('payment_time'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtPaymentTime" class="form-control check_in" name="txtPaymentTime" placeholder="<?php echo $this->lang->line('select_datetime'); ?>">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<?php echo $this->lang->line('status'); ?>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slPaymentStatus" name="slPaymentStatus" class="form-control">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
					<?php  
						foreach ($status_payment as $key => $value) {
							echo '<option value="'.$value->id.'">'.$this->lang->line($value->name).'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span class="lang_name">ประเภทการชำระเงิน : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slPaymentType" name="slPaymentType" class="form-control">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
					<?php  
						foreach ($payment_type as $key => $value) {
								echo '<option value="'.$value->id.'">'.$this->lang->line( $value->name ).'</option>';
							}
						?>
				</select>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span class="lang_name"><?php echo $this->lang->line('transfer_to_bank'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slBankTransferTo" name="slBankTransferTo" class="form-control">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
					<?php  
						foreach ($bank_list as $key => $value) {
								$name = ($_COOKIE[$keyword.'Lang'] == "th") ? $value->name_th : $value->name_en;
								echo '<option value="'.$value->id.'">'.$name.'</option>';
							}
						?>
				</select>
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<button type="button" class="btn btn-primary lang_save" onclick="get_data_list()"><?php echo $this->lang->line('search'); ?></button>
				<button type="button" class="btn btn-warning lang_clear" onclick="clear_data()"><?php echo $this->lang->line('clear'); ?></button>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table class="table" id="tb-quo-list">
				<thead>
					<tr>
						<th class="text-center"><?php echo $this->lang->line('no'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('payment_time'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('book_data'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('price'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('discount'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('total'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('pay_amount'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('pay_type'); ?></th>
						<th class="text-center">remark</th>
						<th class="text-center"><?php echo $this->lang->line('status'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('action'); ?></th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
	<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
					<button type="button" class="btn btn-link btn-xs" id="bnt-Previous" onclick="previous(page - 1)" style="display: none;"><< Previous</button>
					<span id="div-page-number" class="div-page-number"></span>
					<button type="button" class="btn btn-link btn-xs" id="bnt-next" onclick="next_page(page + 1)" style="display: none;">Next >></button>
			</div>
		</div>
</div>

<!-- <div class="modal" tabindex="-1" role="dialog" id="md-manage">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-title"></h5>
      </div>
      <div class="modal-body" id="md-manage-detail">
         	
      </div>
      <div class="modal-footer"> -->
      	<!-- <button type="button" class="btn btn-success" id="btn-save-noapprove" onclick="save_noapprove()">บันทึก</button> -->
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
        <span style="display: none;">
        	<input type="text" name="cs_book_id" id="cs_book_id" value="0">
        </span>
     
      </div>
    </div>
  </div>
</div> -->

<!-- ###################################### Manage  ######################################-->

<div id="box-manage" style="display: none;">
	<form id="form-manage" name="form-manage" method="post" action="" enctype="multipart/form-data">		
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 text-right">
				<label class="" style="font-weight: bold;font-size: 16px;"><?php echo $this->lang->line('book_data'); ?>  (<?php echo $this->lang->line('s_wait_payment'); ?>)</label>
			</div>
		</div>
		<div class="row">
		    <div class="col-sm-2" style="text-align: right;">เลือกผู้จอง</div>
		    <div class="col-sm-10">
				<div class="row">
					<div class="bok_status_waitpayment" id="bok_status_waitpayment"></div>					
				</div>
		    </div>
		 </div>
		<hr>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<label class="" style="font-weight: bold;font-size: 16px;"><?php echo $this->lang->line('book_data'); ?></label>
			</div>
		</div>
		<div class="row" >
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>วันที่เข้าพัก : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="etxtPayment_check_in" class="form-control" name="etxtPayment_check_in" readonly>
            </div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>วันที่ออก : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="etxtPayment_check_out" class="form-control" name="etxtPayment_check_out" readonly>
            </div>
		</div>
		<div class="row" >
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ผู้จอง - ชื่อ : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="etxtPayment_name_book" class="form-control" name="etxtPayment_name_book" readonly>
            </div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ผู้จอง - นามสกุล : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="etxtPayment_lastname_book" class="form-control" name="etxtPayment_lastname_book" readonly>
            </div>
		</div>
		<div class="row" >
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ผู้เข้าพัก - ชื่อ : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="etxtPayment_name_guest" class="form-control" name="etxtPayment_name_guest" readonly>
            </div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ผู้เข้าพัก - นามสกุล : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="etxtPayment_lastname_guest" class="form-control" name="etxtPayment_lastname_guest" readonly>
            </div>
		</div>
		<div class="row" >
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>โค้ดส่วนลด : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="etxtPayment_promotion_code" class="form-control" name="etxtPayment_promotion_code" >
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<button type="button" class="btn btn-default btn-sm" onclick="search_promotion()">
		          	<span class="glyphicon glyphicon-search"></span> Search 
		        </button>
            </div>			
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>รายละเอียดห้องพัก : </span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-9 col-xs-5">
				<table class="table" id="tb-room-list">
					<thead>
						<tr>
							<th class="text-center"><?php echo $this->lang->line('no'); ?></th>
							<th class="text-center">เลขห้อง</th>
							<th class="text-center">ชื่อห้อง</th>
							<th class="text-center">ประเภทห้อง</th>
							<th class="text-center">ส่วนลด</th>
							<th class="text-center">ราคา</th>
							<th class="text-center">ราคารวม</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
				<div class="dash" id="dash"></div>
				<input type='text' id='osdPay' name='osdPay' style="display: none;">
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<label class="" style="font-weight: bold;font-size: 16px;">การจ่ายเงิน</label>
			</div>
		</div>
		<div class="row" >
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ประเภทการชำระเงิน : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="eslPaytype" name="eslPaytype" class="form-control" onchange="paytype(this.value)">>
					<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
					<option value="pay_cash"> <?php echo $this->lang->line('pay_cash'); ?> </option>
					<option value="transfer_money"> <?php echo $this->lang->line('transfer_money'); ?> </option>
					<option value="visa"> <?php echo $this->lang->line('visa'); ?> </option>
					<option value="wallet"> Yotaka wallet </option>
				</select>
            </div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>รวม/บาท : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="etxtPayment_totalx" class="form-control" name="etxtPayment_totalx" readonly style="display: block;">
				<input type="text" id="etxtPayment_total" class="form-control" name="etxtPayment_total" readonly style="display: block;">
				<input type="text" id="etxtPayment_discount" class="form-control" name="etxtPayment_discount" readonly style="display: block;">
				<input type="text" id="etxtPayment_totroomprice" class="form-control" name="etxtPayment_totroomprice" readonly style="display: block;">
            </div>
		</div>		

		<div class="row" style="display: none;" id="transfer_money">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ข้อมูลการโอน : </span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-9 col-xs-5">
				<div class="row" >
		            <div class="col-lg-12" style="margin-top: 10px">
						<label for="eslPaymentType"><?php echo $this->lang->line('bank_transfer_form'); ?> : </label>
						<select id="eslPaymentType" name="eslPaymentType" class="form-control">
							<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
							<?php 
								$bname = "";
								foreach ($bank as $key => $value) {
									$bname = "name_".$this->lang->line('select_lang');
									echo '<option value="'.$value->id.'">'.$value->$bname.'</option>';
								}
							?>
						</select>
					</div>
					<div class="col-lg-12" style="margin-top: 10px">
						<label for="eslBankTransferTo"><?php echo $this->lang->line('transfer_to_bank'); ?> : </label>
						<select id="eslBankTransferTo" name="eslBankTransferTo" class="form-control">
							<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
							<?php  
								foreach ($bank_list as $key => $value) {
										$name = ($_COOKIE[$keyword.'Lang'] == "th") ? $value->name_th : $value->name_en;
										echo '<option value="'.$value->id.'">'.$name.'</option>';
									}
								?>
						</select>
		            </div>
		            <div class="col-lg-12" style="margin-top: 10px">
		            	<label for="etxtPayment_cardcode"><?php echo $this->lang->line('promotion_image'); ?> : </label>
						<input type="file" name="fPromotion" id="fPromotion" onchange="change_img()">
		            </div>
		            <div class="col-lg-12" style="margin-top: 10px">
		            	<img id="img" width="250px" style="margin-bottom: 10px;">
		            </div>
					<div class="col-lg-6" style="margin-top: 10px">
						<label for="txtPaymentDateTime">วันที่ : </label>
						<input type="text" id="txtPaymentDateTime" class="form-control check_in" name="txtPaymentDateTime" placeholder="<?php echo $this->lang->line('select_datetime'); ?>">
					</div>
					<div class="col-lg-3" style="margin-top: 10px">
						<label for="timeHour">เวลา : </label>
						<select class="form-control" name="timeHour" id="timeHour">
							<option value=""> เลือกชั่วโมง </option>
					        <?php 
					        for ($i=1; $i <= 24; $i++) { 
					        	if($i < 10){$str = 0;}else{$str = "";}
					        	echo "<option value='".$str.$i."'>".$str.$i."</option>";
					        }
					        ?>
					    </select>
					</div>
					<div class="col-lg-3" style="margin-top: 10px">
						<label for="timeMinute">นาที : </label>
						<select class="form-control" name="timeMinute" id="timeMinute">
							<option value=""> เลือกนาที </option>
					        <?php 
					        for ($i=0; $i <= 60; $i++) { 
					        	if($i < 10){$str = 0;}else{$str = "";}
					        	echo "<option value='".$str.$i."'>".$str.$i."</option>";
					        }
					        ?>
					    </select>
					</div>
				</div>
			</div>
		</div>



		<div class="row" style="display: none;" id="visa">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ข้อมูลบัตร : </span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-9 col-xs-5">
				<div class="row" >
					<div class="col-lg-12" style="margin-top: 10px">
						<img src="assets/images/v1.png" class="img-rounded" alt="masster" style="width: 40px; height: 40px">
						<img src="assets/images/v2.png" class="img-rounded" alt="masster" style="width: 40px; height: 40px">
						<img src="assets/images/v3.png" class="img-rounded" alt="masster" style="width: 40px; height: 40px">
					</div>
		            <div class="col-lg-12" style="margin-top: 10px">
						<label for="etxtPayment_cardcode">หมายเลขบัตร : </label>
						<input type="text" id="etxtPayment_cardcode" class="form-control" name="etxtPayment_cardcode">
					</div>
					<div class="col-lg-12" style="margin-top: 10px">
						<label for="etxtPayment_cardname">ชื่อผู้ถือบัตร : </label>
						<input type="text" id="etxtPayment_cardname" class="form-control" name="etxtPayment_cardname">
		            </div>
					<div class="col-lg-12" style="margin-top: 10px">
						<label for="etxtPayment_cardexpireddate">วันหมดอายุ : </label>
						<input type="text" id="etxtPayment_cardexpireddate" class="form-control" name="etxtPayment_cardexpireddate">
					</div>
					<div class="col-lg-12" style="margin-top: 10px">
						<label for="etxtPayment_cardevv">CVV <span class="glyphicon" data-toggle="popover" data-img="assets/images/cvv.jpg">&#xe086;</span>: </label>
						<input type="text" id="etxtPayment_cardevv" class="form-control" name="etxtPayment_cardevv">
		            </div>
				</div>
			</div>
		</div>

		<div class="row" style="display: none;" id="wallet">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ข้อมูลบัตร : </span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-9 col-xs-5">
				<div class="row" >
					xxxxxxxxxxxxxxxxxxxx
				</div>
			</div>
		</div>

		<div class="row" id="pay_cash">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>จำนวนเงินที่จ่าย : </span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-9 col-xs-5">
				<input class="form-control input-lg" placeholder="คลิกเพื่อแสดงยอด" id="etxtPaymentAmount" name="etxtPaymentAmount" type="text" style="background: lemonchiffon" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onclick="showMoneyPay();" >
			</div>
		</div>

		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('description'); ?> : </span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-9 col-xs-5">
				<textarea id="etxtPaymentDescription" name="etxtPaymentDescription" class="form-control" rows="5"></textarea>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<div style="display: block;">
					<input type="text" id="txtPayment_id" name="txtPayment_id" value="0">
					<input type="text" id="txtPayment_status" name="txtPayment_status" value="0">

					<input type="text" id="etxtPayment_booking_id" class="form-control" name="etxtPayment_booking_id">
					<input type="text" id="etxtPayment_m_customer_id_book" class="form-control" name="etxtPayment_m_customer_id_book">
					<input type="text" id="etxtPayment_m_customer_id_guest" class="form-control" name="etxtPayment_m_customer_id_guest">
					<input type="text" id="etxtPayment_promotion_id" class="form-control" name="etxtPayment_promotion_id">
					<input type="text" id="txtImages" name="txtImages" value="0">
					<input type="text" id="oldImages" name="oldImages" value="">					
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<button type="button" class="btn btn-primary" onclick="save_data()"><?php echo $this->lang->line('save'); ?></button>
				<button type="button" class="btn btn-warning" onclick="clear_data()"><?php echo $this->lang->line('clear'); ?></button>
			</div>			
		</div>		
	</form>
</div>


<!-- ###################################### Manage  ######################################-->

<!-- Modal show booking detail -->
  <div class="modal fade" id="myModal_detail" role="dialog">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	    <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	<div class="title" id="title"></div>
	    </div>
	    <div class="modal-body">
	      	<div class="bok_detail" id="bok_detail"></div> 
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
  </div>

<script type="text/javascript">
	var page = 1;
	var no_page = false;

	$(document).ready(function() {
		set_datepicker();
		get_data_list();
		popover();
	});

	function popover(){
		$('[data-toggle="popover"]').popover({
			//trigger: 'focus',
			trigger: 'hover',
			html: true,
			content: function () {
				return '<img class="img-rounded" src="'+$(this).data('img') + '" style="width: 140px; height: 140px" />  รหัส CVV คือตัวเลขสามหลักที่อยู่บนหลังบัตรของท่าน';
			},
			title: ''
    	}) 
	}

	function paytype(pvalue){
		if($("#etxtPayment_booking_id").val() == ""){ 
			alert( "Please choose a booking." ); 
			document.getElementById("eslPaytype").selectedIndex = 0;
			return false; 
		}
		$("#etxtPaymentAmount").val("");
		document.getElementById("etxtPayment_totalx").style.display = "none";
		document.getElementById("etxtPayment_total").style.display = "block";
		document.getElementById("transfer_money").style.display = "none";
		document.getElementById("visa").style.display = "none";
		document.getElementById("wallet").style.display = "none";
		// document.getElementById("pay_cash").style.display = "none";
		switch (pvalue){
			case "pay_cash":
				document.getElementById("etxtPayment_totalx").style.display = "none";
				document.getElementById("etxtPayment_total").style.display = "block";
				document.getElementById("pay_cash").style.display = "block";
				
				break;
			case "transfer_money":
				document.getElementById("transfer_money").style.display = "block";
				break;
			case "visa":
				document.getElementById("visa").style.display = "block";
				break;
			case "wallet":
				document.getElementById("wallet").style.display = "block";
				break;
			default:
				document.getElementById("etxtPayment_total").style.display = "none";
				document.getElementById("etxtPayment_totalx").style.display = "block";
		}
		
	}

	function showMoneyPay(){		
		if($("#eslPaytype").val() != ""){
			ofprice = $("#etxtPayment_total").val();
			$("#etxtPaymentAmount").val(ofprice);
		}
	}

	function search_promotion(){
		if($("#etxtPayment_check_in").val() == ""){alert( "Please choose a booking." ); return false;}
		if($("#etxtPayment_check_out").val() == ""){alert( "Please choose a booking." ); return false;}
		if($("#etxtPayment_promotion_code").val() == ""){alert( "Please choose a booking." ); return false;}

		var roomType = [];
		$(".get_roomtype").each(function(){
			roomType.push($(this).attr('data'));
		});

		var option = {
			check_in : $("#etxtPayment_check_in").val(),
			check_out : $("#etxtPayment_check_out").val(),
			promotion_code : $("#etxtPayment_promotion_code").val(),
			room_type : roomType.toString(),

			booking_id 	: $("#etxtPayment_booking_id").val(),
			is_waitpayment	: ''
		}

		$.get("payment/search_promotion_codeanddate", option,function( aData ){
			aData = jQuery.parseJSON( aData );
			// console.log(Object.keys(aData).length);
			// $("#dash").empty();
			if ( Object.keys(aData).length > 0) {
				var str_html  = "";var ssum = 0; var dsum = 0; var pid = ""; var osdPay = 0;
				// console.log(aData);
				$.each(aData, function(k , v){
					// if (v.room_code != "") {
						str_html += "<tr>"; 
						str_html += " <td>"+( parseInt(k)+1 )+"</td>"; 
						str_html += " <td>"+v.room_code+"</td>";
						str_html += " <td>"+v.room_name+"</td>";  
						str_html += " <td class='get_roomtype' data='"+v.room_typeid+"'>"+v.room_type+"</td>";
						str_html += " <td class='text-right get_promotionid' data='"+v.promotion_id+"'>"+v.discount+"</td>";
						str_html += " <td class='text-right'>"+v.room_price+"</td>"; 
						str_html += " <td class='text-right'>"+v.sum+"</td>"; 
						str_html += "</tr>";
						ssum = ssum + parseInt(v.sum);
						dsum = dsum + parseInt(v.discount);
						pid = v.promotion_id;
						// console.log(v.promotion_id)
						// rprice = rprice + v.room_price;
					// }					
				});
				if (ssum != 0) {
					str_html += "<tr>"; 
					str_html += " <td colspan='5'></td>"; 
					str_html += " <td class='text-right'>รวม</td>";
					str_html += " <td class='text-right'>"+ssum+"</td>";  
					str_html += "</tr>";
				}				
				osdPay = $("#osdPay").val();
				$("#tb-room-list tbody").html( str_html );
				$("#etxtPayment_discount").val(dsum);
				$("#etxtPayment_promotion_id").val(aData[0]['promotion_id']);

				// if(osdPay != 0){					
					$("#etxtPayment_total").val(ssum - osdPay);
				// }else{
				// 	$("#etxtPayment_total").val(ssum);
				// }			
				
			} else {
				// $("#tb-room-list tbody").empty();
				// $("#etxtPayment_total").val("");
				clear_data();
				alert( "no data promotion code" );
			}

		});
	}

	function set_datepicker(){
    	var d = moment().add(1, 'days');
		// $("#txtPaymentTime").val( moment().format('D-MM-YYYY') );
		$("#txtCheckOut").val( d.format('D-MM-YYYY') );

		$("#txtPaymentTime").datepicker({
			format: 'dd-mm-yyyy',
			autoclose: true
		});

		$("#txtPaymentDateTime").datepicker({
			format: 'dd-mm-yyyy',
			autoclose: true
		});
	}

	function get_data_list(){
		var option = {
				bank_id 		: "",
				payment_time 	: $("#txtPaymentTime").val(),
				status 			: $("#slPaymentStatus").val(),
				slPaymentType 	: $("#slPaymentType").val(),
				bank_transfer_to	: $("#slBankTransferTo").val(),
				page 			: page
			}
		$.get("payment/search_payment", option,function( aData ){
			aData = jQuery.parseJSON( aData );
			// console.log(aData);
			var str_html  = ""; 
			if ( Object.keys(aData).length > 1) {
				$.each(aData, function(k , v){
					if (k=="limit") { return; }
					var status = v.status;
					switch (v.status) {
						case 'wait_confirm'	: 
							status = '<span style="color:#000;"><?php echo $this->lang->line('wait_confirm'); ?></span>';
							break;
						case 'already_paid'	: 
							status = '<span style="color:blue;"><?php echo $this->lang->line('already_paid'); ?></span>';
							break;
						case 'cancel'		: 
							status = '<span style="color:red;"><?php echo $this->lang->line('cancel'); ?></span>';
							break;
					}

					var paytype = "";
					switch (v.pay_type) {
						case 'transfer_money' : 
							paytype = '<?php echo $this->lang->line('transfer'); ?>';
							break;
						case 'pay_cash' : 
							paytype = '<?php echo $this->lang->line('pay_cash'); ?>';
							break;
						case 'visa' : 
							paytype = '<?php echo $this->lang->line('visa'); ?>';
							break;
						case 'wallet' : 
							paytype = 'wallet';
							break;
						default:
							paytype = 'xxxxx';
							break;
					}

					str_html += "<tr>"; 
					str_html += " <td>"+( parseInt(k)+1 )+"</td>"; 
					str_html += " <td>"+moment(v.pay_time).format('YYYY-MM-D')+"</td>";
					str_html += " <td><a href='#' onclick='show_booking_data(\""+v.bok_name_book+"  "+v.bok_lastname_book+"\","+v.booking_id+")'>"+v.bok_name_book+"  "+v.bok_lastname_book+"</a></td>";
					str_html += " <td class='text-right'>"+v.summary+"</td>";  
					str_html += " <td class='text-right'>"+v.discount+"</td>";
					str_html += " <td class='text-right'>"+v.total+"</td>";  
					str_html += " <td class='text-right'>"+v.pay_amount+"</td>";  
					str_html += " <td>"+paytype+"</td>";
					str_html += " <td>"+v.remark+"</td>"; 
					str_html += " <td>"+status+"</td>";  
					str_html += " <td align='center'>";
					str_html += " 	<i class='fa fa-edit' style='font-size:20px' onclick='to_add_data("+v.id+","+v.booking_id+")'></i>";
					str_html += " 	<i class='fa fa-exchange' style='font-size:20px' onclick='open_chang_status("+v.id+","+v.status+",\""+v.title+"\")' title='<?php echo $this->lang->line('status'); ?>'></i>";
					str_html += " </td>";
					str_html += "</tr>"; 				
					
				});

				// forLang();
			}else{
				str_html += "<td colspan='10' class='text-center' style='color:red;margin-top:15px;'> <?php echo $this->lang->line('no_data'); ?> </td>";
			}

			$("#tb-quo-list tbody").html( str_html );
			// if ( aData.length > 1) { 
				var len = Object.keys(aData).length - 1;
					len = ( aData.limit == len ) ? true : false;
				set_number_page( len ); 
			// }

		});
	}

	function show_booking_data( title, booking_id){
		if(title != "" && booking_id != ""){
			var option = {
				booking_id 	: booking_id,
				is_waitpayment	: ''
			}

			$.get("payment/search_booking_cusprofile_notin", option,function( aData ){				
				aData = jQuery.parseJSON( aData );
				
				if ( Object.keys(aData).length > 0) {
					aData = aData[0];
					var str_title = "<h2 class='modal-title'>"+title+"</h2>";
					$("#myModal_detail").modal({show: true});
					$("#title").html( str_title );
					
					var str_bookdata = "";
					str_bookdata += "<table class='table table-striped'>";
					str_bookdata += "<tbody>";
					str_bookdata += "<tr>";
					str_bookdata += "<th width='20%' style='vertical-align:unset'><?php echo $this->lang->line('people_booking'); ?></th>";
					str_bookdata += "<td>";
					str_bookdata += aData.prefix_book+"  "+aData.name_book+"  "+aData.lastname_book+"<br>";
					str_bookdata += "<?php echo $this->lang->line('email'); ?> : "+aData.email_book+"<br>";
					str_bookdata += "<?php echo $this->lang->line('tel'); ?> : "+aData.tel_book+"<br>";
					str_bookdata += "</td>";
					str_bookdata += "</tr>";
					str_bookdata += "<tr>";
					str_bookdata += "<th width='20%' style='vertical-align:unset'><?php echo $this->lang->line('guest_booking'); ?></th>";
					str_bookdata += "<td>";
					str_bookdata += aData.prefix_guest+"  "+aData.name_guest+"  "+aData.lastname_guest+"<br>";
					str_bookdata += "<?php echo $this->lang->line('email'); ?> : "+aData.email_guest+"<br>";
					str_bookdata += "<?php echo $this->lang->line('tel'); ?> : "+aData.tel_guest+"<br>";
					str_bookdata += "</td>";
					str_bookdata += "</tr>";
					str_bookdata += "<tr>";
					str_bookdata += "<th width='20%' style='vertical-align:unset'><?php echo $this->lang->line('detail'); ?></th>";
					str_bookdata += "<td>";
					str_bookdata += "<?php echo $this->lang->line('s_check_in'); ?> : "+moment(aData.check_in).format('YYYY-MM-D')+"<br>";
					str_bookdata += "<?php echo $this->lang->line('s_check_out'); ?> : "+moment(aData.check_out).format('YYYY-MM-D')+"<br>";
					str_bookdata += "<?php echo $this->lang->line('guests_qty'); ?> : "+aData.customer_qty+"<br>";
					str_bookdata += "<?php echo $this->lang->line('guests_qty'); ?> (<?php echo $this->lang->line('childen'); ?>) : "+aData.child_qty+"<br>";
					str_bookdata += "<?php echo $this->lang->line('qty_room'); ?> : "+aData.room_qty+"<br>";
					str_bookdata += "</td>";
					str_bookdata += "</tr>";
					str_bookdata += "</tbody>";
					str_bookdata += "</table>";

					$("#bok_detail").html( str_bookdata );
				} else {
					alert( "no data" );
				}
			});
		}
	}

	function set_number_page( status ){ 
		var str = "";
		if (no_page == false) {
			for(var i=1; i <= page ; i++){
				var css = (i == page) ? "default" : "link";
				if (page != 1) {
					str += '<button type="button" class="btn btn-'+css+' btn-xs" id="btn-to-page'+i+'" onclick="to_page('+i+');">'+i+'</button>';
				}
				if (status && i == page) { 
					if(page != 1){ $("#bnt-Previous").show(); } else{ $("#bnt-Previous").hide(); }
					$("#bnt-next").show(); 
					str += '<button type="button" class="btn btn-link btn-xs" id="btn-to-page'+(i+1)+'" onclick="to_page('+(i+1)+')">'+(i+1)+'</button>';
					no_page = true;
				}else if (!status) {
					$("#bnt-next").hide(); 
				}
			}
			$("#div-page-number").html( str );
		}else{
			$("#div-page-number").find(".btn-default").each(function(){
				$(this).removeClass("btn-default");
				$(this).addClass("btn-link");
			});

			$("#btn-to-page"+page).removeClass("btn-link");
			$("#btn-to-page"+page).addClass("btn-default");
		}
		
	}

	function next_page( number_page ){
		no_page = false;
		page 	= number_page;
		get_data_list();
	}

	function to_page( number_page ){
		no_page = true;
		page 	= number_page;
		get_data_list();
	}

	function previous( number_page ){
		if (number_page == 0) { return; }
		page = number_page;
		if (page < 1) { page = 1; }
		get_data_list();
	}

	function clear_data(){
		$("input").val("");
		$("select").val("");
		$("textarea").val("");
		set_datepicker();
		$("#tb-room-list tbody").empty();
		$("#dash").empty();
		$("#txtPayment_id").val(0);
		$("#txtPayment_status").val(0);
	}

	function to_manage_data(){ //หน้า listdata
		$("#box-manage").hide();
		$("#box-show-search").show();
		$("#btn-toadd_data").show();
		$("#btn-tomanage_data").hide();
		$("#box-manage").css("width","0");
	}

	function to_add_data( payment_id = 0, book_id ){ // เพิ่ม แก้ไข		
		// console.log(payment_id);
		$("#txtPayment_id").val( payment_id );
		$("#box-manage").show();
		$("#box-show-search").hide();
		$("#btn-toadd_data").hide();
		$("#btn-tomanage_data").show();
		$("#box-manage").css("width","100%");

		if (payment_id != 0) {

			var option = {
				book_id 	: book_id
			}

			$.get("payment/search_booking_cusprofile", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				if ( Object.keys(aData).length > 0) {
					aData = aData[0];
					// var xactive = "";
					// var ci = "";ci = "chip"+v.id; 
					// $("#tb-room-list tbody").empty();
					// 	$("#dash").empty();
					var xstyle = ""; var str_html  = "";
					var ximg = ""; var ci = "";ci = "chip"+aData.id;
					if(aData.profile_img == ""){
						ximg = "assets/upload/customer_profile/cus-noimage.png";
					}else{
						ximg = aData.profile_img;
					}
					if(aData.status == 'outstanding'){ xstyle = "background-color:darkseagreen"; }
					str_html += "<div class='chip' id='"+ci+"' style='margin-left:10px; margin-top:10px; "+xstyle+" '>";	
					str_html += "<img src='"+ximg+"' alt='customer' width='96' height='96'>";
					str_html += aData.name_book+" "+aData.lastname_book;
					str_html += "</div>";
					$("#bok_status_waitpayment").html( str_html );
					
					add_payment_frombooking(aData.id);
				} else {
					alert( "no data" );
				}
			});
		}else{
			clear_data();

			var option = {}
			$.get("payment/search_booking_cusprofile", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				var str_html  = "";
				$.each(aData, function(k , v){
					var xactive = "";
					var ci = "";ci = "chip"+v.id;
					var ximg = ""; var xstyle = "";
					if(k == 0){xactive = "active";}
					if(v.profile_img == ""){
						ximg = "assets/upload/customer_profile/cus-noimage.png";
					}else{
						ximg = v.profile_img;
					}
					if(v.status == 'outstanding'){ xstyle = "background-color:darkseagreen"; }
					str_html += "<div class='chip' id='"+ci+"' onclick='add_payment_frombooking("+v.id+")' style='margin-left:10px; margin-top:10px; "+xstyle+" '>";						
					str_html += "<img src='"+ximg+"' alt='customer' width='96' height='96'>";
					str_html += v.name_book+" "+v.lastname_book+" ("+v.summary+")";
					str_html += "</div>";
				});
				$("#bok_status_waitpayment").html( str_html );
			});
			
			$("#txtPosition_id").val("0");
		}

		$('.datepicker').datepicker({format: 'dd-mm-yyyy'});
	}

	function add_payment_frombooking(id){
		var element = document.getElementById("bok_status_waitpayment").getElementsByClassName("chip");
		var d = ""; d = "chip"+id;
		for (var i = 0; i < element.length; i++) {
			var current = document.getElementById("bok_status_waitpayment").getElementsByClassName("xactive");
			if(current.length > 0){
				current[0].className = current[0].className.replace(" xactive", "");
				this.className += " xactive";
			}			
		}
		document.getElementById(d).classList.add("xactive");
		// clear_data();

		var option = {
			booking_id 	: id,
			is_waitpayment	: ''
		}
		// console.log(id);
		$.get("payment/search_booking", option,function( aData ){				
			aData = jQuery.parseJSON( aData );
			if ( Object.keys(aData).length > 0) {
				aval = aData[0];
				// console.log(aval);
				$("#etxtPayment_check_in").val(moment(aval.check_in).format('YYYY-MM-D'));
				$("#etxtPayment_check_out").val(moment(aval.check_out).format('YYYY-MM-D'));
				$("#etxtPayment_name_book").val(aval.name_book);
				$("#etxtPayment_lastname_book").val(aval.lastname_book);
				$("#etxtPayment_name_guest").val(aval.name_guest);
				$("#etxtPayment_lastname_guest").val(aval.lastname_guest);
				// $("#etxtPayment_summary").val(v.summary);
				$("#etxtPayment_total").val(aval.summary);

				$("#etxtPayment_booking_id").val(aval.id);
				$("#etxtPayment_m_customer_id_book").val(aval.m_customer_id_book);
				$("#etxtPayment_m_customer_id_guest").val(aval.m_customer_id_guest);

				var str_html  = ""; var rprice = 0;
				$.each(aData, function(k , v){
					str_html += "<tr>"; 
					str_html += " <td>"+( parseInt(k)+1 )+"</td>"; 
					str_html += " <td>"+v.room_code+"</td>";
					str_html += " <td>"+v.room_name+"</td>";  
					str_html += " <td class='get_roomtype' data='"+v.room_typeid+"'>"+v.room_type+"</td>";
					str_html += " <td class='text-right'>0</td>";
					str_html += " <td class='text-right'>"+v.room_price+"</td>";
					str_html += " <td class='text-right'>"+v.room_price+"</td>";  
					str_html += "</tr>";
					// rprice = rprice + v.room_price;
				});
				str_html += "<tr>"; 
				str_html += " <td colspan='5'></td>";  
				str_html += " <td class='text-right'>รวม</td>";
				str_html += " <td class='text-right'>"+aval.summary+"</td>";  
				str_html += "</tr>";
				$("#tb-room-list tbody").html( str_html );
				$("#etxtPayment_totroomprice").val(aval.summary);

				if(aval.status == "outstanding"){
					var option = {
							booking_id 		: aval.id
						}
					
					$.get("payment/search_payment", option,function( bData ){
						bData = jQuery.parseJSON( bData );
						var osd_html = ""; var osd = 0;
						if ( Object.keys(bData).length > 0) {
							pay = bData[0];
							osd_html += "<hr>";
							osd_html += "<b>ยอดค้างชำระ</b>";
							osd_html += "<br>";
							osd_html += "<table class='table table-striped'>";
							osd_html += "<thead>";
							osd_html += "<tr>";
							osd_html += "<th>ลำดับ</th>";
							osd_html += "<th>รายการ</th>";
							osd_html += "<th>วันที่ชำระ</th>";
							osd_html += "<th>ยอดรวม</th>";
							osd_html += "<th>ยอดชำระ</th>";
							osd_html += "<th>ยอดค้างชำระ</th>";
							osd_html += "</tr>";
							osd_html += "</thead>";
							osd_html += "<tbody>";
							osd_html += "<tr>";
							osd_html += "<td>1</td>";
							osd_html += "<td>ชำระครั้งที่ 1</td>";
							osd_html += "<td class='text-right'>"+moment(pay.pay_time).format('YYYY-MM-D')+"</td>";
							osd_html += "<td class='text-right'>"+pay.total+"</td>";
							osd_html += "<td class='text-right'>"+pay.pay_amount+"</td>";
							osd_html += "<td class='text-right'>"+parseInt(pay.total - pay.pay_amount)+"</td>";
							osd_html += "</tr>";
							osd_html += "</tbody>";	
							osd_html += "</table>";

							if(pay.promotion_id != 0){
								document.getElementById("etxtPayment_promotion_code").readOnly = true;
							}
							document.getElementById("etxtPaymentAmount").readOnly = true;
							$("#etxtPaymentAmount").val(parseInt(pay.total - pay.pay_amount));
							$("#etxtPayment_total").val(parseInt(pay.total - pay.pay_amount));
							osd = parseInt(pay.total - pay.pay_amount);
						}					
						$("#dash").html(osd_html);	
						$("#osdPay").val(osd);
					});
				}
				
				if ($("#txtPayment_id").val() != 0) {
					// console.log(aval);
					var coption = {
							payment_id 		: $("#txtPayment_id").val()
						}
						// console.log(coption);
					$.get("payment/search_payment", coption ,function( cData ){
						cData = jQuery.parseJSON( cData );
						// console.log(cData);
						pay = cData[0];

						$("#eslPaytype option[value='"+pay.pay_type+"']").prop('selected', true);
						// $("#etxtPositionCode").val(aData.code);
						// console.log(pay.pay_type);
						// return false;
						paytype(pay.pay_type);
						switch (pay.pay_type){
							case "pay_cash":
																
								break;
							case "transfer_money":
								var str = aval.profile_img;			
								var str2 = str.substr(31);
								$("#eslPaymentType option[value='"+pay.m_bank_id_transfer+"']").prop('selected', true);
								$("#etxtPayment_discount").val(pay.discount);
								$("#etxtPayment_totroomprice").val(pay.total);
								$("#eslBankTransferTo option[value='"+pay.m_bank_number_list_id+"']").prop('selected', true);
								$("#txtPaymentDateTime").val(pay.transfer_date);
								
								var get_time = pay.transfer_time;
								var arr_time = get_time.split(":");
								$("#timeHour option[value='"+arr_time[0]+"']").prop('selected', true);
								$("#timeMinute option[value='"+arr_time[1]+"']").prop('selected', true);
								// $("#etxtPaymentAmount").val(pay.pay_amount);
								console.log(pay.pay_amount);
								$("#etxtPaymentDescription").val(pay.remark);
								$("#txtImages").val(aval.profile_img);
								$("#oldImages").val(str2.substring(0, str2.length-4));
								$("#img").attr("src", aval.profile_img);
								break;
							case "visa":
								
								break;
							case "wallet":
								
								break;
							default:
								
						}
						// 	// $("#etxtPositionCode").val(aData.code);
						// 	// $("#etxtPositionName").val(aData.name);
						// 	// $("#eslPositionDivision option[value='"+aData.m_division_id+"']").prop('selected', true);
						// 	// $("#eslPositionDepartment option[value='"+aData.m_department_id+"']").prop('selected', true);
						// 	// $("#txtPromotionImages").val(aData.promotion_img);					
						// 	// $("#oldPromotionImages").val(str2.substring(0, str2.length-4));
						// 	// $("#img").attr("src", aData.promotion_img);	
					});					
				}
			} else {
				alert( "no data" );
			}
		});
	}

	function clear_data_onpay(){
		//transfer_money status
		document.getElementById("eslPaymentType").selectedIndex = 0;
		document.getElementById("eslBankTransferTo").selectedIndex = 0;
		$("#txtPaymentDateTime").val("");
		document.getElementById("timeHour").selectedIndex = 0;
		document.getElementById("timeMinute").selectedIndex = 0;
	}

	function select_photo(){

	}

	function search_data(){
		page 	= 1;
		no_page = true;
		get_data_list();
		set_datepicker();
	}


	function change_img(){
        var fd = new FormData();
        var files = $('#fPromotion')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: 'main/upload',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    $("#img").attr("src",response); 
                    $("#txtImages").val( response );
                    
     //                var str = aData.promotion_img;
					// $("#oldPromotionImages").val(str.substr(14));
                    // newPromotionImages
                    // $(".preview img").show(); // Display image element
                }else{
                    alert('file not uploaded');
                }
            },
        });
	}

	function save_data(){
		// if($("#eslPaytype").val() == ""){alert(); return false}
		if($("#etxtPaymentAmount").val() > $("#etxtPayment_total").val()){alert("Amonut > total"); return false}
		var aData = JSON.stringify( $("#form-manage").serializeArray() );
			aData = jQuery.parseJSON( aData );
			// console.log(aData);
			// console.log(aData[8]['value']);
			// return false;
		if (validate(aData, aData[8]['value'])) {
			$.post("payment/save_data",  aData  ,function( res ){
				res = jQuery.parseJSON( res ); 
				if (res.flag) {
					alert( res.msg );
					get_data_list();
					to_manage_data();
				}else{
					alert( res.msg );
				}

			});
		}
	}

	function validate(aData, pstatus){ 
		var status = true;
		if(pstatus == ""){alert("Select paytype ?"); return false;}

		switch(pstatus){
			case "pay_cash":
				$.each(aData,function(k,v){
					if (v.name != "etxtPayment_booking_id" && v.name != "etxtPayment_m_customer_id_book" && v.name != "etxtPayment_m_customer_id_guest" && v.name != "etxtPayment_promotion_id" && v.name != "etxtPayment_promotion_code" && v.name != "etxtPayment_totalx" && v.name != "txtPayment_id" && v.name != "txtPayment_status" && v.name != "etxtPaymentDescription" && v.name != "osdPay" && v.name != "txtImages" && v.name != "oldImages"		 && v.name != "eslPaymentType" && v.name != "eslBankTransferTo" && v.name != "fPromotion" && v.name != "etxtPayment_cardcode" && v.name != "etxtPayment_discount" && v.name != "etxtPayment_cardname" && v.name != "etxtPayment_cardexpireddate" && v.name != "etxtPayment_cardevv" && v.name != "etxtPayment_totroomprice" && v.name != "txtPaymentDateTime" && v.name != "timeHour" && v.name != "timeMinute") {				
						var obj = $("#"+v.name);
						if (obj.val() == "") {
							obj.addClass("error-form");
							obj.focus();
							status = false;			
						}else{
							obj.removeClass("error-form");
						}
					}
				});
				break;
			case "transfer_money":
				$.each(aData,function(k,v){
					if (v.name != "etxtPayment_booking_id" && v.name != "etxtPayment_m_customer_id_book" && v.name != "etxtPayment_m_customer_id_guest" && v.name != "etxtPayment_promotion_id" && v.name != "etxtPayment_promotion_code" && v.name != "etxtPayment_totalx" && v.name != "txtPayment_id" && v.name != "txtPayment_status" && v.name != "etxtPaymentDescription" && v.name != "osdPay" && v.name != "txtImages" && v.name != "oldImages" && v.name != "etxtPayment_discount" && v.name != "etxtPayment_totroomprice" && v.name != "etxtPayment_cardcode" && v.name != "etxtPayment_cardname" && v.name != "etxtPayment_cardexpireddate" && v.name != "etxtPayment_cardevv") {				
						var obj = $("#"+v.name);
						if (obj.val() == "") {
							// console.log(obj);
							obj.addClass("error-form");
							obj.focus();
							status = false;			
						}else{
							obj.removeClass("error-form");
						}
					}
				});
				break;
			case "visa":
				// $.each(aData,function(k,v){
				// 	if (v.name != "etxtPayment_booking_id" && v.name != "etxtPayment_m_customer_id_book" && v.name != "etxtPayment_m_customer_id_guest" && v.name != "etxtPayment_promotion_id" && v.name != "etxtPayment_promotion_code" && v.name != "etxtPayment_totalx"  && v.name != "txtPayment_id" && v.name != "etxtPaymentDescription") {				
				// 		var obj = $("#"+v.name);
				// 		if (obj.val() == "") {
				// 			obj.addClass("error-form");
				// 			obj.focus();
				// 			status = false;			
				// 		}else{
				// 			obj.removeClass("error-form");
				// 		}
				// 	}
				// });
				break;
			case "wallet":
				// $.each(aData,function(k,v){
				// 	if (v.name != "etxtPayment_booking_id" && v.name != "etxtPayment_m_customer_id_book" && v.name != "etxtPayment_m_customer_id_guest" && v.name != "etxtPayment_promotion_id" && v.name != "etxtPayment_promotion_code" && v.name != "etxtPayment_totalx" && v.name != "etxtPaymentDescription") {				
				// 		var obj = $("#"+v.name);
				// 		if (obj.val() == "") {
				// 			obj.addClass("error-form");
				// 			obj.focus();
				// 			status = false;			
				// 		}else{
				// 			obj.removeClass("error-form");
				// 		}
				// 	}
				// });
				break;
		}

		return status;
	}

	function open_chang_status( employee_id, status ,text_title ){
		$("#txtStatus_employee_id").val( employee_id );
		$("#md-title").html( text_title );
		$("#modal-page").modal("show");
		setTimeout(function(){
			$('input:radio[name="rStatus"][value="'+status+'"]').prop('checked', true);
		},300);
		
	}

	var c_status = true;
	function chang_status( status, book_id ){
		if (c_status && (confirm("! Change Status To " + status))) {
			c_status = false;
			$.post("book/chang_status",  { book_id : book_id, status: status } ,function( res ){
				res = jQuery.parseJSON( res ); 
				if (res.flag) {
					alert( res.msg );
					get_data_list();
					c_status = true;
					$(".modal").modal("hide");
				}else{
					alert( res.msg );
					c_status = true;
				}

			});
		}
	}

	function change_division( idObj_Division, idObj_Department, idObj_Position  ){ 
		$("#"+idObj_Department+" option[value!='']").remove();
		$("#"+idObj_Position+" option[value!='']").remove();
		var division_id = $("#" + idObj_Division).val();
		var option = {
			division_id 	:  division_id
		}
		if (division_id != "") {
			$.get("employee/search_departments", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				$.each(aData, function(k ,v){
					$("#"+idObj_Department).append("<option value='"+v.id+"'>"+v.name+"</option>");
				});
			});
		}
	}

	function change_department( idObj_Division, idObj_Department, idObj_Position ){
		$("#"+idObj_Position+" option[value!='']").remove();
		var department_id = $("#" + idObj_Department).val();
		var division_id = $("#" + idObj_Division).val();
		var option = {
			division_id 	:  division_id,
			department_id 	:  department_id
		}
		if (division_id != "") {
			$.get("employee/search_positions", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				$.each(aData, function(k ,v){
					$("#"+idObj_Position).append("<option value='"+v.id+"'>"+v.name+"</option>");
				});
			});
		}
	}

	function open_form_payment( book_id, amount ){
		$.ajax({
            url:  "book/get_form_payment?amount="+amount,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
            	$("#cs_book_id").val( book_id );
            	$("#md-title").html(response.title);
                $("#md-manage-detail").html(response.temp);
                $("#md-manage").modal("show");
            },
            error: function (response) {
                // console.log(response);
            }
        });
		
	}

	var c_status = true;
	function chang_status( status, book_id, payment_id ){
		if (c_status && (confirm("! Change Status To " + status))) {
			c_status = false;
			$.post("book/chang_status",  { book_id : book_id, status: status } ,function( res ){
				res = jQuery.parseJSON( res ); 
				if (res.flag) {
					c_status = true;
					$(".modal").modal("hide");
				}else{
					alert( res.msg );
					c_status = true;
				}

			});

			$.post("payment/chang_status",  { payment_id : payment_id, status: status } ,function( res ){
				res = jQuery.parseJSON( res ); 
				if (res.flag) {
					alert( res.msg );
					get_data_list();
					c_status = true;
					$(".modal").modal("hide");
				}else{
					alert( res.msg );
					c_status = true;
				}

			});
		}
	}


</script>
