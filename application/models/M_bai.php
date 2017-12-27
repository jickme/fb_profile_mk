<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bai extends CI_Model
{
	function get_user($where){
		$this->db->where('user_creat', $where);
		$ok = $this->db->get('auto_post');
		return $ok->result_array();
	}
	function val_form($type){
		$this->form_validation->set_rules('idfb', 'IDFB', 'required|numeric');
		switch ($type) {
			case 'profile':
				$this->form_validation->set_rules('message', 'Nội dung', 'xss_clean');
				break;
			case 'group':
				$this->form_validation->set_rules('message', 'Nội dung', 'xss_clean');
				$this->form_validation->set_rules('list_id_group', 'Danh sách ID Group', 'required|xss_clean');
				break;
			default:
				$this->form_validation->set_rules('list_id_copy', 'Danh sách ID Copy', 'required|xss_clean');
				break;
		}
		$this->form_validation->set_rules('ngay', 'Ngày', 'required');
	    $this->form_validation->set_rules('gio', 'Giờ', 'required');
		$this->form_validation->set_rules('time_repeat', 'Thời gian lặp', 'required|numeric|greater_than_equal_to[0]');
		return $this->form_validation->run();
	}
	function row_fbid($idfb){
		$this->db->where('idfb', $idfb);
		$ok = $this->db->get('posts');
		return $ok->num_rows();
	}
	function get_id_from_uid($uid, $user_add){
		$this->db->where('idfb', $uid);
		$this->db->where('user_creat', $user_add);
		$ok = $this->db->get('auto_post');
		if($ok->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	function get_all_post($user){
		$this->db->where('user_creat',$user);
		$ok = $this->db->get('posts');
		return $ok->result_array();
	}
	
}
?>