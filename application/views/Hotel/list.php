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
</style>
<div class="row title_page">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h3 style="font-weight: bold;" class="lang_manage_hotel_data"><?php echo $title;?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
		<?php if ($_COOKIE[$keyword."level"] == "SA") { ?>
			<button type="button" class="btn btn-secondary" onclick="to_add_data( '0' )" id="btn-toadd_data" style="margin-top: 10px; width: 100px;"><?php echo $this->lang->line('add'); ?></button>
			<button type="button" class="btn btn-warning" onclick="to_manage_data()" id="btn-tomanage_data" style="margin-top: 10px; width: 100px; display: none;"><?php echo $this->lang->line('cancel'); ?></button>
		<?php } ?>
	</div>
</div>
<br>
<div id="box-show-search" <?php if ($_COOKIE[$keyword."level"] != "SA") { echo "style='display:none;'"; } ?> >
	<div class="box-search">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('hotel_code'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtHotelCode" class="form-control" name="txtHotelCode">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('name'); ?> <?php echo $this->lang->line('hotel'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtHotelName" class="form-control" name="txtHotelName">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('fullname_owner'); ?>  : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtHotelOwner" class="form-control" name="txtHotelOwner">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('quarter'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slHotelQuarter" name="slHotelQuarter" class="form-control" onchange="change_quarter('slHotelQuarter','slHotelProvince','slHotelAmphur')">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?>  </option>
					<?php 
						foreach ($quarter as $key => $value) {
							echo '<option value="'.$value->id.'">'.$value->name_th.'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('province'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slHotelProvince" name="slHotelProvince" class="form-control" onchange="change_province('slHotelQuarter','slHotelProvince','slHotelAmphur')">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?>  </option>
					<?php 
						foreach ($province as $key => $value) {
							echo '<option value="'.$value->id.'">'.$value->name.'</option>';
						}
					?>
				</select>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<?php echo $this->lang->line('amphur'); ?> :
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slHotelAmphur" name="slHotelAmphur" class="form-control">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?>  </option>
					<?php 
						foreach ($amphur as $key => $value) {
							echo '<option value="'.$value->id.'">'.$value->name.'</option>';
						}
					?>
				</select>
			</div>
		</div>
<!-- 		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				
			</div>
		</div> -->
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<button type="button" class="btn btn-primary" onclick="get_data_list()"><?php echo $this->lang->line('search'); ?></button>
				<button type="button" class="btn btn-warning" onclick="clear_data()"><?php echo $this->lang->line('clear'); ?></button>
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
						<th class="text-center"><?php echo $this->lang->line('code'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('name_th'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('name_en'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('fullname_owner'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('tel'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('email'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('quarter'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('province'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('amphur'); ?></th>
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
				<label class="" style="font-weight: bold;font-size: 16px;"><?php echo $this->lang->line('data_detail'); ?></label>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('hotel_code'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtCode" class="form-control" name="txtCode" disabled>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('fullname_owner'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtFullNameOwner" class="form-control" name="txtFullNameOwner">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('name_th'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtNameTH" class="form-control" name="txtNameTH">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('name_en'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtNameEN" class="form-control" name="txtNameEN">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('taxpayer_number'); ?></span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtNumberTax" class="form-control" name="txtNumberTax">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				
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
				<span><?php echo $this->lang->line('address'); ?> : </span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-9 col-xs-5">
				<textarea id="txtAddress" name="txtAddress" style="width: 100%;height: 70px;"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('quarter'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slQuarter" name="slQuarter" class="form-control" onchange="change_quarter('slQuarter','slProvince','slAmphur')">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
					<?php 
						foreach ($quarter as $key => $value) {
							echo '<option value="'.$value->id.'">'.$value->name_th.'</option>';
						}
					?>
				</select>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('province'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slProvince" name="slProvince" class="form-control" onchange="change_province('slQuarter','slProvince','slAmphur')">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?></option>
					<?php 
						foreach ($province as $key => $value) {
							echo '<option value="'.$value->id.'">'.$value->name.'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<?php echo $this->lang->line('amphur'); ?>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slAmphur" name="slAmphur" class="form-control"  onchange="change_amphur('slProvince','slAmphur','slDistrict')">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
					<?php 
						foreach ($amphur as $key => $value) {
							echo '<option value="'.$value->id.'">'.$value->name.'</option>';
						}
					?>
				</select>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('district'); ?></span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slDistrict" name="slDistrict" class="form-control">
					<option value=""> <?php echo $this->lang->line('sl_select'); ?> </option>
					<?php 
						foreach ($district as $key => $value) {
							echo '<option value="'.$value->id.'">'.$value->name.'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('postcode'); ?></span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtPostcode" class="form-control" name="txtPostcode">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('contact_other'); ?> : </span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-9 col-xs-5">
				<textarea id="txtContactOther" name="txtContactOther" style="width: 100%;height: 70px;"></textarea>
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
					<input type="text" id="txtHotelProfile" name="txtHotelProfile" value="0">
					<input type="text" id="txtHotel_id" name="txtHotel_id" value="0">
					<input type="text" id="txtHotel_code" name="txtHotel_code" value="">
				</div>
		</div>
		<hr style="margin: 0px;">
		<div class="row" style="margin-top: 5px">
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
					<th>ลำดับ</th>
					<th>สถานะ</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$str_html = "";
					if (count($status_hotel) > 0) {
						foreach ($status_hotel as $key => $value) {
							$str_html  .= "<tr>";
							$str_html  .= "	<td class='text-center'>".($key+1)."</td>";
							$str_html  .= "	<td><label style='cursor:pointer' onclick='chang_status(".$value->id.")'><input type='radio' id='rStatus".$value->id."' name='rStatus' value='".$value->id."' > &nbsp;".$value->name."</label></td>";
							$str_html  .= "</tr>";
						}
					}else{
						$str_html  .= "<tr>";
							$str_html  .= "	<td class='text-center' colspan='2'>".$this->lang->line("no_data")."</td>";
							$str_html  .= "</tr>";
					}
					echo $str_html;
				?>
				<tr>
					<td colspan="2">
						<span style="display: none;">
							<input type="text" name="txtStatus_hotel_id" id="txtStatus_hotel_id" value="0">
						</span>
					</td>
				</tr>
			</tbody>
         	</table>
      </div>
      <div class="modal-footer">
      	<!-- <button type="button" class="btn btn-success" id="btn-save-noapprove" onclick="save_noapprove()">บันทึก</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
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
				hotel_code 	: $("#txtHotelCode").val(),
				hotel_name 	: $("#txtHotelName").val(),
				hotel_owner : $("#txtHotelOwner").val(),
				quarter_id 	: $("#slHotelQuarter").val(),
				province_id : $("#slHotelProvince").val(),
				amphur_id 	: $("#slHotelAmphur").val(),
				page 			: page
			}
		$.get("hotel/search_hotel", option,function( aData ){
			aData = jQuery.parseJSON( aData );
			var str_html  = ""; 
			if ( Object.keys(aData).length > 1) {
				$.each(aData, function(k , v){
				if (k=="limit") { return; }
				var status = "";
					str_html += "<tr>"; 
					str_html += " <td>"+( parseInt(k)+1 )+"</td>"; 
					str_html += " <td>"+v.code+"</td>"; 
					str_html += " <td>"+v.name_th+"</td>"; 
					str_html += " <td>"+v.name_en+"</td>";
					str_html += " <td>"+v.fullname_owner+"</td>";  
					str_html += " <td>"+v.tel+"</td>";  
					str_html += " <td>"+v.email+"</td>";  
					str_html += " <td>"+v.quarter_name_th+"</td>";  
					str_html += " <td>"+v.province_name+"</td>";  
					str_html += " <td>"+v.amphur_name+"</td>";  
					str_html += " </td>"; 	
					str_html += " <td align='center'>";
					str_html += " 	<i class='fa fa-edit' style='font-size:20px' onclick='to_add_data("+v.id+")'></i>";
					str_html += " 	<i class='fa fa-exchange' style='font-size:20px' onclick='open_chang_status("+v.id+","+v.m_status_hotel_id+",\""+v.code+" "+v.name_th+"\")' title='เปลี่ยนสถานะพนักงาน'></i>";
					str_html += " </td>"; 	
					str_html += "</tr>"; 
					
				});

				if ($.cookie(keyword+"level") != "SA") { to_add_data(aData[0]["id"]);  }	
			}else{
				str_html += "<td colspan='10' class='text-center' style='color:red;margin-top:15px;'> ไม่พบข้อมูล </td>";
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

	function to_add_data( hotel_id = 0 ){ // เพิ่ม แก้ไข
		$("#txtHotel_id").val( hotel_id );
		$("#box-manage").show();
		$("#box-show-search").hide();
		$("#btn-toadd_data").hide();
		$("#btn-tomanage_data").show();

		if (hotel_id != 0) {
			$("#txtCode").prop('disabled', true);

			var option = {
				hotel_id 	: hotel_id
			}
			$.get("hotel/search_hotel", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				if ( Object.keys(aData).length > 1) {
					aData = aData[0];
					$("#txtHotel_code").val(aData.code);
					$("#txtCode").val(aData.code);
					$("#txtFullNameOwner").val(aData.fullname_owner);
					$("#txtNameTH").val(aData.name_th);
					$("#txtNameEN").val(aData.name_en);
					$("#txtNumberTax").val(aData.tax_number);
					$("#slQuarter option[value='"+aData.m_quarter_id+"']").prop('selected', true);
					$("#slProvince option[value='"+aData.m_province_id+"']").prop('selected', true);
					$("#slAmphur option[value='"+aData.m_amphur_id+"']").prop('selected', true);
					$("#slDistrict option[value='"+aData.m_district_id+"']").prop('selected', true);
					$("#txtPostcode").val(aData.postcode);
					$("#txtContactOther").val(aData.contact_other);
					$("#txtTel").val(aData.tel);
					$("#txtEmail").val(aData.email);
					$("#txtAddress").val(aData.address);
					$('input:radio[name="rTypeCard"][value="'+aData.type_card+'"]').prop('checked', true);
					
					$("#img").attr("src", aData.profile_img);
					$("#box-manage").css("width","100%");
				}else{
					alert( "no data" );
				}
			});
		}else{
			$("#txtCode").prop('disabled', true);
			$("#img").attr("src", "");
			clear_data();
			$("#txtHotel_id").val("0");
			$("#box-manage").css("width","100%");
		}

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
                    $("#txtHotelProfile").val( response );
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
			$.post("hotel/save_data",  aData  ,function( res ){
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
			if (v.name != "txtHotel_code" && v.name != "txtContactOther") {
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

	function open_chang_status( hotel_id, status ,text_title ){
		$("#txtStatus_hotel_id").val( hotel_id );
		$("#md-title").html( text_title );
		$("#modal-page").modal("show");
		setTimeout(function(){
			$('input:radio[name="rStatus"][value="'+status+'"]').prop('checked', true);
		},300);
		
	}

	var c_status = true;
	function chang_status( status ){
		if (c_status) {
			c_status = false;
			var id = $("#txtStatus_hotel_id").val();
			$.post("hotel/chang_status",  { hotel_id : id, status: status } ,function( res ){
				res = jQuery.parseJSON( res ); 
				if (res.flag) {
					$("#modal-page").modal("hide");
					alert( res.msg );
					get_data_list();
					c_status = true;
				}else{
					alert( res.msg );
					c_status = true;
				}

			});
		}
	}

	function change_quarter( idObj_Quarter, idObj_Province, idObj_Amphur  ){
		$("#"+idObj_Province+" option[value!='']").remove();
		$("#"+idObj_Amphur+" option[value!='']").remove();
		var quarter_id = $("#" + idObj_Quarter).val();
		var option = {
			quarter_id 	:  quarter_id
		}
		if (quarter_id != "") {
			$.get("hotel/search_provinces", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				$.each(aData, function(k ,v){
					$("#"+idObj_Province).append("<option value='"+v.id+"'>"+v.name+"</option>");
				});
			});
		}
	}

	function change_province( idObj_Quarter, idObj_Province, idObj_Amphur ){
		$("#"+idObj_Amphur+" option[value!='']").remove();
		var province_id = $("#" + idObj_Province).val();
		var quarter_id = $("#" + idObj_Quarter).val();
		var option = {
			quarter_id 	:  quarter_id,
			province_id 	:  province_id
		}
		if (quarter_id != "") {
			$.get("hotel/search_amphurs", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				$.each(aData, function(k ,v){
					$("#"+idObj_Amphur).append("<option value='"+v.id+"'>"+v.name+"</option>");
				});
			});
		}
	}

	function change_amphur( idObj_Province, idObj_Amphur, idObj_District ){
		$("#"+idObj_District+" option[value!='']").remove();
		var amphur_id   = $("#" + idObj_Amphur).val();
		var province_id = $("#" + idObj_Province).val();
		var option = {
			amphur_id 		:  amphur_id,
			province_id 	:  province_id
		}

		if (amphur_id != "") {
			$.get("hotel/search_districts", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				$.each(aData, function(k ,v){
					$("#"+idObj_District).append("<option value='"+v.id+"'>"+v.name+"</option>");
				});
			});
		}
	}
</script>
