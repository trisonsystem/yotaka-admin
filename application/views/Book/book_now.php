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
	.fa-times-circle{ color: red; margin-top: 6px; }
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
		<?php echo $this->lang->line('keyword'); ?>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
		<!-- <?php if ($_COOKIE[$keyword."level"] == "SA") { ?>
			<button type="button" class="btn btn-secondary" onclick="to_add_data( '0' )" id="btn-toadd_data" style="margin-top: 10px; width: 100px;"><?php echo $this->lang->line('add'); ?></button>
			<button type="button" class="btn btn-warning" onclick="to_manage_data()" id="btn-tomanage_data" style="margin-top: 10px; width: 100px; display: none;"><?php echo $this->lang->line('cancel'); ?></button>
		<?php } ?> -->
	</div>
</div>
<br>
<div id="box-show-search" >
	<div class="box-search">
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtCheckIn"><?php echo $this->lang->line('check_in_date'); ?> </label>
				    <input type="text" id="txtCheckIn" class="form-control" name="txtCheckIn">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtCheckOut"><?php echo $this->lang->line('check_out_date'); ?> </label>
				    <input type="text" id="txtCheckOut" class="form-control" name="txtCheckOut">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
				<div class="form-group">
				    <label for="txtPrefix"><?php echo $this->lang->line('prefix'); ?> </label>
				    <input type="text" id="txtPrefix" class="form-control" name="txtPrefix">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtName"><?php echo $this->lang->line('name'); ?> </label>
				    <input type="text" id="txtName" class="form-control" name="txtName">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtLastName"><?php echo $this->lang->line('last_name'); ?> </label>
				    <input type="text" id="txtLastName" class="form-control" name="txtLastName">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtEmail"><?php echo $this->lang->line('email'); ?> </label>
				    <input type="text" id="txtEmail" class="form-control" name="txtEmail">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtTel"><?php echo $this->lang->line('tel'); ?> </label>
				    <input type="text" id="txtTel" class="form-control" name="txtTel">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-11">
				<div class="radio">
				  <label>
				    <input type="radio" name="rBook" id="rBook1" value="main" checked>
				    <?php echo $this->lang->line('main_guest'); ?>
				  </label>

				  <label style="margin-left: 15px;">
				    <input type="radio" name="rBook" id="rBook2" value="someone">
				    <?php echo $this->lang->line('booking_for_someone_else'); ?>
				  </label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtEmail"><?php echo $this->lang->line('guests_qty'); ?> </label>
				    <input type="text" id="txtGuestsQty" class="form-control" name="txtGuestsQty">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtTel"><?php echo $this->lang->line('childen'); ?> </label>
				    <select class="form-control" id="slChilden" name="slChilden">
				    	<option value="0"><?php echo $this->lang->line('no_childen'); ?></option>
				    	<?php 
				    		for ($i=1; $i <= 10; $i++) { 
				    			echo '<option value="0">'.$i." ".$this->lang->line('childen').'</option>';
				    		}
				    	?>
				    </select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
				    <label for="txtTel"><?php echo $this->lang->line('childen'); ?> </label>
				    <select class="form-control" id="slChilden" name="slChilden">
				    	<option value="0"><?php echo $this->lang->line('no_childen'); ?></option>
				    	<?php 
				    		for ($i=0; $i <= 17; $i++) { 
				    			echo '<option value="0">'.$i." ".$this->lang->line('years_old').'</option>';
				    		}
				    	?>
				    </select>
				</div>
			</div>
		</div> 
		<div class="row">
			<!-- <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<button type="button" class="btn btn-primary" onclick="get_data_list()"><?php echo $this->lang->line('search'); ?></button>
				<button type="button" class="btn btn-warning" onclick="clear_data()"><?php echo $this->lang->line('clear'); ?></button>
			</div> -->
		</div>
	</div>
</div>
	<hr>