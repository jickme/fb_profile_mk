<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bai extends CI_Model
{
	function get_user($where){
		$this->db->where('user_creat', $where);
		$ok = $this->db->get('auto_post');
		return $ok->result_array();
	}
}
?>