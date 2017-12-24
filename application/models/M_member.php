<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_member extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function get_info($id){
		$this->db->where('id', $id);
		$query = $this->db->get('member');
		$result = $query->result_array();
		return $result[0];
	}
	
	

}