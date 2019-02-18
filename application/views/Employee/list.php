<?php $path_assets = base_url()."assets/"; ?>
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
		<h3 style="font-weight: bold;"><?php echo $title;?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
		<button type="button" class="btn btn-secondary" onclick="to_add_data( '0' )" id="btn-toadd_data" style="margin-top: 10px; width: 100px;">เพิ่ม</button>
		<button type="button" class="btn btn-warning" onclick="to_manage_data()" id="btn-tomanage_data" style="margin-top: 10px; width: 100px; display: none;">ยกเลิก</button>
	</div>
</div>
<br>
<div id="box-show-search">
	<div class="box-search">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>รหัสพนักงาน : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtEmployeeCode" class="form-control" name="txtEmployeeCode">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>สถานะ : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slStatus_employee" name="slStatus_employee" class="form-control">
					<option value=""> -- เลือกแผนก -- </option>
					<?php  
						foreach ($status_employee as $key => $value) {
							echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ชื่อ : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtEmployeeName" class="form-control" name="txtEmployeeName">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>นามสกุล : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtEmployeeLastName" class="form-control" name="txtEmployeeLastName">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>แผนก : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slEmployeeDivision" name="slEmployeeDivision" class="form-control" onchange="change_division('slEmployeeDivision','slEmployeeDepartment','slEmployeePosition')">
					<option value=""> -- เลือกแผนก -- </option>
					<?php 
						foreach ($division as $key => $value) {
							echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
						}
					?>
				</select>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ฝ่าย : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slEmployeeDepartment" name="slEmployeeDepartment" class="form-control" onchange="change_department('slEmployeeDivision','slEmployeeDepartment','slEmployeePosition')">
					<option value=""> -- เลือกฝ่าย -- </option>
					<?php 
						foreach ($department as $key => $value) {
							echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				ตำแหน่ง
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slEmployeePosition" name="slEmployeePosition" class="form-control">
					<option value=""> -- เลือกตำแหน่ง -- </option>
					<?php 
						foreach ($position as $key => $value) {
							echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
						}
					?>
				</select>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<button type="button" class="btn btn-primary" onclick="get_data_list()">ค้นหา</button>
				<button type="button" class="btn btn-warning" onclick="clear_data()">Clear</button>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table class="table" id="tb-quo-list">
				<thead>
					<tr>
						<th class="text-center">ลำดับ</th>
						<th class="text-center">รหัสพนักงาน</th>
						<th class="text-center">แผนก</th>
						<th class="text-center">ฝ่าย</th>
						<th class="text-center">ตำแหน่ง</th>
						<th class="text-center">ชื่อ-นามสกุล</th>
						<th class="text-center">เบอร์โทรศัพท์</th>
						<th class="text-center">อีเมล์</th>
						<th class="text-center">สถานะ</th>
						<th class="text-center">จัดการ</th>
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
				<label class="" style="font-weight: bold; font-size: 16px;">ข้อมูลเข้าใช้ระบบ</label>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ชื่อเข้าใช้ระบบ : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtUsername" class="form-control" name="txtUsername" >
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>รหัสผ่าน : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="password" id="txtPassWord" class="form-control" name="txtPassWord">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ยืนยันรหัสผ่าน : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="password" id="txtRePassWord" class="form-control" name="txtRePassWord">
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<label class="" style="font-weight: bold;font-size: 16px;">ข้อมูลทั่วไป</label>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>รหัสพนักงาน : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtCode" class="form-control" name="txtCode" disabled>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>คำนำหน้า : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtPrefix" class="form-control" name="txtPrefix">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ชื่อ : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtName" class="form-control" name="txtName">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>นามสกุล : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtLastName" class="form-control" name="txtLastName">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>แผนก : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slDivision" name="slDivision" class="form-control" onchange="change_division('slDivision','slDepartment','slPosition')">
					<option value=""> -- เลือกแผนก -- </option>
					<?php 
						foreach ($division as $key => $value) {
							echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
						}
					?>
				</select>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ฝ่าย : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slDepartment" name="slDepartment" class="form-control" onchange="change_department('slDivision','slDepartment','slPosition')">
					<option value=""> -- เลือกฝ่าย -- </option>
					<?php 
						foreach ($department as $key => $value) {
							echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				ตำแหน่ง
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slPosition" name="slPosition" class="form-control">
					<option value=""> -- เลือกตำแหน่ง -- </option>
					<?php 
						foreach ($position as $key => $value) {
							echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
						}
					?>
				</select>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>วันเดือนปีเกิด</span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtBirthday" class="form-control datepicker" name="txtBirthday">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-10 text-right">
				<label class="form-check-label"><input type="radio" class="form-check-input" id="rTypeCard1" name="rTypeCard" value="1" checked="checked"> บัตรประชาชน</label>
				&nbsp;&nbsp;
				<label class="form-check-label"> <input type="radio" class="form-check-input" id="rTypeCard2" name="rTypeCard" value="2"> พาสปอร์ต</label>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>เลขที่บัตร : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtCardNumber" class="form-control" name="txtCardNumber">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>เบอร์โทร : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtTel" class="form-control" name="txtTel">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>อีเมล์ : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtEmail" class="form-control" name="txtEmail">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ที่อยู่ : </span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-9 col-xs-5">
				<textarea id="txtAddress" name="txtAddress" style="width: 100%;height: 70px;"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>รูปโปรไฟล์ : </span>
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
					<input type="text" id="txtEmployeeProfile" name="txtEmployeeProfile" value="0">
					<input type="text" id="txtEmployee_id" name="txtEmployee_id" value="0">
					<input type="text" id="txtEmployee_code" name="txtEmployee_code" value="">
				</div>
		</div>
		<hr style="margin: 0px;">
		<div class="row" style="margin-top: 5px">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<button type="button" class="btn btn-primary" onclick="save_data()">บันทึก</button>
				<button type="button" class="btn btn-warning" onclick="clear_data()">ล้าง</button>
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
					foreach ($status_employee as $key => $value) {
						$str_html  .= "<tr>";
						$str_html  .= "	<td class='text-center'>".($key+1)."</td>";
						$str_html  .= "	<td><label style='cursor:pointer' onclick='chang_status(".$value['id'].")'><input type='radio' id='rStatus".$value["id"]."' name='rStatus' value='".$value['id']."' > &nbsp;".$value["name"]."</label></td>";
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
				employee_id 	: "",
				employee_code 	: $("#txtEmployeeCode").val(),
				employee_name 	: $("#txtEmployeeName").val(),
				employee_lastname : $("#txtEmployeeLastName").val(),
				position_id 	: $("#slEmployeePosition").val(),
				department_id 	: $("#slEmployeeDepartment").val(),
				division_id 	: $("#slEmployeeDivision").val(),
				employee_status : $("#slStatus_employee").val(),
				page 			: page
			}
		$.get("employee/search_employee", option,function( aData ){
			aData = jQuery.parseJSON( aData );
			var str_html  = ""; 
			if ( Object.keys(aData).length > 1) {
				$.each(aData, function(k , v){
				if (k=="limit") { return; }
				var status = "";
				switch (v.m_status_employee_id) {
					case '1': status = '<span style="color:#000;">'+v.status_name+'</span>';break;
					case '2': status = '<span style="color:blue;">'+v.status_name+'</span>';break;
					case '3': status = '<span style="color:green;">'+v.status_name+'</span>';break;
					case '4': status = '<span style="color:#cc8b0d;">'+v.status_name+'</span>';break;
					case '5': status = '<span style="color:red;">'+v.status_name+'</span>';break;
				}
					str_html += "<tr>"; 
					str_html += " <td>"+( parseInt(k)+1 )+"</td>"; 
					str_html += " <td>"+v.code+"</td>"; 
					str_html += " <td>"+v.division_name+"</td>"; 
					str_html += " <td>"+v.department_name+"</td>";
					str_html += " <td>"+v.position_name+"</td>";  
					str_html += " <td>"+v.prefix+v.name+" "+v.last_name+"</td>"; 
					str_html += " <td>"+v.tel+"</td>";  
					str_html += " <td>"+v.email+"</td>";  
					str_html += " <td>"+status+"</td>";  
					str_html += " </td>"; 	
					str_html += " <td align='center'>";
					str_html += " 	<i class='fa fa-edit' style='font-size:20px' onclick='to_add_data("+v.id+")'></i>";
					str_html += " 	<i class='fa fa-exchange' style='font-size:20px' onclick='open_chang_status("+v.id+","+v.m_status_employee_id+",\""+v.code+" "+v.prefix+v.name+" "+v.last_name+"\")' title='เปลี่ยนสถานะพนักงาน'></i>";
					str_html += " </td>"; 	
					str_html += "</tr>"; 

					
					
				});

				
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

	function to_add_data( employee_id = 0 ){ // เพิ่ม แก้ไข
		$("#txtEmployee_id").val( employee_id );
		$("#box-manage").show();
		$("#box-show-search").hide();
		$("#btn-toadd_data").hide();
		$("#btn-tomanage_data").show();
		$("#box-manage").css("width","100%");

		if (employee_id != 0) {
			$("#txtUsername").prop('disabled', true);
			$("#txtPassWord").prop('disabled', true);
			$("#txtRePassWord").prop('disabled', true);
			$("#txtCode").prop('disabled', true);
			$("#txtUsername").prop('disabled', true);

			var option = {
				employee_id 	: employee_id
			}
			$.get("employee/search_employee", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				if ( Object.keys(aData).length > 1) {
					aData = aData[0];
					$("#txtUsername").val(aData.username);
					$("#txtPassWord").val(aData.password);
					$("#txtRePassWord").val(aData.password);
	
					$("#txtEmployee_code").val(aData.code);
					$("#txtCode").val(aData.code);
					$("#txtPrefix").val(aData.prefix);
					$("#txtName").val(aData.name);
					$("#txtLastName").val(aData.last_name);
					$("#txtBirthday").val(aData.birthday);
					$("#slDivision option[value='"+aData.m_division_id+"']").prop('selected', true);
					$("#slDepartment option[value='"+aData.m_department_id+"']").prop('selected', true);
					$("#slPosition option[value='"+aData.m_position_id+"']").prop('selected', true);
					$("#txtCardNumber").val(aData.id_card);
					$("#txtTel").val(aData.tel);
					$("#txtEmail").val(aData.email);
					$("#txtAddress").val(aData.address);
					$('input:radio[name="rTypeCard"][value="'+aData.type_card+'"]').prop('checked', true);
					
					$("#img").attr("src", aData.profile_img);

				}else{
					alert( "no data" );
				}
			});
		}else{
			$("#txtUsername").prop('disabled', false);
			$("#txtPassWord").prop('disabled', false);
			$("#txtRePassWord").prop('disabled', false);
			$("#txtCode").prop('disabled', true);
			$("#txtUsername").prop('disabled', true);
			$("#img").attr("src", "");
			clear_data();
			$("#txtEmployee_id").val("0");
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
            url: 'employee/upload',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    $("#img").attr("src",response); 
                    $("#txtEmployeeProfile").val( response );
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
			$.post("employee/save_data",  aData  ,function( res ){
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
			if (v.name != "txtEmployee_code") {
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
			$("#txtPassWord").removeClass("error-form");
			$("#txtRePassWord").removeClass("error-form");
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
	function chang_status( status ){
		if (c_status) {
			c_status = false;
			var id = $("#txtStatus_employee_id").val();
			$.post("employee/chang_status",  { employee_id : id, status: status } ,function( res ){
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
</script>
