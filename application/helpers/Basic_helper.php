<?php

if (!function_exists('getField')) {
	function getField($table="default",$field="",$params="")
	{
		$CI =& get_instance();
		$result = 0;    
		$CI->db->select($field);    
		if ($params) {
			$CI->db->where($params);
		}
		$query = $CI->db->get($table)->result_array();
		foreach($query as $row) {
			$result = $row[$field];
		}
		return $result;
	}
}

if ( ! function_exists('resultJson'))
{
	function resultJson( $responseCode = "", $responseDesc = "", $data){
		return array( "responseCode" => $responseCode ,"responseDesc" => $responseDesc, "data" => $data);
	}
}