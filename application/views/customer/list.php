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
	.form-check-input{ cursor: pointer; }
	.error-form{ 
		border: 1px solid red !important;
	}
	.title_page{border-bottom: 1px solid #D9D9D9}
	.select2{ width: 100% !important; }
</style>
<script type="text/javascript" src="<?php echo $path_assets;?>/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $path_assets;?>/css/select2.min.css">
<div class="row title_page">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h3 class="lang_manage_employee_data" style="font-weight: bold;"><?php echo $title; ?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
		<button type="button" class="btn btn-secondary lang_add" onclick="to_add_data( '0' )" id="btn-toadd_data" style="margin-top: 10px; width: 100px;"><?php echo $this->lang->line('add'); ?></button>
		<button type="button" class="btn btn-warning lang_cancel" onclick="to_manage_data()" id="btn-tomanage_data" style="margin-top: 10px; width: 100px; display: none;"><?php echo $this->lang->line('cancel'); ?></button>
	</div>
</div>
<br>
<div id="box-show-search">
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

<!-- ###################################### Manage  ######################################-->

<div id="box-manage" style="display: none;">
	<form id="form-manage" name="form-manage" method="post" action="" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<label class="" style="font-weight: bold; font-size: 16px;"><?php echo $this->lang->line('data_system'); ?></label>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('use_system'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<label class="form-check-label" onclick="change_use('use');"><input type="radio" class="form-check-input" id="rUseSystem1" name="rUseSystem" value="1" > <?php echo $this->lang->line('use'); ?></label>
				&nbsp;&nbsp;
				<label class="form-check-label" onclick="change_use('no_use');"> <input type="radio" class="form-check-input" id="rUseSystem2" name="rUseSystem" value="2" checked="checked"> <?php echo $this->lang->line('use_no'); ?></label>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('username'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtUsername" class="form-control" name="txtUsername" disabled="disabled">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('password'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="password" id="txtPassWord" class="form-control" name="txtPassWord" disabled="disabled">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('confirm_password'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="password" id="txtRePassWord" class="form-control" name="txtRePassWord" disabled="disabled">
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<label class="" style="font-weight: bold;font-size: 16px;"><?php echo $this->lang->line('data_detail'); ?></label>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('prefix'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtPrefix" class="form-control" name="txtPrefix">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('name'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtName" class="form-control" name="txtName">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('last_name'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtLastName" class="form-control" name="txtLastName">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('birthday'); ?></span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtBirthday" class="form-control datepicker" name="txtBirthday">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-10 text-right">
				<label class="form-check-label"><input type="radio" class="form-check-input" id="rTypeCard1" name="rTypeCard" value="1" checked="checked"> <?php echo $this->lang->line('identification_card'); ?></label>
				&nbsp;&nbsp;
				<label class="form-check-label"> <input type="radio" class="form-check-input" id="rTypeCard2" name="rTypeCard" value="2"> <?php echo $this->lang->line('passport'); ?></label>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('number_card'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtCardNumber" class="form-control" name="txtCardNumber">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('tel'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtTel" class="form-control" name="txtTel">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('email'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtEmail" class="form-control" name="txtEmail">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('ethnicity'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slEthnicity" name="slEthnicity" class="select2">
					<option value=""> <?php echo $this->lang->line('sl_select');  ?> </option>
					<?php  
						foreach ($country as $key => $value) {
							$name = ($_COOKIE[$keyword."Lang"] == "th") ? $value->country_name_th : $value->country_name_en;
							echo '<option value="'.$value->id.'">'.$name.'</option>';
						}
					?>
				</select>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('nationality'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slNationality" name="slNationality" class="select2">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
					<?php  
						foreach ($country as $key => $value) {
							$name = ($_COOKIE[$keyword."Lang"] == "th") ? $value->nation_name_th : $value->nation_name_en;
							echo '<option value="'.$value->id.'">'.$name.'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('address'); ?> : </span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-9 col-xs-5">
				<textarea id="txtAddress" name="txtAddress" style="width: 100%;height: 70px;"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('profile_image'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="file" name="fProfile" id="fProfile" onchange="change_img()">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<img id="img" width="250px" style="margin-bottom: 10px;"></div>

				<div style="display: none;">
					<input type="text" id="txtCustomerProfile" name="txtCustomerProfile" value="0">
					<input type="text" id="txtCustomer_id" name="txtCustomer_id" value="0">
					<input type="text" id="txtCustomer_code" name="txtCustomer_code" value="">
				</div>
		</div>
		<hr style="margin: 0px;">
		<div class="row" style="margin-top: 5px;margin-bottom: 30px;">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<button type="button" class="btn btn-primary" onclick="save_data()"><?php echo $this->lang->line('save'); ?></button>
				<button type="button" class="btn btn-warning" onclick="clear_data()"><?php echo $this->lang->line('clear'); ?></button>
			</div>
		</div>
	</form>
</div>
<!-- ###################################### Manage  ######################################-->


<div class="modal" tabindex="-1" role="dialog" id="modal-page">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-title"></h5>
      </div>
      <div class="modal-body">
         	<table class="table" id="tb-status-list">
         		<thead>
				<tr>
					<th><?php echo $this->lang->line('no'); ?></th>
					<th><?php echo $this->lang->line('status'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$str_html = "";
					foreach ($status_employee as $key => $value) {
						$str_html  .= "<tr>";
						$str_html  .= "	<td class='text-center'>".($key+1)."</td>";
						$str_html  .= "	<td><label style='cursor:pointer' onclick='chang_status(".$value->id.")'><input type='radio' id='rStatus".$value->id."' name='rStatus' value='".$value->id."' > &nbsp;".$value->name."</label></td>";
						$str_html  .= "</tr>";
					}
					echo $str_html;
				?>
				<tr>
					<td colspan="2">
						<span style="display: none;">
							<input type="text" name="txtStatus_employee_id" id="txtStatus_employee_id" value="0">
						</span>
					</td>
				</tr>
			</tbody>
         	</table>
      </div>
      <div class="modal-footer">
      	<!-- <button type="button" class="btn btn-success" id="btn-save-noapprove" onclick="save_noapprove()">บันทึก</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	var page = 1;
	var no_page = false;
	$(document).ready(function() {
		get_data_list();
	});

	function get_data_list(){
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
					str_html += "<tr>"; 
					str_html += " <td>"+( parseInt(k)+1 )+"</td>"; 
					str_html += " <td>"+v.prefix+v.name+" "+v.last_name+"</td>"; 
					str_html += " <td>"+v.tel+"</td>";  
					str_html += " <td>"+v.email+"</td>";  
					str_html += " <td>"+nation_name+"</td>";  
					str_html += " <td>"+ethnicity_name+"</td>";  	
					str_html += " <td align='center'>";
					str_html += " 	<i class='fa fa-edit' style='font-size:20px' onclick='to_add_data("+v.id+")'></i>";
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
	}

	function to_manage_data(){ //หน้า listdata
		$("#box-manage").hide();
		$("#box-show-search").show();
		$("#btn-toadd_data").show();
		$("#btn-tomanage_data").hide();
		$("#box-manage").css("width","0");
	}

	function to_add_data( customer_id = 0 ){ // เพิ่ม แก้ไข
		$("#txtCustomer_id").val( customer_id );
		$("#box-manage").show();
		$("#box-show-search").hide();
		$("#btn-toadd_data").hide();
		$("#btn-tomanage_data").show();
		$("#box-manage").css("width","100%");

		if (customer_id != 0) {
			change_use("no_use");
			$('input:radio[name="rTypeCardCustomer"]').prop('disabled', true);

			var option = {
				customer_id 	: customer_id
			}
			$.get("customer/search_customer", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				if ( Object.keys(aData).length > 1) {
					aData = aData[0];
					if (aData.user_system == "1") {
						change_use("use");
						$('input:radio[name="rUseSystem"][value="1"]').prop('checked', true);
					}else{
						$('input:radio[name="rUseSystem"][value="2"]').prop('checked', true);
					}

					$("#txtUsername").val(aData.username);
					$("#txtPassWord").val(aData.password);
					$("#txtRePassWord").val(aData.password);

					$("#txtCode").val(aData.code);
					$("#txtPrefix").val(aData.prefix);
					$("#txtName").val(aData.name);
					$("#txtLastName").val(aData.last_name);
					$("#txtBirthday").val(aData.birthday);
					$("#txtCardNumber").val(aData.id_card);
					$("#txtTel").val(aData.tel);
					$("#txtEmail").val(aData.email);
					$("#txtAddress").val(aData.address);
					$('input:radio[name="rTypeCard"][value="'+aData.type_card+'"]').prop('checked', true);
					$("#txtCustomerProfile").val(aData.profile_img);
					$("#img").attr("src", aData.profile_img);

					$('#slEthnicity').val(aData.ethnicity).trigger('change');
					$('#slNationality').val(aData.nationality).trigger('change');
				}else{
					alert( "no data" );
				}
			});
		}else{
			change_use("no_use");
			$("#img").attr("src", "");
			clear_data();
			$("#txtCustomer_id").val("0");
		}

		$(".select2").select2();
		$('.datepicker').datepicker({format: 'dd-mm-yyyy'});
	}

	function select_photo(){

	}

	function search_data(){
		page 	= 1;
		no_page = true;
		get_data_list();
	}


	function change_img(){
        var fd = new FormData();
        var files = $('#fProfile')[0].files[0];
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
                    $("#txtCustomerProfile").val( response );
                    // $(".preview img").show(); // Display image element
                }else{
                    alert('file not uploaded');
                }
            },
        });
	}

	function save_data(){
		var aData = JSON.stringify( $("#form-manage").serializeArray() );
			aData = jQuery.parseJSON( aData );
		if (validate(aData)) {
			$.post("customer/save_data",  aData  ,function( res ){
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

	function validate(aData){ 
		var status = true;
		$.each(aData,function(k,v){
			if (v.name != "txtCustomer_code") {
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

		if ($("#txtPassWord").val() != $("#txtRePassWord").val()) {
			$("#txtPassWord").addClass("error-form");
			$("#txtRePassWord").addClass("error-form");
			$("#txtPassWord").focus();
			alert("!Password Not Match");
			status = false;
		}else{
			if ($("#txtPassWord").val() != "") {
				$("#txtPassWord").removeClass("error-form");
				$("#txtRePassWord").removeClass("error-form");
			}
		}

		return status;
	}

 	function change_use( type ){
 		if (type == "use") {
 			$("#txtUsername").prop('disabled', false);
			$("#txtPassWord").prop('disabled', false);
			$("#txtRePassWord").prop('disabled', false);
 		}else{
 			$("#txtUsername").prop('disabled', true);
			$("#txtPassWord").prop('disabled', true);
			$("#txtRePassWord").prop('disabled', true);
 		}
 	}
</script>
