<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_botcmt extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function form_val($hi = ''){
		$this->form_validation->set_rules('access_token', 'Token', 'required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('note', 'Note', 'xss_clean|max_length[50]');
		if($hi == ''){
			$this->form_validation->set_rules('ngay_cai', 'Ngày cài', 'required|is_natural_no_zero|xss_clean|greater_than_equal_to[3]');
		}else{
			$this->form_validation->set_rules('gia_han', 'Gia hạn', 'required|is_natural|greater_than_equal_to[0]');
		}
		$this->form_validation->set_rules('h_start', 'Time bắt đầu', 'required|is_natural|xss_clean|greater_than_equal_to[0]|less_than_equal_to[23]');
		$this->form_validation->set_rules('h_end', 'Time kết thúc', 'required|is_natural|xss_clean|greater_than_equal_to[0]|less_than_equal_to[23]');
		$this->form_validation->set_rules('check_male', 'Giới tính nam', 'required|is_natural|xss_clean|greater_than_equal_to[0]|less_than_equal_to[1]');
		$this->form_validation->set_rules('check_female', 'Giới tính nữ', 'required|is_natural|xss_clean|greater_than_equal_to[0]|less_than_equal_to[1]');
		$this->form_validation->set_rules('check_pg', 'Group Page', 'required|is_natural|xss_clean|greater_than_equal_to[0]|less_than_equal_to[1]');
		$this->form_validation->set_rules('check_uid', 'UID', 'max_length[255]');
		return $this->form_validation->run();
	}
	function graph_fb($url){
	    $ch = @curl_init();
	    curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/'.$url.'');
	    curl_setopt($ch, CURLOPT_ENCODING, '');
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Expect:'
	    ));
	    $page = curl_exec($ch);
	    curl_close($ch);
	    return $page;
	}
	function check_token_live($token){
		$check = json_decode($this->graph_fb('me?method=GET&access_token='.$token.''), true);
		if(isset($check['id'])){
			return true;
		}else{
			return false;
		}
	}
	function get_info_token($token){
		return json_decode($this->graph_fb('me?method=GET&access_token='.$token.''), true);
	}
	function check_isset_db($id){
		$this->db->where('fb_id', $id);
		$ok = $this->db->get('bot_cmt');
		if($ok->num_rows() > 0){
			return false;
		}else{
			return true;
		}
	}


}