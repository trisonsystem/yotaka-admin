<h1>Import Order</h1>
<?php 
    // debug($adminlist);
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];
?>
<div class="row pdTop">
    <div class="widget-body" id="loadBank">
        <div class="widget-main">

            <div class="row">
                <div class="col-xs-12 widthTable">
                    
                    <form class="form-horizontal" id="frmImportOrder" action="" method="post">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-1 control-label " >เลขที่เอกสาร</label>
                            <div class="col-xs-10 col-sm-2">
                                <input type="text" id="" name="" value="<?php echo $billNo; ?>" readonly="readonly"/>
                            </div>
                            <label class="col-xs-12 col-sm-1 control-label " >วันที่เอกสาร</label>
                            <div class="col-xs-10 col-sm-2">
                                <div class="input-group">
                                    <input class="form-control date-picker" id="sdate" name="sdate" type="text" data-date-format="dd-mm-yyyy" value="" readonly="readonly" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-1 control-label ">เลขที่อ้างอิง</label>
                            <div class="col-xs-10 col-sm-2">
                                <input type="text" id="" name=""/>
                            </div>
                            <label class="col-xs-12 col-sm-1 control-label ">ผู้ขาย</label>
                            <div class="col-xs-10 col-sm-4">
                                <input type="text" id="distributor" name="distributor" style="width:74%;" />
                            </div>
                            <label class="col-xs-12 col-sm-1 control-label ">เพิ่มสินค้า</label>
                            <div class="col-xs-10 col-sm-3">
                                <input type="text" id="product" name="product" style="width:100%;" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-1 control-label " >หมายเหตุ</label>
                            <div class="col-xs-10 col-sm-6">
                               <textarea class="autosize-transition form-control" id="form-field-8" placeholder="" style=""></textarea>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="importOrder" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center" >ลำดับ</th>
                                    <th>รหัสสินค้า</th>
                                    <th >ชื่อสินค้า</th>
                                    <th >หน่วยนับ</th>
                                    <th >จำนวน</th>
                                    <th >ตุ้นทุน/หนวย</th>
                                    <th >ราคา/หนวย</th>
                                    <th >จำนวนเงิน</th>
                                </tr>
                            </thead>

                            <tbody>
                            	<!-- <tr>
                                    <td align="center">1</td>
                                    <td align="center">DM-340</td>
                                    <td align="center">น้ำยาล้างจาน</td>
                                    <td align="center">ขวด</td>
                                    <td align="center">
                                    	<input type="text" id="" name="" value="10" />
                                    </td>
                                    <td align="center">8.50</td>
                                    <td align="center">
                                    	<input type="text" id="" name="" value="9.00" />
                                    </td>
                                    <td align="center">90.00</td>
                                </tr>
                                <tr>
                                    <td align="center">2</td>
                                    <td align="center">DM-987</td>
                                    <td align="center">สบู่ก้อน</td>
                                    <td align="center">ชิ้น</td>
                                    <td align="center">
                                    	<input type="text" id="" name="" value="60" />
                                    </td>
                                    <td align="center">4.50</td>
                                    <td align="center">
                                    	<input type="text" id="" name="" value="5.00" />
                                    </td>
                                    <td align="center">300.00</td>
                                </tr> -->
                                <?php if(!empty($bookAgent)): ?>
                                    <?php foreach($bookAgent as $key => $value): ?>
                                        
                                    <?php endforeach; ?>
                                <?php else: ?>
                                   <!--  <tr>
                                        <td align="center" colspan="8"><strong>no_data</strong></td>
                                    </tr> -->
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                            	<tr>
                            		<td colspan="4" rowspan="2"></td>
                            		<td align="center">70</td>
                            		<td ></td>
                            		<td ></td>
                            		<td align="center">390.00</td>
                            	</tr>
                            	<tr>
                            		<td colspan="4">
                            			xxxxxxx
                            		</td>
                            	</tr>
                            </tfoot>
                        </table>
                    </div>

                    <div>
                    	<button onclick="saveImportOrder();">Save</button>
                    </div>
                    
                </div>
            </div>

            <hr />
        </div>
    </div>
</div>
<script type="text/javascript">
	
	jQuery(function($) {
        //datepicker plugin
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
    });

	//## autocomplete
	// var availableTags =[ { label: "Choice1", value: "value1"}];
    $("#distributor").autocomplete({
        source:'<?php echo $path_host; ?>autoc/distributor',
        // source:availableTags,
        select: function( event, ui ) {
        	console.log(ui);
            event.preventDefault();
            $("#distributor").val(ui.item.label);
        }
    });
    $("#product").autocomplete({
        source:'<?php echo $path_host; ?>autoc/product',
        // source:availableTags,
        select: function( event, ui ) {
        	console.log(ui);
            event.preventDefault();
            $("#product").val('');
            addProductOrder(ui.item.value);
        }
    });
    //##

    function addProductOrder(arrValue){
    	console.log(arrValue);

    	if($("table#importOrder tbody tr#tr"+arrValue.id).html() != undefined){return false;}

    	var strHtml = '';
    	var trCount = $("table#importOrder tbody tr").length;
    	var no = parseInt(trCount)+1;

    	strHtml += '<tr id="tr'+arrValue.id+'">';
     	strHtml += ' 	<td align="center">'+no+'<input type="hidden" class="pId" value="'+arrValue.id+'"/></td>';
     	strHtml += '	<td align="center">'+arrValue.code+'</td>';
     	strHtml += '	<td align="center">'+arrValue.name+'</td>';
     	strHtml += '	<td align="center">ชิ้น</td>';
     	strHtml += '	<td align="center">';
     	strHtml += '		<input type="text" class="inp-amount" value="0" />';
     	strHtml += '	</td>';
     	strHtml += '	<td align="center">4.50</td>';
     	strHtml += '	<td align="center">';
     	strHtml += '		<input type="text" class="inp-price" value="0.00" />';
     	strHtml += '	</td>';
     	strHtml += '	<td align="center">0.00</td>';
     	strHtml += '</tr>';

     	if(trCount > 1){
     		$("table#importOrder tbody tr:last").after(strHtml);
     	}else{
     		$("table#importOrder tbody").append(strHtml);
     	}
    }

    function saveImportOrder(){
    	var serializeFrm = $("#frmImportOrder").serializeArray();
        // serializeFrm.push({name: 'bt', value: type});
        
        var aa = {};
        $('#importOrder tbody tr').each(function() {
			var amount = $(this).find('.inp-amount').val();
			var price = $(this).find('.inp-price').val();
			var pId = $(this).find('.pId').val();
			
			aa[pId] = {'amount':amount,'price':price};

			console.log(aa);
		});

		$.ajax({
		    url: baseUrl+"saveImportOrder",
		    data: {"frm":serializeFrm,"data":aa},
		    type: 'POST',
		    dataType: 'json',
	    	success:function(response){
	    		console.log(response);
	    		// genUpdateSoccer(response,'L');
		    }
	  	});

    }
</script>