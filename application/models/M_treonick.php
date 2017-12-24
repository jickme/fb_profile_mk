<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_treonick extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_info_cookie($cookie){
		$curl = $this->m_func->curl_url_cookie('https://mbasic.facebook.com/profile.php', $cookie);

		if(preg_match('#name="fb_dtsg" value="(.+?)"#is',$curl, $_jickme)){
		        $fb_dtsg = $_jickme[1];
		}
		if(preg_match('#name="target" value="(.+?)"#is',$curl, $_jickme)){
		        $fb_id = $_jickme[1];
		}

        if(preg_match('#<title>(.+?)</title>#is',$curl, $_jickme)){
          $name = $_jickme[1];
        }

		if(empty($fb_dtsg) || empty($fb_id) || empty($name)){
		    return false;
		}else{
			return array(
				'name' => $name,
				'fb_dtsg' => $fb_dtsg, 
				'fb_id'   => $fb_id
			);
		}
	}
	function set_browser($br){
		switch ($br) {
			case '1':
				$name = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2';
				//Chorme
				break;
			case '2':
				$name = 'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)';
				//IE 10
				break;
			case '3':
				$name = 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14';
				//Opera
				break;
			default:
				$name = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A';
				break;
		}
		return $name;
	}

	function val_form(){
		$this->form_validation->set_rules('cookie', 'Cookie', 'required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('note', 'Note', 'xss_clean|max_length[50]');
		$this->form_validation->set_rules('ngay_cai', 'Ngày cài', 'required|is_natural_no_zero|xss_clean|greater_than_equal_to[3]');
		$this->form_validation->set_rules('browser', 'Trình duyệt', 'required|is_natural_no_zero|xss_clean');
		return $this->form_validation->run();

	}
	function get_treonick($page){
		$this->db->where('user_creat', $_SESSION['id']);
		$query = $this->db->get('bot_login', 5, $page);
		return $query->result_array();
	}
	function num_rows_treo($id){
		$this->db->where('user_creat', $id);
		$this->db->from('bot_login');
		return $this->db->count_all_results();
	}
	function get_cookie_with_id($id){
		$this->db->where('id', $id);
		$bg = $this->db->get('bot_login');
		$ok = $bg->result_array();
		return $ok[0]['cookie'];
	}
	function form_val_edit(){
		$this->form_validation->set_rules('cookie', 'Cookie', 'required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('note', 'Note', 'xss_clean|max_length[50]');
		$this->form_validation->set_rules('active', 'Hoạt động', 'required|is_natural|less_than_equal_to[1]|greater_than_equal_to[0]');
		$this->form_validation->set_rules('gia_han', 'Gia hạn', 'required|is_natural|greater_than_equal_to[0]');
		return $this->form_validation->run();
	}
	function get_fbid($id){
		$this->db->where('id', $id);
		$bg = $this->db->get('bot_login');
		$ok = $bg->result_array();
		return $ok[0]['fb_id'];
	}
}