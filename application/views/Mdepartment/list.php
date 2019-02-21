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
			<?php // debug($division); ?>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>รหัสแผนก : </span>
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
