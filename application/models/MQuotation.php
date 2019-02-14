<?php
class MQuotation extends CI_Model {

	public function __construct(){
		parent::__construct();

	}

	public function save_data( $aData ){
		$aSave  = array();
		$aSave['doc_no'] 		= "Q".substr(date("Y"), 2).date("M")."-".date("dhis");
		$aSave['address']  		= "1";
		$aSave['status']  		= "0";
		$aSave['remark']  		= "";
		$aSave['create_date'] = date("Y-m-d H:i:s");
		$aSave['create_by'] = "admin";
		$aSave['update_date'] = date("Y-m-d H:i:s");
		$aSave['update_by'] = "admin";
		
		$aReturn = array();
		if ($this->db->replace('quotation', $aSave)) {
			$status = true;
			$quotation_id = $this->db->insert_id();
			foreach ($aData['product'] as $k => $v) {
				$aSave = array();
				$aSave['quotation_id']  = $quotation_id;
				$aSave['product_id']    = $k;
				$aSave['qty']    		= $v;
				$aSave['create_date'] 	= date("Y-m-d H:i:s");
				$aSave['create_by'] 	= "admin";
				$aSave['update_date'] 	= date("Y-m-d H:i:s");
				$aSave['update_by'] 	= "admin";

				if(!$this->db->replace('quotation_list', $aSave)){ $status = false; }
			}
			if ($status) {
				$aReturn["flag"] = true;
				$aReturn["msg"] = "success";
			}else{
				$aReturn["flag"] = false;
				$aReturn["msg"] = "Error SQL !!!";
			}
			
		}else{
			$aReturn["flag"] = false;
			$aReturn["msg"] = "Error SQL !!!";
		}

		return $aReturn;
	}

	public function getQuotaion(){
		$sql 	= "select * from quotation";
		$query 	= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}

		// debug($arr);
		return $arr;
	}

	public function getMaxIDQuotaion(){
		$sql 	= "select Max(id) as id from quotation";
		$query 	= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}

		// debug($arr);
		return $arr;
	}

	public function getQuotaion_pd_list( $aData ){
		$arr 	= array();
		$sql	= "	select ql.* , pd.name as product_name
					from quotation_list as ql 
					left join product as pd on ql.product_id = pd.id
					where ql.quotation_id = '".$aData['quotation_id']."'";
		$query 	= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}

		// debug($arr);
		return $arr;

	}

	public function delete_data( $aData ){
		$aReturn = array();
		if ($this->db->delete('quotation', array('id' => $aData['quotation_id'])) && $this->db->delete('quotation_list', array('quotation_id' => $aData['quotation_id']))) {
			$aReturn["flag"] = true;
			$aReturn["msg"] = "success";
		}else{
			$aReturn["flag"] = false;
			$aReturn["msg"] = "Error SQL !!!";
		}
		return $aReturn;
	}

	public function approve_data( $aData ){
		$aReturn = array();
		$aSave   = array();
		$aSave["status"]   = "1"; 
		$this->db->where("id", $aData['quotation_id']);
		if ($this->db->update('quotation', $aSave) ) {
			$aReturn["flag"] = true;
			$aReturn["msg"] = "success";
		}else{
			$aReturn["flag"] = false;
			$aReturn["msg"] = "Error SQL !!!";
		}
		return $aReturn;
	}

	public function no_approve_data( $aData ){
		$aReturn = array();
		$aSave   = array();
		$aSave["status"]   = "2"; 
		$aSave["remark"]   = $aData['remark']; 
		$this->db->where("id", $aData['quotation_id']);
		if ($this->db->update('quotation', $aSave) ) {
			$aReturn["flag"] = true;
			$aReturn["msg"] = "success";
		}else{
			$aReturn["flag"] = false;
			$aReturn["msg"] = "Error SQL !!!";
		}
		return $aReturn;
	}
	
    public function get_data_quotation( $quotation_id ){
   		$arr 	= array();
		$sql	= "	select ql.*
					from quotation as ql 
					where ql.id = '".$quotation_id."'";
		$query 	= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}

		// debug($arr);
		return $arr;
    }

    public function get_data_quotation_list( $quotation_id ){
   		$arr 	= array();
		$sql	= "	select ql.* , pd.name as product_name
					from quotation_list as ql 
					left join product as pd on ql.product_id = pd.id
					where ql.quotation_id = '".$quotation_id."'";
		$query 	= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}

		// debug($arr);
		return $arr;
   }
}