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
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
		<form id="form-search" name="form-search">
			<div class="box-search">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="form-group">
						    <label for="txtCheckIn"><?php echo $this->lang->line('check_in_date'); ?> </label>
						    <input type="text" id="txtCheckIn" class="form-control" name="txtCheckIn">
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="form-group">
						    <label for="txtCheckOut"><?php echo $this->lang->line('check_out_date'); ?> </label>
						    <input type="text" id="txtCheckOut" class="form-control" name="txtCheckOut">
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="form-group">
						    <label for="txtEmail"><?php echo $this->lang->line('guests_qty'); ?> </label>
						    <input type="text" id="txtGuestsQty" class="form-control" name="txtGuestsQty" value="1">
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
						<div class="form-group">
						    <label for="txtTel"><?php echo $this->lang->line('childen'); ?> </label>
						    <select class="form-control" id="slChilden" name="slChildenBook" onchange="select_childen()">
						    	<option value="0"><?php echo $this->lang->line('no_childen'); ?></option>
						    	<?php 
						    		for ($i=1; $i <= 10; $i++) { 
						    			echo '<option value="'.$i.'">'.$i." ".$this->lang->line('childen').'</option>';
						    		}
						    	?>
						    </select>
						</div>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
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
					<hr>
				</div>
			</div>
		</form>
	</div>
</div>
<hr>
<div class="row" style=" margin-top: 15px;">
	<div class="col-lg-12 col-md-12 col-sm-1 col-xs-1"></div>
	<div class="col-lg-8 col-md-7 col-sm-6 col-xs-11" style="border-right: 1px solid #EAEAEA;">
		<div class="row" id="list_room"></div>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
		<div class="row" >
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">
				<h5><?php echo $this->lang->line('book_data'); ?></h5>
				
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
				<button type="button" class="btn btn-success btn-xs" onclick="$('#md-search-customer').modal('show')"><?php echo $this->lang->line('search'); ?></button>
			</div>
			<hr>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left" style="padding:0px 25px 25px 25px;">
				<form name="form-book" id="form-book">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<div class="form-group">
							    <label for="txtPrefix"><?php echo $this->lang->line('prefix'); ?> </label>
							    <input type="text" id="txtPrefix" class="form-control" name="txtPrefix" disabled="disabled">
							    <input type="hidden" id="txtCustomerID" class="form-control" name="txtCustomerID">
							    <input type="hidden" id="txtBookID" class="form-control" name="txtBookID" value="0">
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div class="form-group">
							    <label for="txtName"><?php echo $this->lang->line('name'); ?> </label>
							    <input type="text" id="txtName" class="form-control" name="txtName" disabled="disabled">
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div class="form-group">
							    <label for="txtLastName"><?php echo $this->lang->line('last_name'); ?> </label>
							    <input type="text" id="txtLastName" class="form-control" name="txtLastName" disabled="disabled">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">	
							<div class="form-group">
							    <label for="txtEmail"><?php echo $this->lang->line('email'); ?> </label>
							    <input type="text" id="txtEmail" class="form-control" name="txtEmail" disabled="disabled">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">	
							<div class="form-group">
							    <label for="txtTel"><?php echo $this->lang->line('tel'); ?> </label>
							    <input type="text" id="txtTel" class="form-control" name="txtTel" disabled="disabled">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
					<div class="row someone" style="display: none;">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">	
							<button type="button" class="btn btn-success btn-xs" onclick="$('#md-search-customer').modal('show')"><?php echo $this->lang->line('search'); ?></button>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">				
							    <label for="txtBookPrefix"><?php echo $this->lang->line('prefix'); ?> </label>
							    <input type="text" id="txtBookPrefix" class="form-control" name="txtBookPrefix" disabled="disabled">
							    <input type="hidden" id="txtBookCustomerID" class="form-control" name="txtBookCustomerID">
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div class="form-group">
							    <label for="txtBookName"><?php echo $this->lang->line('name'); ?> </label>
							    <input type="text" id="txtBookName" class="form-control" name="txtBookName" disabled="disabled">
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div class="form-group">
							    <label for="txtBookLastName"><?php echo $this->lang->line('last_name'); ?> </label>
							    <input type="text" id="txtBookLastName" class="form-control" name="txtBookLastName" disabled="disabled">
							</div>
						</div>
					</div>
					<div class="row someone" style="display: none;">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">				
							    <label for="txtBookEmail"><?php echo $this->lang->line('email'); ?> </label>
							    <input type="text" id="txtBookEmail" class="form-control" name="txtBookEmail" disabled="disabled">
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">	
							<div class="form-group">
							    <label for="txtBookTel"><?php echo $this->lang->line('tel'); ?> </label>
							    <input type="text" id="txtBookTel" class="form-control" name="txtBookTel" disabled="disabled">
							</div>
						</div>
					</div>	
				</form>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left" id="box-book-detail" style="display: none;">
				<table class="table" id="tb-list-room-book" name="tb-list-room-book">
					<thead>
						<tr>
							<th class="text-center"><?php echo $this->lang->line('type_room'); ?></th>
							<th class="text-center"><?php echo $this->lang->line('code'); ?></th>
							<th class="text-center"><?php echo $this->lang->line('name'); ?></th>
							<th class="text-right"><?php echo $this->lang->line('price'); ?></th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot style="background: #EAEAEA;">
						<tr>
							<td colspan="2" style="color: red; font-weight: bold;" class="text-center"><?php echo $this->lang->line('sum'); ?></td>
							<td colspan="2" id="sum_price" class="text-right">0</td>
						</tr>
					</tfoot>
				</table>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
						<button type="button" class="btn btn-primary" onclick="Save_data()"><?php echo $this->lang->line('save'); ?></button>

						<button type="button" class="btn btn-warning" onclick="clear_data()"><?php echo $this->lang->line('clear'); ?></button>
						
					</div>
					<hr>
				</div>
			</div>
		</div>
		
	</div>
	
