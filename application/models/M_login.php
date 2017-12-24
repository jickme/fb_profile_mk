<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model
{
	function check_login($e, $p){
		$pass = md5($p.md5('trideptrai'));
		$query = $this->db->query("SELECT * FROM member WHERE email = '{$e}' AND password = '{$pass}'");
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}