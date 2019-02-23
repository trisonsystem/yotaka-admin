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
				<span>ฝ่าย : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slName_Division" name="slName_Division" class="form-control" onchange="change_division('slName_Division','slCode_department','slName_department')">
					<option value=""> -- เลือกฝ่าย -- </option>
					<?php 
						foreach ($division as $key => $value) {
							echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
						}
					?>
				</select>
			</div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>รหัสแผนก : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
            <select id="slCode_department" name="slCode_department" class="form-control">
					<option value=""> -- เลือกรหัสแผนก -- </option>
					<?php  
						foreach ($department as $key => $value) {
							echo '<option value="'.$value["code"].'">'.$value["code"].'</option>';
						}
					?>
				</select>
			</div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>แผนก : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slName_department" name="slName_department" class="form-control">
					<option value=""> -- เลือกแผนก -- </option>
					<?php  
						foreach ($department as $key => $value) {
							echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
						}
					?>
				</select>
			</div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>สถานะ : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slStatus_department" name="slStatus_department" class="form-control">
					<option value=""> -- เลือกสถานะ -- </option>
					<option value="1">ใช้งาน</option>
                    <option value="9">ไม่ได้ใช้งาน</option>
				</select>
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

        
	<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table class="table" id="tb-quo-list">
				<thead>
					<tr>
						<th class="text-center">ลำดับ</th>
						<th class="text-center">รหัสแผนก</th>
						<th class="text-center">แผนก</th>
						<th class="text-center">ฝ่าย</th>
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

<script type="text/javascript">
	var page = 1;
	var no_page = false;
	$(document).ready(function() {
		get_data_list();
    });
    
    function get_data_list(){
        var option = {
            m_division_id   : $("#slName_Division").val(),
            code    : $("#slCode_department").val(),
            name    : $("#slName_department").val(),
            status  : $("#slStatus_department").val(),
            page 			: page
        }
        $.get("department/search_department", option,function( aData ){
            aData = jQuery.parseJSON( aData );
            // var str_html  = "";
            // if ( Object.keys(aData).length > 1) {
            //     $.each(aData, function(k , v){
            //         if (k=="limit") { return; }
			// 		var status = "";
			// 		switch (v.status) {
			// 			case '1': status = '<span style="color:#000;">ใช้งาน</span>';break;
			// 			case '9': status = '<span style="color:red;">ไม่ใช้งาน</span>';break;
            //         }
            //         str_html += "<tr>";
			// 		str_html += " <td>"+( parseInt(k)+1 )+"</td>";
			// 		str_html += " <td>"+v.code+"</td>";
            //         str_html += " <td>"+v.name+"</td>";
            //         str_html += " <td>"+v.division_name+"</td>";
			// 		str_html += " <td>"+status+"</td>";	
			// 		str_html += " <td align='center'>";
			// 		str_html += " 	<i class='fa fa-edit' style='font-size:20px' onclick='to_add_data("+v.id+")'></i>";
			// 		str_html += " 	<i class='fa fa-exchange' style='font-size:20px' onclick='open_chang_status("+v.id+","+v.status+",\""+v.code+" "+v.name+"\")' title='เปลี่ยนสถานะพนักงาน'></i>";
			// 		str_html += " </td>"; 	
			// 		str_html += "</tr>";
            //     });
            // }else{
            //     str_html += "<td colspan='10' class='text-center' style='color:red;margin-top:15px;'> ไม่พบข้อมูล </td>";
            // }

            // $("#tb-div-list tbody").html( str_html );
			// var len = Object.keys(aData).length - 1;
			// len = ( aData.limit == len ) ? true : false;
			// set_number_page( len );
        });
    }
    // onchange="change_division('slName_Division','slCode_department','slName_department')"
    function change_division( idObj_Division, idObj_Code_Department, idObj_Name_Department ){
        $("#"+idObj_Code_Department+" option[value!='']").remove();
        $("#"+idObj_Name_Department+" option[value!='']").remove();
        var division_id = $("#" + idObj_Division).val();
        var option = {
			division_id 	:  division_id
        }
        if (division_id != "") {
			$.get("department/search_departments", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				$.each(aData, function(k ,v){
                    $("#"+idObj_Code_Department).append("<option value='"+v.code+"'>"+v.code+"</option>");
                    $("#"+idObj_Name_Department).append("<option value='"+v.name+"'>"+v.name+"</option>");
				});
			});
		}
    }
</script>