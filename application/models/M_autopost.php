<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_autopost extends CI_Model
{
	function form_val_add(){
		$this->form_validation->set_rules('access_token', 'Token', 'required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('note', 'Note', 'xss_clean|max_length[50]');
		$this->form_validation->set_rules('ngay_cai', 'Ngày cài', 'required|is_natural_no_zero|xss_clean|greater_than_equal_to[3]');
		$this->form_validation->set_rules('post_max', 'Số post/ ngày', 'required|is_natural_no_zero|xss_clean|greater_than_equal_to[1]');
		return $this->form_validation->run();
	}

}