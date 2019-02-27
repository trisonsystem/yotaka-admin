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
		<?php // debug($division); ?>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>Word : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtLanguageWord" class="form-control" name="txtLanguageWord">
			</div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ภาษาอังกฤษ : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
            	<input type="text" id="txtLanguageEN" class="form-control" name="txtLanguageEN">
			</div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span>ภาษาไทย : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtLanguageTH" class="form-control" name="txtLanguageTH">
			</div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<!-- <span>สถานะ : </span> -->
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<button type="button" class="btn btn-primary" onclick="get_data_list()">ค้นหา</button>
				<button type="button" class="btn btn-warning" onclick="clear_data()">Clear</button>
			</div>
        </div>        
		<hr>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<table class="table" id="tb-div-list">
					<thead>
						<tr>
			                <th>ลำดับ</th>
			                <th>word</th>
			                <th>ภาษาอังกฤษ</th>
			                <th>ภาษาไทย</th>
			                <th>จัดการ</th>
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
</div>


<script type="text/javascript">
	var page = 1;
	var no_page = false;
	$(document).ready(function() {
		get_data_list();
    });

    function get_data_list(){
        var option = {
            language_word   : $("#txtLanguageWord").val(),
            language_en    : $("#txtLanguageEN").val(),
            language_th    : $("#txtLanguageTH").val(),
            page 	: page
        }

        $.get("language/search_language", option,function( aData ){
            aData = jQuery.parseJSON( aData );
            console.log(aData);
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
					str_html += " <td>"+v.word+"</td>";
                    str_html += " <td>"+v.en+"</td>";
                    str_html += " <td>"+v.th+"</td>";
					str_html += " <td align='center'>";
					str_html += " 	<i class='fa fa-edit' style='font-size:20px' onclick='to_add_data("+v.id+")'></i>";
					str_html += " 	<i class='fa fa-exchange' style='font-size:20px' onclick='open_chang_status("+v.id+","+v.status+",\""+v.code+" "+v.name+"\")' title='เปลี่ยนสถานะพนักงาน'></i>";
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
</script>