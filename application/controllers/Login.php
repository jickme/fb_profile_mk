<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('facebook');
		if($this->session->has_userdata('id')){
			redirect('/Member');
		}
	}
	function index(){
		$this->load->model('m_login');
		if($this->input->post('e') != ''){
			 $this->form_validation->set_rules('e', 'Email', 'required|valid_email|xss_clean');
			 $this->form_validation->set_rules('p', 'Password', 'required|min_length[6]|max_length[100]|xss_clean');
			 if($this->form_validation->run() == true){
				if($this->m_login->check_login($this->input->post('e'), $this->input->post('p'))){
					$sess = array(
						'email' => $this->input->post('e'),
						'id'	=> $this->m_func->email_to_id($this->input->post('e')),
						'time_login' => time()
					);
					$this->session->set_userdata($sess);

					$arr = array(
						'type' => 'success',
						'mess' => 'Đăng nhập thành công'
					);
				}else{
					$arr = array(
						'type' => 'warning',
						'mess' => 'Sai email hoặc mật khẩu'
					);
				}
			}else{
				$arr = array(
					'type' => 'warning',
					'mess' => validation_errors()
				);
			}

			echo json_encode($arr);
			exit;
		}
		$data['login_url'] =  $this->facebook->loginUrl();
		$this->load->view('page/login', $data);
	}
	function creat_pass(){
		echo md5('12345678'.md5('trideptrai'));
		//echo time();
	}
}