<?php
	 $path_assets = base_url()."assets/";
?>

<div class="title_page">
	<h1><?php echo $title;?></h1>
</div>
<br>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3"><h5>เลือกสินค้า<h5></div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right">ค้นหาสินค้า :</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="txt_search_product" name="" on></div>
</div>
<div class="row scrollbar" style="margin-top: 15px;" >
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="box-pd">
		<?php 
			$arr_quo_pd = array();
			foreach ($quotation_list as $k => $v) {
				$arr_quo_pd[$v['id']] = $v;
			}
			
			foreach ($product as $key => $pd) {
				$box_pd  = "";
				$select  = "false";
				$class   = "";
				if ( isset($arr_quo_pd[$pd['id']] ) ){
					$select = "true";
					$class  = "pd_active";
				}

				$box_pd .= '<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4 box-list">';
				$box_pd .= '		<div class="box-pd-list '.$class.'" data="'.$pd['id'].'" select="'.$select.'" id="'.$pd['id'].'"> <span>'.$pd['name'].'</span></div>';
				$box_pd .= '</div>';
				echo $box_pd;
			} 
		?>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		ที่อยู่ : <?php echo $address['address']; ?>
	</div>
</div>
<div class="row" style="margin-top: 20px;">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="box-pd-quotation" id="box-pd-quotation" style="width: 490px; "><!-- display: none; -->
			<table class="table table-border" id="tb-pd-quotation" >
				<thead>
					<tr>
						<th>จำนวน</th>
						<th style="text-align: left !important;">รายการสินค้า</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$str_html  = '';
					foreach ($quotation_list as $k => $v) {
				  	  $str_html .= '<tr id="tr_'.$v['product_id'].'">';
				  	  $str_html .= '		<td style="width:120px;">จำนวน : <input type="text" class="number" style="width:50px;" id="txtQty_'.$v['product_id'].'" value="'.$v['qty'].'"></td>';
				  	  $str_html .= '		<td>สินค้า : '.$v['product_name'].'</td>';
				  	  $str_html .= '</tr>';
					}
					echo $str_html;
				?>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td> 
							<button type="button" class="btn btn-primary" style="width: 100px;" onclick="save()">บันทึก</button> 
							<button type="button" class="btn btn-warning" style="width: 100px;" onclick="getMenu('manage_quotation/index');">ยกเลิก</button> 
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>



<link rel="stylesheet" type="text/css" href="<?php echo $path_assets?>css/Quotation.css">

<script type="text/javascript">

	$(document).ready(function() {
		
	});

	$(".box-pd-list").click(function(){
		 pd_name = $(this).find('span').html();
		 pd_id   = $(this).attr("id");

		if ($(this).attr('select') == "false") {
		  $(this).addClass("pd_active");
		  $(this).attr('select', "true");

		  
		  var str_html  = '';
		  	  str_html += '<tr id="tr_'+pd_id+'">';
		  	  str_html += '		<td style="width:120px;">จำนวน : <input type="text" class="number" style="width:50px;" id=\''+ "txtQty_"+pd_id + '\'></td>';
		  	  str_html += '		<td>สินค้า : '+pd_name+'</td>';
		  	  str_html += '</tr>';

		  $('#tb-pd-quotation tbody').append(str_html);

		  $('.number').FullnumOnly();
		}else{
		  $(this).removeClass("pd_active");
		  $(this).attr('select', "false");
		  $('#tr_' + pd_id ).remove();
		}


		if ($('#box-pd-quotation tbody tr').length > 0 ) {
			$('#box-pd-quotation').show();
		}else{ 
			$('#box-pd-quotation').hide();
		}
		
	});


	$( "#txt_search_product" ).keyup(function() {
	  var str_txt = $(this).val();
	  if (str_txt.trim() == "" ) { 
	  	$(".box-list").show()  
	  }else{
		  $(".box-list").each(function(){
		  	var obj_text = $(this).find("span").html();
		  	var status   = obj_text.search( str_txt );
		  	if (status > 1) { 
		  		$(this).show(); 
		  	}else{ 
		  		$(this).hide(); 
		  	}

		  });
		}
	});


	$.fn.FullnumOnly = function(){ //ไม่เอา .
    return this.each(function(){ 
        $(this).keydown(function (e) {
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 || (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode >= 35 && e.keyCode <= 40)) {
              return;
          }
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }
      });
    });
}

function save(){
	var data_pd = {};
	var status = true;

	$(".box-pd-list").each(function(){
	   if( $(this).attr("select") == "true" ){
		   	var obj_id = $(this).attr("id");
		   	var qty    = $("#txtQty_" + obj_id).val();

		   	data_pd[ obj_id ] = qty;
		   	if (qty.trim() == "") { status = obj_id; }
	   }
	});

	if (status == true) {
		$.post("manage_quotation/save",  { product : data_pd } ,function( res ){
			res = jQuery.parseJSON( res ); 
			if (res.flag) {
				alert( res.msg );
				getMenu('manage_quotation/quotation_list');
			}else{
				alert( res.msg );
			}

		});
	}else{
		$("#txtQty_" + status).focus();
		alert("กรุณาป้อนจำนวนสินค้า");
	}
	console.log( data_pd );
}

</script>