</div>










<div class="modal fade" role="dialog" id="md-search-customer">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $this->lang->line('search'); ?><?php echo $this->lang->line('customer'); ?></h4>
        </div>
        <div class="modal-body" id="box-customer">
          	<div class="box-search">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-10 text-right">
						<label class="form-check-label"><input type="radio" class="form-check-input" id="rTypeCardCustomer1" name="rTypeCardCustomer" value="1" checked="checked" > <?php echo $this->lang->line('identification_card'); ?></label>
						&nbsp;&nbsp;
						<label class="form-check-label"> <input type="radio" class="form-check-input" id="rTypeCardCustomer2" name="rTypeCardCustomer" value="2"> <?php echo $this->lang->line('passport'); ?></label>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
						<span><?php echo $this->lang->line('number_card'); ?> : </span>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
						<input type="text" id="txtCustomerCardNumber" class="form-control" name="txtCardNumber">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
						<span class="lang_name"><?php echo $this->lang->line('name'); ?> : </span>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
						<input type="text" id="txtCustomerName" class="form-control" name="txtCustomerName">
					</div>
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
						<span class="lang_last_name"><?php echo $this->lang->line('last_name'); ?> : </span>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
						<input type="text" id="txtCustomerLastName" class="form-control" name="txtCustomerLastName">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
						
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<button type="button" class="btn btn-primary lang_save" onclick="search_customer()"><?php echo $this->lang->line('search'); ?></button>
					<!-- 	<button type="button" class="btn btn-warning lang_clear" onclick="clear_data()"><?php echo $this->lang->line('clear'); ?></button> -->
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
								<th class="text-center"><?php echo $this->lang->line('full_name'); ?></th>
								<th class="text-center"><?php echo $this->lang->line('tel'); ?></th>
								<th class="text-center"><?php echo $this->lang->line('email'); ?></th>
								<th class="text-center"><?php echo $this->lang->line('nationality'); ?></th>
								<th class="text-center"><?php echo $this->lang->line('ethnicity'); ?></th>
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
		
		set_click_box_room();

		 // $.ajax({
   //          url:  "customer/index",
   //          type: 'POST',
   //          dataType: 'json',
   //          success: function (response) {
   //             $("#box-customer").html(response.temp);
   //          },
   //          error: function (response) {
   //              console.log(response);
   //          }
   //      });

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
		var t_room = "";
		if (validate(aForm)) {	
			$.get("book/search_room_forbook", aForm,function( aData ){
				aData = jQuery.parseJSON( aData );
				if (aData.flag == false) { alert( aData.msg ); return false; }
				else{
					$.each(aData, function(k, v){
						if (t_room != v.m_type_room_id) {
							str_room += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">';
							str_room += ' 	<h5>'+v.type_room_name+'</h5>';
							str_room += '</div>';
						}

						t_room = v.m_type_room_id;

						str_room += '<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 box-list">';
						str_room += '		<div class="box-room-list" select="false" id="box-room-list'+v.id+'" vData=\''+JSON.stringify(v)+'\' data="'+v.id+'|'+v.code+'|'+v.name+'|'+v.qty_people+"|"+languages['people']+"|"+v.price+'"> <span style="font-size:12px;">'+v.code+'<br>('+v.name+')<br>'+v.qty_people+" "+languages['people']+" "+v.price+'</span></div>';
						str_room += '</div>';

					});
					
					
					$("#list_room").html( str_room );
					set_click_box_room();

					$('#tb-list-room-book').hide();
					$('#tb-list-room-book tbody').html("");
				}
			});
		}
	}

	function validate(aData){
		var status = true;
		$.each(aData,function(k,v){
			// if (v != "BookID" && v != "rBook") {		
			console.log(v.name);		
				var obj = $("#"+v.name);
				if (obj.val() == "") {
					obj.addClass("error-form");
					obj.focus();
					status = false;			
				}else{
					obj.removeClass("error-form");
				}
			// }
		});		

		return status;
	}

	function set_click_box_room(){
		$(".box-room-list").click(function(){
			var DataObj  = $(this).attr("vData");
			var jsData 	 = JSON.parse(DataObj);
			var sum_price = parseFloat( $("#sum_price").html() );

			if ($(this).attr('select') == "false") {
			  $(this).addClass("rm_active");
			  $(this).attr('select', "true");

			  
			  var str_html  = '';
			  	  str_html += '<tr id="tr_'+jsData.id+'">';
			  	  str_html += '		<td>'+jsData.type_room_name+'</td>';
			  	  str_html += '		<td>'+jsData.code+'</td>';
			  	  str_html += '		<td>'+jsData.name+'</td>';
			  	  str_html += '		<td> '+jsData.price+'</td>';
			  	  str_html += '</tr>';

			  $('#tb-list-room-book tbody').append(str_html);
			  sum_price += parseFloat(jsData.price);
			  // $('.number').FullnumOnly();
			}else{
			  $(this).removeClass("rm_active");
			  $(this).attr('select', "false");
			  $('#tr_' + jsData.id ).remove();
			  sum_price -= parseFloat(jsData.price);
			}


			if ($('#tb-list-room-book tbody tr').length > 0 ) {
				$('#tb-list-room-book').show();
				$('#box-book-detail').show();
			}else{ 
				$('#tb-list-room-book').hide();
				$('#box-book-detail').hide();
			}

			$("#sum_price").html( sum_price );
			
		});
	}

	function select_childen(){
		var qty = $("#slChilden").val();
		var str_html  = '';
		for (var i = 0; i < qty; i++) {
			str_html += '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">';
			str_html += '<select class="form-control" id="slChilden_'+i+'" name="slChilden" style="margin-top: 5px;">';
			// str_html += '	<option value="0"><?php echo $this->lang->line('no_childen'); ?></option>';
	    	<?php 
	    		for ($i=0; $i <= 17; $i++) { 
	    			echo 'str_html += "<option value=\''.$i.'\'>'.$i." ".$this->lang->line('years_old').'</option>";';
	    		}
	    	?>
			str_html += '</select>';
			str_html += '</div>';
		}	
		$("#box-year-childen").html(str_html);
	}

	function Save_data(){
		var str_room  = "";
		if ($("#txtCustomerID").val()=="") { alert("กรุณาเลือก ผู้เข้าพัก");  return false; }
		var aForm = {
			BookID 			: $("#txtBookID").val(),
			BookPrefix 		: $("#txtBookPrefix").val(),
			BookName 		: $("#txtBookName").val(),
			BookLastName 	: $("#txtBookLastName").val(),
			BookTel 		: $("#txtBookTel").val(),
			BookEmail 		: $("#txtBookEmail").val(),
			BookCustomerID 	: $("#txtBookCustomerID").val(),
			Prefix 			: $("#txtPrefix").val(),
			Name 			: $("#txtName").val(),
			LastName 		: $("#txtLastName").val(),
			Tel 			: $("#txtTel").val(),
			Email 			: $("#txtEmail").val(),
			CustomerID 		: $("#txtCustomerID").val(),
			Sum_price 		: $("#sum_price").html(),
			rBook 			: $('input:radio[name="rBook"]:checked').val(),
			CheckIn 		: $("#txtCheckIn").val(),
			CheckOut 		: $("#txtCheckOut").val(),
			GuestsQty 		: $("#txtGuestsQty").val(),
			ChildenQty 		: $("#slChilden").val(),
			RoomQty 		: $("#slRoom").val(),
			Childen 		: {}
		}

		var aRoom = new Array();
		var aChilden = new Array();
		var no = 0;	
		var aval = JSON.stringify( $("#form-search").serializeArray() );
			aval = jQuery.parseJSON( aval );	
		if (validate(aval)) {	
			$(".rm_active").each(function(){
				var js = $(this).attr("vData");
					js = jQuery.parseJSON(js);
				aRoom[no] =  js.id ;
				no++;
			});

			no = 0;
			$("select[name='slChilden']").each(function(){
				aChilden[no] =  $(this).val();
				no++;
			});


			aForm.Childen = aChilden;
			aForm.room = aRoom;
			$.get("book/save", aForm ,function( res ){
				res = jQuery.parseJSON( res ); 
				if (res.flag) {
					alert( res.msg );
					// get_data_list();
					// to_manage_data();
				}else{
					alert( res.msg );
				}
			});
		}
	}

	function clear_data(){
		$("#form-book input").val("");
		$("#rBook1").click()
		click_radio(true);
	}

	function search_customer(){
		var option = {
				customer_id 			: "",
				customer_typecard 		: $("#rTypeCardCustomer").val(),
				customer_cardnumber 	: $("#txtCustomerCardNumber").val(),
				customer_name 			: $("#txtCustomerName").val(),
				customer_lastname 		: $("#txtCustomerLastName").val(),
				page 			: page
			}
		$.get("customer/search_customer", option,function( aData ){
			aData = jQuery.parseJSON( aData );
			var str_html  = ""; 
			if ( Object.keys(aData).length > 1) {
				$.each(aData, function(k , v){
				var nation_name    = ($.cookie("Lang") == "th") ? v.ethnicity_th : v.ethnicity_en;
				var ethnicity_name = ($.cookie("Lang") == "th") ? v.nation_name_th : v.nation_name_en;
				if (k=="limit") { return; }
					str_html += '<tr onclick="sl_customer(\''+v.id+'\',\''+v.prefix+'\',\''+v.name+'\',\''+v.last_name+'\',\''+v.email+'\',\''+v.tel+'\')">'; 
					str_html += " <td>"+( parseInt(k)+1 )+"</td>"; 
					str_html += " <td>"+v.prefix+v.name+" "+v.last_name+"</td>"; 
					str_html += " <td>"+v.tel+"</td>";  
					str_html += " <td>"+v.email+"</td>";  
					str_html += " <td>"+nation_name+"</td>";  
					str_html += " <td>"+ethnicity_name+"</td>";  	
					str_html += " <td align='center'>";
					str_html += '	<i class="fa fa-search" style="font-size:20px"  id="cus_'+v.id+'" onclick="sl_customer(\''+v.id+'\',\''+v.prefix+'\',\''+v.name+'\',\''+v.last_name+'\',\''+v.email+'\',\''+v.tel+'\')"></i>';
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
		search_customer();
	}

	function to_page( number_page ){
		no_page = true;
		page 	= number_page;
		search_customer();
	}

	function previous( number_page ){
		if (number_page == 0) { return; }
		page = number_page;
		if (page < 1) { page = 1; }
		search_customer();
	}

	function sl_customer( id, prefix, name, last_name, email, tel ){
		if ($('input:radio[name="rBook"]:checked').val() == "someone") {
			$("#txtBookPrefix").val(prefix);
			$("#txtBookName").val(name);
			$("#txtBookLastName").val(last_name);
			$("#txtBookTel").val(tel);
			$("#txtBookEmail").val(email);
			$("#txtBookCustomerID").val(id);
		}else{
			$("#txtPrefix").val(prefix);
			$("#txtName").val(name);
			$("#txtLastName").val(last_name);
			$("#txtTel").val(tel);
			$("#txtEmail").val(email);
			$("#txtCustomerID").val(id);
			
		}

		$('#md-search-customer').modal('hide');
		
	}
</script>