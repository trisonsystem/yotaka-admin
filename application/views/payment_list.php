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
</style>
<div class="row title_page">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h3 class="lang_manage_employee_data" style="font-weight: bold;"><?php echo $title;?></h3>
	</div>
</div>
<br>
<div id="box-show-search">
	<div class="box-search">
		<div class="row">
			<?php // debug($division); ?>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span class="lang_employee_code"><?php echo $this->lang->line('payment_time'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtPaymentTime" class="form-control check_in" name="txtPaymentTime">
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
				<span class="lang_name"><?php echo $this->lang->line('bank_transfer_form'); ?> : </span>
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
						<th class="text-center"><?php echo $this->lang->line('transfer_to_bank'); ?></th>
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




<div class="modal" tabindex="-1" role="dialog" id="md-manage">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-title"></h5>
      </div>
      <div class="modal-body" id="md-manage-detail">
         	
      </div>
      <div class="modal-footer">
      	<!-- <button type="button" class="btn btn-success" id="btn-save-noapprove" onclick="save_noapprove()">บันทึก</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
        <span style="display: none;">
        	<input type="text" name="cs_book_id" id="cs_book_id" value="0">
        </span>
     
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
		// $.ajax({
  //           url:  "book/book_now",
  //           type: 'POST',
  //           dataType: 'json',
  //           success: function (response) {
  //              $("#md-manage-detail").html(response.temp);
  //           },
  //           error: function (response) {
  //               console.log(response);
  //           }
  //       });
	});

	function set_datepicker(){
    	var d = moment().add(1, 'days');
		$("#txtPaymentTime").val( moment().format('D-MM-YYYY') );
		$("#txtCheckOut").val( d.format('D-MM-YYYY') );

		$("#txtPaymentTime").datepicker({format: 'dd-mm-yyyy',autoclose: true});

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
			var str_html  = ""; 
			if ( Object.keys(aData).length > 1) {
				$.each(aData, function(k , v){
				if (k=="limit") { return; }
				var status = v.status;
				switch (v.status) {
					case 'wait_confirm'	: status = '<span style="color:#000;">'+languages[v.status]+'</span>';break;
					case 'already_paid'	: status = '<span style="color:blue;">'+languages[v.status]+'</span>';break;
					case 'cancel'		: status = '<span style="color:red;">'+languages[v.status]+'</span>';break;
				}
				
				
					str_html += "<tr>"; 
					str_html += " <td>"+( parseInt(k)+1 )+"</td>"; 
					str_html += " <td>"+moment(v.pay_time).format('YYYY-MM-D')+"</td>";
					str_html += " <td>"+languages['book_data']+"</td>";
					str_html += " <td class='text-right'>"+v.summary+"</td>";  
					str_html += " <td class='text-right'>"+v.discount+"</td>";
					str_html += " <td class='text-right'>"+v.total+"</td>";  
					str_html += " <td class='text-right'>"+v.pay_amount+"</td>";  
					str_html += " <td>"+languages[v.pay_type]+"</td>";
					str_html += (v.m_bank_number_list_id != undefined)?" <td>"+v.bank_name+"("+v.account_number+")</td>" : "<td></td>"; 
					str_html += " <td>"+status+"</td>";  
					str_html += (v.status == "wait_confirm") ? "<td><i class='fa' style='color:blue;' onclick='chang_status(\""+'already_paid'+"\","+v.booking_id+","+v.id+")'> "+languages['confirm']+"</i></td>" : "<td></td>";
					// str_html += " 	<i class='fa fa-exchange' style='font-size:20px' onclick='open_chang_status("+v.id+","+v.m_status_employee_id+",\""+v.code+" "+v.prefix+v.name+" "+v.last_name+"\")' title='<?php echo $this->lang->line('change_status'); ?>'></i>";
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
		set_datepicker();
	}

	function to_manage_data(){ //หน้า listdata
		$("#box-manage").hide();
		$("#box-show-search").show();
		$("#btn-toadd_data").show();
		$("#btn-tomanage_data").hide();
		$("#box-manage").css("width","0");
	}

	function to_add_data( employee_id = 0 ){ // เพิ่ม แก้ไข
		$("#md-manage").modal("show");
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
			if ($("#txtPassWord").val() != "") {
				$("#txtPassWord").removeClass("error-form");
				$("#txtRePassWord").removeClass("error-form");
			}
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
                console.log(response);
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
