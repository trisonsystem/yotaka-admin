<?php
class MAddress extends CI_Model {

	public function __construct(){
		parent::__construct();

	}

	public function get_data( $id = "" ){
		$where 		= ($id == "") ? "" : " where id = '".$id."'";
		$keysearch 	= $this->input->get('term');
		$arr 		= array();

		$sql	= "select * from address ".$where."";
		$query 	= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}

		// debug($arr);
		if ($id == "") {
			return $arr;
		}else{
			return $arr[0];
		}
		
	}
}