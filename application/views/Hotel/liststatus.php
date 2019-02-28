<?php $path_assets = base_url() . "assets/"; ?>
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
		<h3 style="font-weight: bold;"><?php echo $title; ?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
		<button type="button" class="btn btn-secondary" onclick="to_add_data( '0', '0' )" id="btn-toadd_data" style="margin-top: 10px; width: 100px;">เพิ่ม</button>
		<button type="button" class="btn btn-warning" onclick="to_manage_data()" id="btn-tomanage_data" style="margin-top: 10px; width: 100px; display: none;">ยกเลิก</button>
	</div>
</div>
<br>
<div id="box-show-search">
	<div class="box-search">
		<?php // debug($division); ?>		
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>สถานะโรงแรม : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                <input type="text" id="txtHotelStatusName" class="form-control" name="txtHotelStatusName">
			</div>			
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
                <span>สถานะ : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slStatus_hotelstatus" name="slStatus_hotelstatus" class="form-control">
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
				<button type="button" class="btn btn-primary lang_save" onclick="get_data_list()"><?php echo $this->lang->line('search'); ?></button>
				<button type="button" class="btn btn-warning lang_clear" onclick="clear_data()"><?php echo $this->lang->line('clear'); ?></button>
			</div>
		</div>	
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table class="table" id="tb-div-list">
				<thead>
					<tr>
						<th class="text-center">ลำดับ</th>
						<th class="text-center">สถานะพนักงาน</th>						
						<th class="text-center" width="10%">สถานะการใช้งาน</th>	
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
				<label class="" style="font-weight: bold;font-size: 16px;">ข้อมูลสถานะโรงแรม</label>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>สถานะโรงแรม : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                <input type="text" id="etxtHotelStatusName" class="form-control" name="etxtHotelStatusName">
			</div>			
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
                
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<div style="display: none;">
					<input type="text" id="txtHotelStatus_id" name="txtHotelStatus_id" value="0">
					<input type="text" id="txtHotelStatus_status" name="txtHotelStatus_status" value="">
				</div>
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
						<tr>
							<td class='text-center'>1</td>
							<td><label style='cursor:pointer' onclick='chang_status(1)'><input type='radio' id='rStatus1' name='rStatus' value='1' > &nbsp;ใช้งาน</label></td>
						</tr>
						<tr>
							<td class='text-center'>2</td>
							<td><label style='cursor:pointer' onclick='chang_status(9)'><input type='radio' id='rStatus9' name='rStatus' value='9' > &nbsp;ไม่ใช้งาน</label></td>
						</tr>
						<tr>
							<td colspan="2">
								<span style="display: none;">
									<input type="text" name="txtStatus_hotelstatus_id" id="txtStatus_hotelstatus_id" value="0">
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
        	hotelstatus_id  	: "",            
            hotelstatus_name    : $("#txtHotelStatusName").val(), 
            hotelstatus_status    : $("#slStatus_hotelstatus").val(),           
            page 	: page
        }

        $.get("hotelstatus/search_hotelstatus", option,function( aData ){
            aData = jQuery.parseJSON( aData );
            // console.log(aData);
            var str_html  = "";
            if ( Object.keys(aData).length > 1) {
                $.each(aData, function(k , v){
                    if (k=="limit") { return; }
					var status = "";
					switch (v.status) {
						case '1': status = '<span style="color:#000;">ใช้งาน</span>';break;
						case '9': status = '<span style="color:red;">ไม่ใช้งาน</span>';break;
                    }
                    str_html += "<tr>";
					str_html += " <td>"+( parseInt(k)+1 )+"</td>";
                    str_html += " <td>"+v.name+"</td>";
                    str_html += " <td>"+status+"</td>";
					str_html += " <td align='center'>";
					str_html += " 	<i class='fa fa-edit' style='font-size:20px' onclick='to_add_data("+v.id+","+v.status+")'></i>";
					str_html += " 	<i class='fa fa-exchange' style='font-size:20px' onclick='open_chang_status("+v.id+","+v.status+",\""+v.name+"\")' title='เปลี่ยนสถานะพนักงาน'></i>";
					str_html += " </td>"; 	
					str_html += "</tr>";
                });
            }else{
                str_html += "<td colspan='10' class='text-center' style='color:red;margin-top:15px;'> ไม่พบข้อมูล </td>";
            }

            $("#tb-div-list tbody").html( str_html );
			var len = Object.keys(aData).length - 1;
			len = ( aData.limit == len ) ? true : false;
			set_number_page( len );
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

	function to_add_data( hotelstatus_id = 0, hotelstatus_status){ // เพิ่ม แก้ไข				
		$("#txtHotelStatus_id").val( hotelstatus_id );
		$("#txtHotelStatus_status").val( hotelstatus_status );
		$("#box-manage").show();
		$("#box-show-search").hide();
		$("#btn-toadd_data").hide();
		$("#btn-tomanage_data").show();
		$("#box-manage").css("width","100%");

		if (hotelstatus_id != 0) {			
			var option = {
				hotelstatus_id 	: hotelstatus_id
			}
			$.get("hotelstatus/search_hotelstatus", option,function( aData ){
				aData = jQuery.parseJSON( aData );
				if ( Object.keys(aData).length > 1) {
					aData = aData[0];
					$("#etxtHotelStatusName").val(aData.name);
				} else {
					alert( "no data" );
				}
			});
		}else{
			clear_data();
			$("#txtHotelStatus_id").val("0");
		}

		$('.datepicker').datepicker({format: 'dd-mm-yyyy'});
	}

	function save_data(){
		var aData = JSON.stringify( $("#form-manage").serializeArray() );
			aData = jQuery.parseJSON( aData );

		if (validate(aData)) {
			$.post("hotelstatus/save_data",  aData  ,function( res ){
				res = jQuery.parseJSON( res ); 
				if (res.flag) {
					alert( res.msg );
					get_data_list();					
					to_manage_data();
				}else{
					alert( res.msg );
				}
			});
		}else{
			console.log("error-xxxxx")
		}
	}

	function validate(aData){
		var status = true;
		$.each(aData,function(k,v){
			if (v.name != "txtHotelStatus_id" && v.name != "txtHotelStatus_status") {				
				var obj = $("#"+v.name);
				console.log(obj);
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

	function open_chang_status( hotelstatus_id, status, text_title ){
		$("#txtStatus_hotelstatus_id").val( hotelstatus_id );
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
			var id = $("#txtStatus_hotelstatus_id").val();
			$.post("hotelstatus/chang_status",  { hotelstatus_id : id, status: status } ,function( res ){
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

</script>