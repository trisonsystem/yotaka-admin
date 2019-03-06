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
	.fa-times-circle{ color: red; margin-top: 6px; }
	.fa{ cursor: pointer; }
	.form-check-input{ cursor: pointer; }
	.error-form{ 
		border: 1px solid red !important;
	}
	.title_page{border-bottom: 1px solid #D9D9D9}
	.box-room-list{ 
			height: 100px;
		    width: 100px;
		    background: #ECECEC;
		    text-align: center;
		    vertical-align: middle;
		    font-size: 16px;
		    display: table;
		    cursor: pointer;
		    border-radius: 5px;
		    box-shadow: 0 2px 4px rgba(0,0,0,0.35), inset 1px 1px 4px -2px rgba(255,255,255,0.22);
		    margin-bottom: 20px;
		    padding: 10px;
		}
	.box-room-list span{ vertical-align: middle; display: table-cell;}
	.box-room-list:hover:not(.rm_active){ background: #f7f7f7;  }
	.rm_active{ background: #6db1d6; color: #FFF; }
	@media (max-width: 600px){
	  .col-xs-11 {
	    margin-left: 20px;
	  }
	}
</style>
<div class="row title_page">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h3 style="font-weight: bold;" class="lang_manage_hotel_data"><?php echo $title;?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
		<!-- <?php if ($_COOKIE[$keyword."level"] == "SA") { ?>
			<button type="button" class="btn btn-secondary" onclick="to_add_data( '0' )" id="btn-toadd_data" style="margin-top: 10px; width: 100px;"><?php echo $this->lang->line('add'); ?></button>
			<button type="button" class="btn btn-warning" onclick="to_manage_data()" id="btn-tomanage_data" style="margin-top: 10px; width: 100px; display: none;"><?php echo $this->lang->line('cancel'); ?></button>
		<?php } ?> -->
	</div>
</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-1 col-xs-1"></div>
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-10">
		<form id="form-search" name="form-search">
		<div class="box-search">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					    <label for="txtCheckIn"><?php echo $this->lang->line('check_in_date'); ?> </label>
					    <input type="text" id="txtCheckIn" class="form-control" name="txtCheckIn">
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					    <label for="txtCheckOut"><?php echo $this->lang->line('check_out_date'); ?> </label>
					    <input type="text" id="txtCheckOut" class="form-control" name="txtCheckOut">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					    <label for="txtEmail"><?php echo $this->lang->line('guests_qty'); ?> </label>
					    <input type="text" id="txtGuestsQty" class="form-control" name="txtGuestsQty">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="form-group">
					    <label for="txtTel"><?php echo $this->lang->line('childen'); ?> </label>
					    <select class="form-control" id="slChilden" name="slChilden" onchange="select_childen()">
					    	<option value="0"><?php echo $this->lang->line('no_childen'); ?></option>
					    	<?php 
					    		for ($i=1; $i <= 10; $i++) { 
					    			echo '<option value="'.$i.'">'.$i." ".$this->lang->line('childen').'</option>';
					    		}
					    	?>
					    </select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="form-group">
					    <label for="txtTel"><?php echo $this->lang->line('room'); ?> </label>
					    <select class="form-control" id="slRoom" name="slRoom">>
					    	<?php 
					    		for ($i=1; $i <= 30; $i++) { 
					    			echo '<option value="'.$i.'">'.$i.'</option>';
					    		}
					    	?>
					    </select>
					</div>
				</div>
			</div> 
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					    <label for=""><?php echo $this->lang->line('childen'); ?> </label>
					   	<div id="box-year-childen"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
					<button type="button" class="btn btn-primary" onclick="search_room()" style="width: 150px;"><?php echo $this->lang->line('search'); ?></button>
					
				</div>
			</div>
		</div>
		</form>
	</div>
	<div class="col-lg-9 col-md-7 col-sm-6 col-xs-11">
		<div class="row" id="list_room">
			
		</div>
	</div>
</div>



<!-- 
		<div class="row"
			<div class="col-lg122 col-md122 col-sm123 col-xs123">
				<div class="form-group">
				    <label for="txtPrefix"><?php echo $this->lang->line('prefix'); ?> </label>
				    <input type="text" id="txtPrefix" class="form-control" name="txtPrefix">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtName"><?php echo $this->lang->line('name'); ?> </label>
				    <input type="text" id="txtName" class="form-control" name="txtName">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtLastName"><?php echo $this->lang->line('last_name'); ?> </label>
				    <input type="text" id="txtLastName" class="form-control" name="txtLastName">
				</div>
			</div>
		</div>
		<div class="row"
			<div class="col-lg124 col-md124 col-sm124 col-xs124">
				<div class="form-group">
				    <label for="txtEmail"><?php echo $this->lang->line('email'); ?> </label>
				    <input type="text" id="txtEmail" class="form-control" name="txtEmail">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtTel"><?php echo $this->lang->line('tel'); ?> </label>
				    <input type="text" id="txtTel" class="form-control" name="txtTel">
				</div>
			</div>
		</div>
		<div class="row"
			<div class="col-lg128 col-md128 col-sm128 col-xs1211">
				<div class="radio">
				  <label>
				    <input type="radio" name="rBook" id="rBook1" value="main" onclick="click_radio(true)" checked>
				    <?php echo $this->lang->line('main_guest'); ?>
				  </label>

				  <label style="margin-left: 15px;">
				    <input type="radio" name="rBook" id="rBook2" value="someone" onclick="click_radio(false)">
				    <?php echo $this->lang->line('booking_for_someone_else'); ?>
				  </label>
				</div>
			</div>
		</div>
		<div class="row someone" style="display: none;"
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">12				<div12class="f12rm-group12>
				    <label for="txtPrefix"><?php echo $this->lang->line('prefix'); ?> </label>
				    <input type="text" id="txtPrefix" class="form-control" name="txtPrefix">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtName"><?php echo $this->lang->line('name'); ?> </label>
				    <input type="text" id="txtName" class="form-control" name="txtName">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtLastName"><?php echo $this->lang->line('last_name'); ?> </label>
				    <input type="text" id="txtLastName" class="form-control" name="txtLastName">
				</div>
			</div>
		</div>
		<div class="row someone" style="display: none;"
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">12				<div12class="f12rm-group12>
				    <label for="txtEmail"><?php echo $this->lang->line('email'); ?> </label>
				    <input type="text" id="txtEmail" class="form-control" name="txtEmail">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtTel"><?php echo $this->lang->line('tel'); ?> </label>
				    <input type="text" id="txtTel" class="form-control" name="txtTel">
				</div>
			</div>
		</div>
		 -->
<script type="text/javascript">
	var no_page = false;
	$(document).ready(function() {
		set_datepicker();
		
		set_click_box_room();
    });
    function set_datepicker(){
    	var d = new Date();
		$("#txtCheckIn").val( d.getDate() + "-" + d.getMonth() + "-" + d.getFullYear() );
		$("#txtCheckOut").val( d.getDate() + "-" + d.getMonth() + "-" + d.getFullYear() );

		$("#txtCheckIn").datepicker({
		 	// clearBtn: true,
		    format: 'dd-mm-yyyy',
		    autoclose: true,
		}).on('changeDate', function (selected) {
		    var startDate = new Date(selected.date.valueOf());
		    $('#txtCheckOut').datepicker('setStartDate', startDate);
		}).on('clearDate', function (selected) {
		    $('#txtCheckOut').datepicker('setStartDate', null);
		});

		$("#txtCheckOut").datepicker({
			// clearBtn: true,
		    format: 'dd-mm-yyyy',
		    autoclose: true,
		}).on('changeDate', function (selected) {
		    var endDate = new Date(selected.date.valueOf());
		    $('#txtCheckIn').datepicker('setEndDate', endDate);
		}).on('clearDate', function (selected) {
		    $('#txtCheckIn').datepicker('setEndDate', null);
		});
	}

	function click_radio( status ){
		if (status) {
			$(".someone").hide();
		}else{
			$(".someone").show();
		}
	}

	function search_room(){
		var str_room  = "";
		var aForm = JSON.stringify( $("#form-search").serializeArray() );
			aForm = jQuery.parseJSON( aForm );	
		if (validate(aForm)) {	
			$.get("room/search_room_forbook", aForm,function( aData ){
				aData = jQuery.parseJSON( aData );	
				console.log( aData );
				str_room += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">';
				str_room += ' 	<h5>เตียงเดียวใหญ่</h5>';
				str_room += '</div>';
				for (var i = 0; i < 30; i++) {
					str_room += '<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 box-list">';
					str_room += '		<div class="box-room-list" select="false"> <span>'+"R001"+'<br>(ลีลาวดี)<br>450</span></div>';
					str_room += '</div>';
				}
				$("#list_room").html( str_room );
				set_click_box_room();
			});
		}
	}

	function validate(aData){
		var status = true;
		console.log(aData);
		$.each(aData,function(k,v){
			if (v.name != "txtPromotion_id" && v.name != "txtPromotion_status") {				
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

		return status;
	}

	function set_click_box_room(){
		$(".box-room-list").click(function(){
			 rm_name = $(this).find('span').html();
			 rm_id   = $(this).attr("id");

			if ($(this).attr('select') == "false") {
			  $(this).addClass("rm_active");
			  $(this).attr('select', "true");

			  
			  // var str_html  = '';
			  // 	  str_html += '<tr id="tr_'+pd_id+'">';
			  // 	  str_html += '		<td style="width:120px;">จำนวน : <input type="text" class="number" style="width:50px;" id=\''+ "txtQty_"+pd_id + '\'></td>';
			  // 	  str_html += '		<td>สินค้า : '+pd_name+'</td>';
			  // 	  str_html += '</tr>';

			  // $('#tb-pd-quotation tbody').append(str_html);

			  // $('.number').FullnumOnly();
			}else{
			  $(this).removeClass("rm_active");
			  $(this).attr('select', "false");
			  // $('#tr_' + pd_id ).remove();
			}


			// if ($('#box-pd-quotation tbody tr').length > 0 ) {
			// 	$('#box-pd-quotation').show();
			// }else{ 
			// 	$('#box-pd-quotation').hide();
			// }
			
		});
	}

	function select_childen(){
		var qty = $("#slChilden").val();
		var str_html  = '';
		for (var i = 0; i < qty; i++) {
			str_html += '<select class="form-control" id="slChilden_'+i+'" name="slChilden" style="margin-top: 5px;">';
			// str_html += '	<option value="0"><?php echo $this->lang->line('no_childen'); ?></option>';
	    	<?php 
	    		for ($i=0; $i <= 17; $i++) { 
	    			echo 'str_html += "<option value=\''.$i.'\'>'.$i." ".$this->lang->line('years_old').'</option>";';
	    		}
	    	?>
			str_html += '</select>';
		}	
		$("#box-year-childen").html(str_html);
	}
</script>