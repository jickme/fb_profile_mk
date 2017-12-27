<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CronJobs extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_cron');
	}
	function Post_Profile($limit= 10){
		$profile = $this->m_cron->get_post_profile($limit);
		foreach ($profile as $post) {
			if($post['image'] == ''){
				$data = array(
					'message' => $this->m_cron->message_replace($post['message']),
					'access_token' => $this->m_cron->get_token_from_uid($post['idfb'])
				);
				$post_action = $this->m_cron->post_graph($post['idfb'].'/feed/', $data);
			}else{
				$data = array(
					'caption' => $this->m_cron->message_replace($post['message']),
					'url' => $post['image'],
					'access_token' => $this->m_cron->get_token_from_uid($post['idfb'])
				);
				$post_action = $this->m_cron->post_graph($post['idfb'].'/photos/', $data);
			}
			if(isset($post_action['id'])){
				$time_plus = $post['time_repeat'] * 60;
				if($time_plus = 0){
					$this->db->query("UPDATE posts SET posted = 0, time_post = time_post + $time_plus WHERE id={$post['id']}");
				}else{
					$this->db->query("UPDATE posts SET posted = 1, time_post = time_post + $time_plus WHERE id={$post['id']}");
				}
				echo '<b style="color: blue;">success</b>';
			}else{
				echo '<b style="color: red;">error</b>';
			}
		}
	}
	function Post_Group($limit = 10){
		$group = $this->m_cron->get_post_group($limit);
		foreach ($group as $post) {
			$group_list = $this->m_cron->rand_group($post['list_id_group']);
			if($post['image'] == ''){
				$data = array(
					'message' => $this->m_cron->message_replace($post['message']),
					'access_token' => $this->m_cron->get_token_from_uid($post['idfb'])
				);
				$post_action = $this->m_cron->post_graph($group_list.'/feed/', $data);
			}else{
				$data = array(
					'caption' => $this->m_cron->message_replace($post['message']),
					'url' => $post['image'],
					'access_token' => $this->m_cron->get_token_from_uid($post['idfb'])
				);
				$post_action = $this->m_cron->post_graph($group_list.'/photos/', $data);
			}
			if(isset($post_action['id'])){
				$time_plus = $post['time_repeat'] * 60;
				if($time_plus = 0){
					$this->db->query("UPDATE posts SET posted = 1, time_post = time_post + $time_plus WHERE id={$post['id']}");
				}else{
					$this->db->query("UPDATE posts SET posted = 0, time_post = time_post + $time_plus WHERE id={$post['id']}");
				}
				echo '<b style="color: blue;">success</b>';
			}else{
				echo '<b style="color: red;">error</b>';
			}

		}
	}
	function CopyPost($limit = 10){
		$copy = $this->m_cron->get_post_copy($limit);
		foreach ($copy as $post) {
			$id_copy = $this->m_cron->get_id_copy($post['list_id_copy']);
			$post_new_copied = $this->m_cron->get_id_newpost($id_copy, $this->m_cron->get_token_from_uid($post['idfb']));
			$post_info = $this->m_cron->post_info($post_new_copied, $this->m_cron->get_token_from_uid($post['idfb']));
			if(isset($post_info['full_picture'])){
				$data = array(
					'caption' => $post_info['message'],
					'url' => $post_info['full_picture'],
					'access_token' => $this->m_cron->get_token_from_uid($post['idfb'])
				);
				$post_action = $this->m_cron->post_graph($post['idfb'].'/photos/', $data);
			}else{
				if(!isset($post_info['message'])){
					print_r($post_info);
					break;
				}
				$data = array(
					'message' => $post_info['message'],
					'access_token' => $this->m_cron->get_token_from_uid($post['idfb'])
				);
				$post_action = $this->m_cron->post_graph($post['idfb'].'/feed/', $data);
			}
			if(isset($post_action['id'])){
				$time_plus = $post['time_repeat'] * 60;
				if($time_plus = 0){
					$this->db->query("UPDATE posts SET posted = 0, time_post = time_post + $time_plus WHERE id={$post['id']}");
				}else{
					$this->db->query("UPDATE posts SET posted = 0, time_post = time_post + $time_plus WHERE id={$post['id']}");
				}
				echo '<b style="color: blue;">success</b>';
			}else{
				echo '<b style="color: red;">error</b>';
			}
		}
	}
	function test(){
		/*$data = array(
			'limit' => '1',
			'fields' => 'id',
			'access_token' => 'EAAAAAYsX7TsBAMU1PHdk6UrOSLQ1GIeby5a780G46yaRA3FFww2YXfdKeyoCVlL3OegsZABJs6SZCuCnMpMej6AdJFuCHQMD4j1mhZAuqh5eW2HB4YKXbwLz8ZBVk6nJAAirE88P0iQMJps3zitY9ju4dF2OMmnQiKn0KO5pH1MWZAdDxmiZAIhfH5ByBgjRmwm7StmHZBqr8KKktKdrawA'
		);
		$ok = $this->m_cron->get_graph('4/feed/', $data);
		$id = $ok['data'][0]['id'];*/
		/*$id = $this->m_cron->get_id_newpost(100005500358832, 'EAAAAAYsX7TsBAMU1PHdk6UrOSLQ1GIeby5a780G46yaRA3FFww2YXfdKeyoCVlL3OegsZABJs6SZCuCnMpMej6AdJFuCHQMD4j1mhZAuqh5eW2HB4YKXbwLz8ZBVk6nJAAirE88P0iQMJps3zitY9ju4dF2OMmnQiKn0KO5pH1MWZAdDxmiZAIhfH5ByBgjRmwm7StmHZBqr8KKktKdrawA');
		print_r($id);*/
		$data2 = array(
			'fields' => 'full_picture,message',
			'access_token' => 'EAAAAAYsX7TsBAMU1PHdk6UrOSLQ1GIeby5a780G46yaRA3FFww2YXfdKeyoCVlL3OegsZABJs6SZCuCnMpMej6AdJFuCHQMD4j1mhZAuqh5eW2HB4YKXbwLz8ZBVk6nJAAirE88P0iQMJps3zitY9ju4dF2OMmnQiKn0KO5pH1MWZAdDxmiZAIhfH5ByBgjRmwm7StmHZBqr8KKktKdrawA'
		);
		$hihi = $this->m_cron->get_graph($id, $data2);
		print_r($hihi);
		
	}
}