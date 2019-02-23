<?php
class MDepartment extends CI_Model {

	public function __construct(){
		parent::__construct();

    }

    public function search_department( $aData ){
		$WHERE  = "";
		if ($aData != "") {
			$WHERE  .= ( !isset($aData["department_id"]) ) ? "" : " AND DP.id='".$aData["department_id"]."'";
			$WHERE  .= ( !isset($aData["division_id"]) )   ? "" : " AND DP.m_division_id='".$aData["division_id"]."'";
		}
		$sql 	= " SELECT DP.*,
                    DV.name AS division_name
                    FROM m_department AS DP
                    LEFT JOIN m_division 	AS DV ON DV.id = DP.m_division_id
					WHERE 1 = 1  $WHERE
					ORDER BY DP.id ASC";
		$query 	= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}

		// debug($arr);
		return $arr;
	}
}