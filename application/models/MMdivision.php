<?php
class MMdivision extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function search_divcode( $aData ){
		$WHERE  = "";
		if ($aData != "") {
			$WHERE  = ( $aData["division_code"] == "" ) ? "" : " AND DV.code='".$aData["division_code"]."'";
		}
		$sql 	= " SELECT  DV.code
					FROM m_division AS DV
					WHERE 1 = 1  $WHERE
					ORDER BY DV.code ASC";
		$query 	= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}

		// debug($arr);
		return $arr;
    }
    
    public function search_divname( $aData ){
        $WHERE  = "";
		if ($aData != "") {
			$WHERE  = ( $aData["division_name"] == "" ) ? "" : " AND DV.name='".$aData["division_name"]."'";
		}
		$sql 	= " SELECT  DV.name
					FROM m_division AS DV
					WHERE 1 = 1  $WHERE
					ORDER BY DV.name ASC";
		$query 	= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}

		// debug($arr);
		return $arr;
    }

    public function search_division( $aData ){
        $lm = 15;
        if ( !isset($aData["page"]) ) 		 	    { $aData["page"] 				= 1;}
        if ( !isset($aData["division_code"]) ) 	    { $aData["division_code"] 		= "";}
        if ( !isset($aData["division_name"]) ) 	    { $aData["division_name"] 		= "";}
        if ( !isset($aData["division_status"]) ) 	{ $aData["division_status"] 	= "";}

        $LIMIT 	 = ( $aData["page"] 	== "" ) ? "0, $lm" : (($aData["page"] * $lm) - $lm).",$lm" ;

        $WHERE   = "";
        $WHERE  .= ( $aData["division_code"] 		== "" ) ? "" : " AND DV.code='".$aData["division_code"]."'";
        $WHERE  .= ( $aData["division_name"] 		== "" ) ? "" : " AND DV.name='".$aData["division_name"]."'";
        $WHERE  .= ( $aData["division_status"] 		== "" ) ? "" : " AND DV.status='".$aData["division_status"]."'";

        $sql = "SELECT DV.*
                FROM m_division AS DV
                WHERE 1 = 1 $WHERE
                ORDER BY DV.id DESC
                LIMIT $LIMIT";

        $query 	= $this->db->query($sql);
        $arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arr[] = $value;
		}
		$arr["limit"] = $lm;
		// debug($arr);
		return $arr;
    }

    public function save_data( $aData ){
        $aReturn = array();
        $aSave 	 = array();
        debug($aData);
    }
}