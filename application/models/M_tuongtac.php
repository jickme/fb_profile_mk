<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tuongtac extends CI_Model
{
	function form_val($hi = ''){
		$this->form_validation->set_rules('access_token', 'Token', 'required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('note', 'Note', 'xss_clean|max_length[50]');
		if($hi == ''){
			$this->form_validation->set_rules('ngay_cai', 'Ngày cài', 'required|is_natural_no_zero|xss_clean|greater_than_equal_to[3]');
		}else{
			$this->form_validation->set_rules('gia_han', 'Gia hạn', 'required|is_natural|greater_than_equal_to[0]');
		}
		$this->form_validation->set_rules('reactions', 'Cảm xúc', 'required|is_natural_no_zero|xss_clean|greater_than_equal_to[0]|less_than_equal_to[7]');
		$this->form_validation->set_rules('h_start', 'Time bắt đầu', 'required|is_natural|xss_clean|greater_than_equal_to[0]|less_than_equal_to[23]');
		$this->form_validation->set_rules('h_end', 'Time kết thúc', 'required|is_natural|xss_clean|greater_than_equal_to[0]|less_than_equal_to[23]');
		$this->form_validation->set_rules('check_male', 'Giới tính nam', 'required|is_natural|xss_clean|greater_than_equal_to[0]|less_than_equal_to[1]');
		$this->form_validation->set_rules('check_female', 'Giới tính nữ', 'required|is_natural|xss_clean|greater_than_equal_to[0]|less_than_equal_to[1]');
		$this->form_validation->set_rules('check_pg', 'Group Page', 'required|is_natural|xss_clean|greater_than_equal_to[0]|less_than_equal_to[1]');
		$this->form_validation->set_rules('check_uid', 'UID', 'max_length[255]');
		return $this->form_validation->run();
	}

	function check_isset_db($id){
		$this->db->where('fb_id', $id);
		$ok = $this->db->get('bot_reactions');
		if($ok->num_rows() > 0){
			return false;
		}else{
			return true;
		}
	}
	function get_tuongtac($page){
		$this->db->where('user_creat', $_SESSION['id']);
		$query = $this->db->get('bot_reactions', 5, $page);
		return $query->result_array();
	}
	function num_rows_tuongtac($id){
		$this->db->where('user_creat', $id);
		$this->db->from('bot_reactions');
		return $this->db->count_all_results();
	}
	function get_fbid($id){
		$this->db->where('id', $id);
		$bg = $this->db->get('bot_reactions');
		$ok = $bg->result_array();
		return $ok[0]['fb_id'];
	}

}