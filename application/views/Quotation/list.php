<?php $path_assets = base_url()."assets/"; ?>
<div class="title_page">
	<h1><?php echo $title;?></h1>
</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<table class="table" id="tb-quo-list">
			<thead>
				<tr>
					<th>ลำดับ</th>
					<th>เลขที่ใบเสนอสินค้า</th>
					<th>สินค้า</th>
					<th>สถานะ</th>
					<th>ผู้สร้าง</th>
					<th>วันที่สร้าง</th>
					<th>พิมพ์</th>
					<th>อนุมัติ</th>
					<th>จัดการ</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="md-pd-list">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-quotation-title"></h5>
      </div>
      <div class="modal-body" id="md-pd-list-body">
      		<div class="row">
      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>
      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="text-align: right;">วันที่ : <span id="sp_datecreate"></span></div>
      		</div>
         	<table class="table" id="tb-pd-list">
         		<thead>
				<tr>
					<th>ลำดับ</th>
					<th>สินค้า</th>
					<th>จำนวน</th>
				</tr>
			</thead>
			<tbody></tbody>
         	</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="md-no-approve">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-title-no-approve"></h5>
      </div>
      <div class="modal-body" >
         	<textarea id="txt-no-approve" style="  height: 150px;  width: 100%;"></textarea>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-success" id="btn-save-noapprove" onclick="save_noapprove()">บันทึก</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo $path_assets?>css/Quotation.css">
<script type="text/javascript">
	$(document).ready(function() {
		get_data_list();
	});

	function get_data_list(){
		$.get("manage_quotation/get_quotation_list",{},function( aData ){
			aData = jQuery.parseJSON( aData );
			var str_html  = ""; 
			$.each(aData, function(k , v){
			var status = "";
			switch (v.status) {
				case '0': status = '<span style="color:#000;">กำลังสร้าง</span>';break;
				case '1': status = '<span style="color:blue;">อนุมัติ</span>';break;
				case '2': status = '<span style="color:#cc8b0d;">ยกเลิกรอการแก้ไข</span>';break;
				case '3': status = '<span style="color:green;">แก้ไขรอการอนุมัติ</span>';break;
				case '99': status = '<span style="color:red;">ยกเลิก</span>';break;
			}
				str_html += "<tr>"; 
				str_html += " <td>"+( k+1 )+"</td>"; 
				str_html += " <td>"+v.doc_no+"</td>"; 
				str_html += " <td><a onclick='open_detail_pd("+v.id+",\""+v.doc_no+"\",\""+v.create_date+"\")'>สินค้า รายละเอียด</td>"; 
				str_html += " <td>"+status+"</td>";
				str_html += " <td>"+v.create_by+"</td>";  
				str_html += " <td>"+v.create_date+"</td>"; 
				str_html += " <td align='center'><i class='fa fa-print' style='font-size:20px' onclick='export_to_pdf("+v.id+")'></i></td>"; 
				str_html += " <td align='center'>";
				if( v.status == "0" || v.status == "3"){
					str_html += " 	<i class='fa fa-check-circle' style='font-size:20px' onclick='approve("+v.id+")'></i>";
					str_html += " 	<i class='fa fa-exclamation-circle' style='font-size:20px' onclick='no_approve("+v.id+")'></i>";
				}
				str_html += " </td>"; 	
				str_html += " <td align='center'>";
				str_html += " 	<i class='fa fa-edit' style='font-size:20px' onclick='edit_quotation("+v.id+")'></i>";
				str_html += " 	<i class='fa fa-remove' style='font-size:20px' onclick='delete_quotation("+v.id+")'></i>";
				str_html += " </td>"; 	
				str_html += "</tr>"; 
			});
			$("#tb-quo-list tbody").html( str_html );
			console.log( aData );
		});
	}

	function open_detail_pd(id, doc_no, create_date){
		var str_html  = ""; 
		$.get("manage_quotation/get_quotation_pd_list",{ quotation_id : id },function( aData ){
			aData = jQuery.parseJSON( aData );
			$.each(aData, function(k , v){
				str_html += "<tr>"; 
				str_html += " <td align='center'>"+( k+1 )+"</td>"; 
				str_html += " <td>"+v.product_name+"</td>"; 
				str_html += " <td align='left'>"+v.qty+"</td>"; 
				str_html += "</tr>"; 
			});

			$("#tb-pd-list tbody").html( str_html );
			$("#sp_datecreate").html( create_date );
			$("#md-pd-list").modal("show");


		});

		$("#md-quotation-title").html( "เลขที่ใบเสนอสินค้า " + doc_no );
	}

	function export_to_pdf(id){
		alert(id);
	}

	function delete_quotation(id){
		if (confirm("ยืนยันการลบข้อมูล")) {
			$.post("manage_quotation/delete",  { quotation_id : id } ,function( res ){
				res = jQuery.parseJSON( res ); 
				if (res.flag) {
					alert( res.msg );
					getMenu('manage_quotation/quotation_list');
				}else{
					alert( res.msg );
				}

			});
		}
	}

	function approve(id){
		$.post("manage_quotation/approve",  { quotation_id : id } ,function( res ){
			res = jQuery.parseJSON( res ); 
			if (res.flag) {
				alert( res.msg );
				getMenu('manage_quotation/quotation_list');
			}else{
				alert( res.msg );
			}

		});
	}

	function no_approve(id){
		$("#btn-save-noapprove").attr("data", id);
		$("#md-title-no-approve").html("<span style='color:red;'>ไม่อนุมัติเพาะ</span>");
		$("#txt-no-approve").html("");
		$("#md-no-approve").modal("show");
		
	}

	function save_noapprove(){
		var quotation_id = $("#btn-save-noapprove").attr("data");
		$.post("manage_quotation/no_approve",  { quotation_id : quotation_id, remark : $("#txt-no-approve").html() } ,function( res ){
			res = jQuery.parseJSON( res ); 
			if (res.flag) {
				alert( res.msg );
				getMenu('manage_quotation/quotation_list');
			}else{
				alert( res.msg );
			}

		});
	}

	function edit_quotation(id){
		getMenu('manage_quotation/edit_quotation/' + id);
	}
</script>
