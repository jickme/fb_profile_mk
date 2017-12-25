<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		if(!$this->session->has_userdata('id')){
			redirect('/Login');
		}
		$this->load->model('m_member');
	}
	function index(){
		$data['title'] = 'Panel sử dụng hệ thống';
		$data['info'] = $this->m_member->get_info($this->session->userdata('id'));
		$data['load'] = 'member/index';
		$this->load->view('layout/member', $data);
	}
	function AutoTuongTac(){
		$this->load->model('m_tuongtac');
		if($this->input->post('access_token') != ''){
			if($this->m_tuongtac->form_val() == true){
				if($this->input->post('h_start') >= $this->input->post('h_end')){
									$arr = array(
										'type' => 'warning',
										'mess' => 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc'
									);
									echo json_encode($arr);
									exit;
				}
				if($this->m_func->check_token_live($this->input->post('access_token'))){
					$thanh_tien = $this->m_func->get_gia('bot_cx') * $this->input->post('ngay_cai');
					if($this->m_func->check_money($thanh_tien, $_SESSION['id'])){
						$info_token = $this->m_func->get_info_token($this->input->post('access_token'));
						if(isset($info_token['id'])){
							if($this->m_tuongtac->check_isset_db($info_token['id'])){

								$data_insert = array(
									'fb_id' => $info_token['id'],
									'name' => $info_token['name'],
									'reactions' => $this->input->post('reactions'),
									'access_token' => $this->input->post('access_token'),
									'time_use' => time() + ($this->input->post('ngay_cai') * 86400),
									'check_male' => $this->input->post('check_male'),
									'check_female' => $this->input->post('check_female'),
									'check_pg' => $this->input->post('check_pg'),
									'check_uid' => $this->input->post('check_uid'),
									'h_start' => $this->input->post('h_start'),
									'h_end' => $this->input->post('h_end'),
									'time_creat' => time(),
									'user_creat' => $_SESSION['id'],
									'note' => $this->input->post('note'),
									'active' => 1
								);
								if($this->db->insert('bot_reactions', $data_insert)){
									$arr = array(
										'type' => 'success',
										'mess' => 'Thêm thành công ! Bạn có thể xem lịch sử giao dịch'
									);
									$this->m_func->tru_tien($thanh_tien, $_SESSION['id']);
								}else{
									$arr = array(
										'type' => 'warning',
										'mess' => 'Lỗi hệ thống ! Thử lại sau !'
									);
								}
							}else{
								$arr = array(
									'type' => 'warning',
									'mess' => 'Tài khoản này đã cài đặt trên hệ thống trước đó'
								);
							}

						}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Token sai hoặc hết hạn'
							);
						}
					}else{
						$arr = array(
							'type' => 'warning',
							'mess' => 'Tài khoản của bạn ko đủ để giao dịch'
						);
					}
				}else{
					$arr = array(
						'type' => 'warning',
						'mess' => 'Token sai hoặc hết hạn'
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
		$data['title'] = 'Tương tác Facebook';
		$data['info'] = $this->m_member->get_info($this->session->userdata('id'));
		$data['load'] = 'member/auto_tuong_tac';
		$this->load->view('layout/member', $data);
	}
	function QuanLyAutoTuongTac($page = 0){
		$this->load->model('m_tuongtac');
		settype($page, 'int');
		if($this->input->post('delete_table') != ''){
			$id_table = $this->input->post('delete_table');
			settype($id_table, 'int');
			if($this->m_func->check_user_creat('bot_reactions', $_SESSION['id'], $id_table)){
				$this->db->where('id', $id_table);
				if($this->db->delete('bot_reactions')){
							$arr = array(
								'type' => 'success',
								'mess' => 'Đã xóa thành công'
							);
				}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Không thể xóa id này do lỗi'
							);
				}

			}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Bạn không thể xóa id của người khác'
							);
			}
			echo json_encode($arr);
			exit;
		}
		if($this->input->post('get_json_edit') != ''){
			$id_table = $this->input->post('get_json_edit');
			settype($id_table, 'int');
			if($this->m_func->check_user_creat('bot_reactions', $_SESSION['id'], $id_table)){
				$this->db->where('id', $id_table);
				$ok = $this->db->get('bot_reactions');
				$hi = $ok->result_array();
				echo json_encode($hi[0]);
				exit;
			}
		}
		if($this->input->post('edit_id') != ''){
			$id_table = $this->input->post('edit_id');settype($id_table, 'int');
			if($this->m_func->check_user_creat('bot_reactions', $_SESSION['id'], $id_table)){
				if($this->m_tuongtac->form_val('edit_id') == true){
					$thanh_tien = $this->input->post('gia_han') * $this->m_func->get_gia('bot_cx');
					if($this->m_func->check_money($thanh_tien, $_SESSION['id'])){
						if($this->input->post('h_start') >= $this->input->post('h_end')){
											$arr = array(
												'type' => 'warning',
												'mess' => 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc'
											);
											echo json_encode($arr);
											exit;
						}
						/*Check Live id*/
						if($this->m_func->check_token_live($this->input->post('access_token'))){
							$info_token = $this->m_func->get_info_token($this->input->post('access_token'));
							if(isset($info_token['id'])){
								if($info_token['id']  == $this->m_tuongtac->get_fbid($id_table)){

									$data_update = array(
										'name' => $info_token['name'],
										'reactions' => $this->input->post('reactions'),
										'access_token' => $this->input->post('access_token'),
										'check_male' => $this->input->post('check_male'),
										'check_female' => $this->input->post('check_female'),
										'check_pg' => $this->input->post('check_pg'),
										'check_uid' => $this->input->post('check_uid'),
										'h_start' => $this->input->post('h_start'),
										'h_end' => $this->input->post('h_end'),
										'user_creat' => $_SESSION['id'],
										'note' => $this->input->post('note'),
										'active' => $this->input->post('active')
									);
									$this->db->where('id', $id_table);
									if($this->db->update('bot_reactions', $data_update)){
										$this->m_func->tru_tien($thanh_tien, $_SESSION['id']);
										$arr = array(
											'type' => 'success',
											'mess' => 'Cập nhật thành công! Tải lại trang để xem thay đổi'
										);
										$time_plus = $this->input->post('gia_han') * 86400;
										$this->db->query("UPDATE bot_reactions SET time_use = time_use + $time_plus WHERE id = $id_table");
									}else{
										$arr = array(
											'type' => 'warning',
											'mess' => 'Lỗi'
										);
									}

								}else{
									$arr = array(
										'type' => 'warning',
										'mess' => 'Token không phải của tài khoản này !'
									);
								}
							}
						}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Token sai hoặc hết hạn'
							);
						}
						
					}else{
						$arr = array(
							'type' => 'warning',
							'mess' => 'Tài khoản của bạn không đủ để giao dịch'
						);
					}
				}else{
					$arr = array(
						'type' => 'warning',
						'mess' => validation_errors()
					);
				}
				echo json_encode($arr);
				
			}
			exit;
		}
		$data['title'] = 'Quản lý Auto tương tác';
		$data['info'] = $this->m_member->get_info($this->session->userdata('id'));
		$data['load'] = 'member/quanlytuongtac';
		$data['result_arr'] = $this->m_tuongtac->get_tuongtac($page);
		//Pagination Creat

		$this->load->library('pagination');
        $config = $this->config->item('pagination'); 
        $config['base_url'] = base_url('Member/QuanLyAutoTuongTac');
        $config['total_rows'] = $this->m_tuongtac->num_rows_tuongtac($_SESSION['id']);
        $config['per_page'] = 5;                         
        
        $this->pagination->initialize($config); 

        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/member', $data);

	}
	function TreoNick(){
		$this->load->model('m_treonick');
		if($this->input->post('cookie') != ''){
			if($this->m_treonick->val_form() == true){
				$get_info = $this->m_treonick->get_info_cookie($this->input->post('cookie'));
				if($get_info == false){
					$arr = array(
						'type' => 'warning',
						'mess' => 'Cookie không hợp lệ. Hoặc tài khoản bị checkpoint'
					);
				}else{
					$thanh_tien = $this->m_func->get_gia('treo_nick') * $this->input->post('ngay_cai');
					if($this->m_func->check_money($thanh_tien, $_SESSION['id'])){
						$insert_data = array(
							'fb_id' => $get_info['fb_id'],
							'name' => $get_info['name'],
							'fb_dtsg' => $get_info['fb_dtsg'],
							'cookie' => $this->input->post('cookie'),
							'note' => $this->input->post('note'),
							'time_use' => time() + ($this->input->post('ngay_cai') * 86400),
							'time_creat' => time(),
							'user_creat' => $_SESSION['id'],
							'active' => 1
						);
						if($this->db->insert('bot_login', $insert_data)){
							$this->m_func->tru_tien($thanh_tien, $_SESSION['id']);
							$arr = array(
									'type' => 'success',
									'mess' => 'Cài đặt thành công ! Bạn có thể xem lịch sử giao dịch để biết thêm thông tin ở lần cài đặt này'
							);
						}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Lỗi khi cài đặt ! Thử lại'
							);
						}
					}else{
						$arr = array(
							'type' => 'warning',
							'mess' => 'Tài khoản của bạn không đủ để giao dịch'
						);
					}

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
		$data['title'] = 'Treo nick Facebook 24/24';
		$data['info'] = $this->m_member->get_info($this->session->userdata('id'));
		$data['load'] = 'member/treonick';
		$this->load->view('layout/member', $data);
	}
	function QuanLyTreoNick($page = 0){
		$this->load->model('m_treonick');
		settype($page, 'int');
		if($this->input->post('delete_table') != ''){
			$id_table = $this->input->post('delete_table');
			settype($id_table, 'int');
			if($this->m_func->check_user_creat('bot_login', $_SESSION['id'], $id_table)){
				$this->db->where('id', $id_table);
				if($this->db->delete('bot_login')){
							$arr = array(
								'type' => 'success',
								'mess' => 'Đã xóa thành công'
							);
				}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Không thể xóa id này do lỗi'
							);
				}

			}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Bạn không thể xóa id của người khách'
							);
			}
			echo json_encode($arr);
			exit;
		}
		if($this->input->post('check_live_cookie') != ''){
			$id_table = $this->input->post('check_live_cookie');
			settype($id_table, 'int');
			if($this->m_func->check_user_creat('bot_login', $_SESSION['id'], $id_table)){
				if($this->m_treonick->get_info_cookie($this->m_treonick->get_cookie_with_id($id_table)) == false){
							$arr = array(
								'type' => 'warning',
								'mess' => 'Cookie đã die hoặc checkpoint'
							);
							$this->db->where('id', $id_table);
							$this->db->update('bot_login', array('active' => 2));
				}else{
							$arr = array(
								'type' => 'success',
								'mess' => 'Cookie live, hoạt động bình thường'
							);
							$this->db->where('id', $id_table);
							$this->db->update('bot_login', array('active' => 1));
				}
			}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Bạn không thể check id của người khác'
							);
			}
			echo json_encode($arr);
			exit;
		}
		
		if($this->input->post('get_json_edit') != ''){
			$id_table = $this->input->post('get_json_edit');
			settype($id_table, 'int');
			if($this->m_func->check_user_creat('bot_login', $_SESSION['id'], $id_table)){
				$this->db->where('id', $id_table);
				$ok = $this->db->get('bot_login');
				$hi = $ok->result_array();
				echo json_encode($hi[0]);
				exit;
			}
		}
		if($this->input->post('edit_id') != ''){
			$id_table = $this->input->post('edit_id');settype($id_table, 'int');
			if($this->m_func->check_user_creat('bot_login', $_SESSION['id'], $id_table)){
				if($this->m_treonick->form_val_edit() == true){
					$thanh_tien = $this->input->post('gia_han') * $this->m_func->get_gia('treo_nick');
					if($this->m_func->check_money($thanh_tien, $_SESSION['id'])){

						$get_info = $this->m_treonick->get_info_cookie($this->input->post('cookie'));
						if($get_info == false){
							$arr = array(
								'type' => 'warning',
								'mess' => 'Cookie die hoặc dính checkpoint!'
							);
						}else{
							if($get_info['fb_id'] == $this->m_treonick->get_fbid($id_table)){

								$time_add = $this->input->post('gia_han') * 86400;
								$data_update = array(
									'cookie' => $this->input->post('cookie'),
									'fb_dtsg' => $get_info['fb_dtsg'],
									'name'  =>$get_info['name'],
									'active' => $this->input->post('active'),
									'note' => $this->input->post('note')
								);
								$this->db->where('id', $id_table);
								if($this->db->update('bot_login', $data_update)){
									$this->m_func->tru_tien($thanh_tien, $_SESSION['id']);
									$arr = array(
										'type' => 'success',
										'mess' => 'Cập nhật thành công ! Tải lại trang để xem thay đổi'
									);
									$this->db->update("UPDATE bot_login SET time_use = time_use + $time_add WHERE id = $id_table");
								}else{
									$arr = array(
										'type' => 'warning',
										'mess' => 'Lỗi trong quá trình cập nhật!'
									);
								}
							}else{
								$arr = array(
									'type' => 'warning',
									'mess' => 'Có vẻ bạn điền nhầm cookie, cookie này không thuộc về tài khoản bạn chỉnh sửa.'
								);
							}
						}
					}else{
						$arr = array(
							'type' => 'warning',
							'mess' => 'Tài khoản của bạn không đủ để giao dịch'
						);
					}
				}else{
					$arr = array(
						'type' => 'warning',
						'mess' => validation_errors()
					);
				}
				echo json_encode($arr);
				
			}
			exit;
		}
		$data['title'] = 'Quản lý treo nick';
		$data['info'] = $this->m_member->get_info($this->session->userdata('id'));
		$data['load'] = 'member/quanlytreonick';
		$data['result_arr'] = $this->m_treonick->get_treonick($page);
		//Pagination Creat

		$this->load->library('pagination');
        $config = $this->config->item('pagination'); 
        $config['base_url'] = base_url('Member/QuanLyTreoNick');
        $config['total_rows'] = $this->m_treonick->num_rows_treo($_SESSION['id']);
        $config['per_page'] = 5;                         
        
        $this->pagination->initialize($config); 

        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/member', $data);
	}
	function QuanLyBotComment(){

		$this->load->model('m_botcmt');
		settype($page, 'int');
		if($this->input->post('delete_table') != ''){
			$id_table = $this->input->post('delete_table');
			settype($id_table, 'int');
			if($this->m_func->check_user_creat('bot_cmt', $_SESSION['id'], $id_table)){
				$this->db->where('id', $id_table);
				if($this->db->delete('bot_cmt')){
							$arr = array(
								'type' => 'success',
								'mess' => 'Đã xóa thành công'
							);
				}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Không thể xóa id này do lỗi'
							);
				}

			}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Bạn không thể xóa id của người khác'
							);
			}
			echo json_encode($arr);
			exit;
		}
		if($this->input->post('get_json_edit') != ''){
			$id_table = $this->input->post('get_json_edit');
			settype($id_table, 'int');
			if($this->m_func->check_user_creat('bot_cmt', $_SESSION['id'], $id_table)){
				$this->db->where('id', $id_table);
				$ok = $this->db->get('bot_cmt');
				$hi = $ok->result_array();
				echo json_encode($hi[0]);
				exit;
			}
		}
		if($this->input->post('edit_id') != ''){
			$id_table = $this->input->post('edit_id');settype($id_table, 'int');
			if($this->m_func->check_user_creat('bot_cmt', $_SESSION['id'], $id_table)){
				if($this->m_botcmt->form_val('edit_id') == true){
					$thanh_tien = $this->input->post('gia_han') * $this->m_func->get_gia('bot_cmt');
					if($this->m_func->check_money($thanh_tien, $_SESSION['id'])){
						if($this->input->post('h_start') >= $this->input->post('h_end')){
											$arr = array(
												'type' => 'warning',
												'mess' => 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc'
											);
											echo json_encode($arr);
											exit;
						}
						/*Check Live id*/
						if($this->m_func->check_token_live($this->input->post('access_token'))){
							$info_token = $this->m_func->get_info_token($this->input->post('access_token'));
							if(isset($info_token['id'])){
								if($info_token['id']  == $this->m_botcmt->get_fbid($id_table)){

									$data_update = array(
										'name' => $info_token['name'],
										'access_token' => $this->input->post('access_token'),
										'check_male' => $this->input->post('check_male'),
										'check_female' => $this->input->post('check_female'),
										'check_pg' => $this->input->post('check_pg'),
										'check_uid' => $this->input->post('check_uid'),
										'h_start' => $this->input->post('h_start'),
										'h_end' => $this->input->post('h_end'),
										'user_creat' => $_SESSION['id'],
										'note' => $this->input->post('note'),
										'active' => $this->input->post('active')
									);
									$this->db->where('id', $id_table);
									if($this->db->update('bot_cmt', $data_update)){
										$this->m_func->tru_tien($thanh_tien, $_SESSION['id']);
										$arr = array(
											'type' => 'success',
											'mess' => 'Cập nhật thành công! Tải lại trang để xem thay đổi'
										);
										$time_plus = $this->input->post('gia_han') * 86400;
										$this->db->query("UPDATE bot_cmt SET time_use = time_use + $time_plus WHERE id = $id_table");
									}else{
										$arr = array(
											'type' => 'warning',
											'mess' => 'Lỗi'
										);
									}

								}else{
									$arr = array(
										'type' => 'warning',
										'mess' => 'Token không phải của tài khoản này !'
									);
								}
							}
						}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Token sai hoặc hết hạn'
							);
						}
						
					}else{
						$arr = array(
							'type' => 'warning',
							'mess' => 'Tài khoản của bạn không đủ để giao dịch'
						);
					}
				}else{
					$arr = array(
						'type' => 'warning',
						'mess' => validation_errors()
					);
				}
				echo json_encode($arr);
				
			}
			exit;
		}
		if($this->input->get('edit_cmt') != ''){
			$id_table = (int)$this->input->get('edit_cmt');
			if($this->m_func->check_user_creat('bot_cmt', $_SESSION['id'], $id_table)){

				if($this->input->post('delete_comment') != ''){
					$id_table = (int)$this->input->post('delete_comment');
					if($this->m_botcmt->check_with_id_cmt($id_table, $_SESSION['id'])){
						$this->db->where('id', $id_table);
						if($this->db->delete('comments')){
							$arr = array(
								'type' => 'success',
								'mess' => 'Đã xóa thành công'
							);
						}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Lỗi hệ thống'
							);
						}

					}else{
						$arr = array(
							'type' => 'warning',
							'mess' => 'Comment này không còn khả dụng'
						);
					}
					echo json_encode($arr);
					exit;
				}
				if($this->input->post('id')){
					$img = $_FILES['img']; 
					if($img['name']==''){
						echo 'error';
					}else{
						$filename = $img['tmp_name']; 
						$client_id="3f9a53bd5ebb2fa"; 
						//$client_id="cliend_id"; 
						$handle = fopen($filename, "r"); 
						$data = fread($handle, filesize($filename)); 
						$pvars   = array('image' => base64_encode($data)); 
						$upload_done = $this->m_func->upload_imgur($client_id, $pvars);
						if($upload_done == false){
							echo 'error';
						}else{
							echo $upload_done;
						}
					}
					exit;
				}

				$data['result_arr'] = $this->m_botcmt->get_comment($id_table);
				$data['title'] = 'Chỉnh sửa nội dung cmt';
				$data['info'] = $this->m_member->get_info($this->session->userdata('id'));
				$data['load'] = 'member/editcmtbot';
			}else{
				redirect('/Member/QuanLyBotComment');
			}

		}else{
			$data['title'] = 'Quản lý Bot comments';
			$data['info'] = $this->m_member->get_info($this->session->userdata('id'));
			$data['load'] = 'member/quanlybotcmt';
			$data['result_arr'] = $this->m_botcmt->get_tuongtac($page);
			//Pagination Creat

			$this->load->library('pagination');
	        $config = $this->config->item('pagination'); 
	        $config['base_url'] = base_url('Member/QuanLyBotComment');
	        $config['total_rows'] = $this->m_botcmt->num_rows_tuongtac($_SESSION['id']);
	        $config['per_page'] = 5;                         
	        
	        $this->pagination->initialize($config); 

	        $data['pagination'] = $this->pagination->create_links();
		}
		

		$this->load->view('layout/member', $data);


	}
	function BotComment(){
		$this->load->model('m_botcmt');
		if($this->input->post('done_hihi') != ''){
			unset($_SESSION['fbid_addcmt']);
			unset($_SESSION['step_botcmt']);
		}
		if($this->input->post('noidung') != ''){
			if(isset($_SESSION['fbid_addcmt'])){
				$s = 0; $e = 0;
				$noidung = $this->input->post('noidung');
				$img_link = $this->input->post('img_link');
				$i = 0;
				if(count($noidung) > 5){
								$arr = array(
									'type' => 'warning',
									'mess' => 'Giới hạn tối đa 5 bình luận'
								);
								echo json_encode($arr);
					exit;
				}
				foreach ($noidung as $nd) {
					$data_in = array(
						'idbot' => $_SESSION['fbid_addcmt'],
						'message' => $nd,
						'image' => $img_link[$i],
						'time_update' => time()
					);
					$i++;
					if($this->db->insert('comments', $data_in)){
						$s++;
					}else{
						$e++;
					}
				}
				$arr = array(
					'type' => 'success',
					'mess' => 'Đã thêm thành công '.$s.' comments vào hệ thống'
				);
				$this->session->set_userdata('step_botcmt', '3');
				echo json_encode($arr);
				exit;
			}


			//echo json_encode($this->input->post());

			exit;

		}
		if($this->input->post('id')){
			$img = $_FILES['img']; 
			if($img['name']==''){
				echo 'error';
			}else{
				$filename = $img['tmp_name']; 
				$client_id="3f9a53bd5ebb2fa"; 
				//$client_id="cliend_id"; 
				$handle = fopen($filename, "r"); 
				$data = fread($handle, filesize($filename)); 
				$pvars   = array('image' => base64_encode($data)); 
				$upload_done = $this->m_func->upload_imgur($client_id, $pvars);
				if($upload_done == false){
					echo 'error';
				}else{
					echo $upload_done;
				}
			}
			exit;
		}
		if($this->input->post('access_token') != ''){
			if($this->m_botcmt->form_val() == true){
				if($this->input->post('h_start') >= $this->input->post('h_end')){
									$arr = array(
										'type' => 'warning',
										'mess' => 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc'
									);
									echo json_encode($arr);
									exit;
				}
				if($this->m_botcmt->check_token_live($this->input->post('access_token'))){
					$thanh_tien = $this->m_func->get_gia('bot_cmt') * $this->input->post('ngay_cai');
					if($this->m_func->check_money($thanh_tien, $_SESSION['id'])){
						$info_token = $this->m_botcmt->get_info_token($this->input->post('access_token'));
						if(isset($info_token['id'])){
							if($this->m_botcmt->check_isset_db($info_token['id'])){
								$data_insert = array(
									'fb_id' => $info_token['id'],
									'name' => $info_token['name'],
									'access_token' => $this->input->post('access_token'),
									'time_use' => time() + ($this->input->post('ngay_cai') * 86400),
									'check_male' => $this->input->post('check_male'),
									'check_female' => $this->input->post('check_female'),
									'check_pg' => $this->input->post('check_pg'),
									'check_uid' => $this->input->post('check_uid'),
									'h_start' => $this->input->post('h_start'),
									'h_end' => $this->input->post('h_end'),
									'time_creat' => time(),
									'user_creat' => $_SESSION['id'],
									'note' => $this->input->post('note'),
									'active' => 1
								);
								if($this->db->insert('bot_cmt', $data_insert)){
									$arr = array(
										'type' => 'success',
										'mess' => 'Thêm thành công ! Bạn có thể xem lịch sử giao dịch'
									);
									$this->m_func->tru_tien($thanh_tien, $_SESSION['id']);
									$this->session->set_userdata('step_botcmt', '2');
									$this->session->set_userdata('fbid_addcmt', $info_token['id']);
								}else{
									$arr = array(
										'type' => 'warning',
										'mess' => 'Lỗi hệ thống ! Thử lại sau !'
									);
								}
							}else{
								$arr = array(
									'type' => 'warning',
									'mess' => 'Tài khoản này đã cài đặt trên hệ thống trước đó'
								);
							}

						}else{
							$arr = array(
								'type' => 'warning',
								'mess' => 'Token sai hoặc hết hạn'
							);
						}
					}else{
						$arr = array(
							'type' => 'warning',
							'mess' => 'Tài khoản của bạn ko đủ để giao dịch'
						);
					}
				}else{
					$arr = array(
						'type' => 'warning',
						'mess' => 'Token sai hoặc hết hạn'
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

		$data['title'] = 'Tự động bình luận';
		$data['info'] = $this->m_member->get_info($this->session->userdata('id'));
		$data['load'] = 'member/auto_cmt';
		$this->load->view('layout/member', $data);
	}
	function Logout(){
		session_destroy();
		redirect('/Login');
	}
	function test(){
		echo addslashes("'xin chao' ds");	
	}
	
}