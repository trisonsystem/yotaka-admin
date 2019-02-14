<?php
class MProduct extends CI_Model {

	public function __construct(){
		parent::__construct();

	}

	public function getProduct_all(){
		$sql 	= "select * from product";
		$query 	= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}

		// debug($arr);
		return $arr;
	}
}