<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cron extends CI_Model
{

	function get_post_profile($limit){
		$time = time();
		$query = $this->db->query("SELECT * FROM posts WHERE where_post = 'profile' AND $time >= time_post AND posted = 0 ORDER BY rand() LIMIT 0, $limit");
		return $query->result_array();
	}
	function get_post_group($limit){
		$time = time();
		$query = $this->db->query("SELECT * FROM posts WHERE where_post = 'group' AND $time >= time_post AND posted = 0 ORDER BY rand() LIMIT 0, $limit");
		return $query->result_array();
	}
	function get_post_copy($limit){
		$time = time();
		$query = $this->db->query("SELECT * FROM posts WHERE where_post = 'copy' AND $time >= time_post AND posted = 0 ORDER BY rand() LIMIT 0, $limit");
		return $query->result_array();
	}

	function rand_group($list){
		$group = explode(';', $list);
		return $group[rand(0,count($group)-2)];
	}
	function get_token_from_uid($uid){
		$this->db->where('idfb', $uid);
		$ok = $this->db->get('auto_post');
		$okk = $ok->result_array();
		return $okk[0]['token'];
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
	function post_graph($type, $data){
		$url_buil = http_build_query($data);
		return json_decode($this->graph_fb($type.'?'.$url_buil.'&method=POST'), true);
	}
	function get_graph($type, $data){
		$url_buil = http_build_query($data);
		return json_decode($this->graph_fb($type.'?'.$url_buil.'&method=GET'), true);
	}
	function post_info($id_post, $token){
		$data = array(
			'fields' => 'full_picture,message',
			'access_token' => $token
		);
		return $this->get_graph($id_post,$data);

	}
	function get_id_newpost($idfb, $token){
		$data = array(
			'limit' => '1',
			'fields' => 'id, status_type',
			'access_token' => $token
		);
		$ok = $this->get_graph($idfb.'/feed', $data);
		return $ok['data'][0]['id'];
	}
	function get_id_copy($list){
		$list_arr = explode(PHP_EOL, $list);
		$uid = $list_arr[rand(0,count($list_arr)-1)];
		return $uid;
	}
	function message_replace($mess){
		$emo=array(
		urldecode('%F3%BE%80%80'),
		urldecode('%F3%BE%80%81'),
		urldecode('%F3%BE%80%82'),
		urldecode('%F3%BE%80%83'),
		urldecode('%F3%BE%80%84'),
		urldecode('%F3%BE%80%85'),
		urldecode('%F3%BE%80%87'), 
		urldecode('%F3%BE%80%B8'), 
		urldecode('%F3%BE%80%BC'),
		urldecode('%F3%BE%80%BD'),
		urldecode('%F3%BE%80%BE'),
		urldecode('%F3%BE%80%BF'),
		urldecode('%F3%BE%81%80'),
		urldecode('%F3%BE%81%81'),
		urldecode('%F3%BE%81%82'),
		urldecode('%F3%BE%81%83'),
		urldecode('%F3%BE%81%85'),
		urldecode('%F3%BE%81%86'),
		urldecode('%F3%BE%81%87'),
		urldecode('%F3%BE%81%88'),
		urldecode('%F3%BE%81%89'), 
		urldecode('%F3%BE%81%91'),
		urldecode('%F3%BE%81%92'),
		urldecode('%F3%BE%81%93'), 
		urldecode('%F3%BE%86%90'),
		urldecode('%F3%BE%86%91'),
		urldecode('%F3%BE%86%92'),
		urldecode('%F3%BE%86%93'),
		urldecode('%F3%BE%86%94'),
		urldecode('%F3%BE%86%96'),
		urldecode('%F3%BE%86%9B'),
		urldecode('%F3%BE%86%9C'),
		urldecode('%F3%BE%86%9D'),
		urldecode('%F3%BE%86%9E'),
		urldecode('%F3%BE%86%A0'),
		urldecode('%F3%BE%86%A1'),
		urldecode('%F3%BE%86%A2'),
		urldecode('%F3%BE%86%A4'),
		urldecode('%F3%BE%86%A5'),
		urldecode('%F3%BE%86%A6'),
		urldecode('%F3%BE%86%A7'),
		urldecode('%F3%BE%86%A8'),
		urldecode('%F3%BE%86%A9'),
		urldecode('%F3%BE%86%AA'),
		urldecode('%F3%BE%86%AB'),
		urldecode('%F3%BE%86%AE'),
		urldecode('%F3%BE%86%AF'),
		urldecode('%F3%BE%86%B0'),
		urldecode('%F3%BE%86%B1'),
		urldecode('%F3%BE%86%B2'),
		urldecode('%F3%BE%86%B3'), 
		urldecode('%F3%BE%86%B5'),
		urldecode('%F3%BE%86%B6'),
		urldecode('%F3%BE%86%B7'),
		urldecode('%F3%BE%86%B8'),
		urldecode('%F3%BE%86%BB'),
		urldecode('%F3%BE%86%BC'),
		urldecode('%F3%BE%86%BD'),
		urldecode('%F3%BE%86%BE'),
		urldecode('%F3%BE%86%BF'),
		urldecode('%F3%BE%87%80'),
		urldecode('%F3%BE%87%81'),
		urldecode('%F3%BE%87%82'),
		urldecode('%F3%BE%87%83'),
		urldecode('%F3%BE%87%84'),
		urldecode('%F3%BE%87%85'),
		urldecode('%F3%BE%87%86'),
		urldecode('%F3%BE%87%87'), 
		urldecode('%F3%BE%87%88'),
		urldecode('%F3%BE%87%89'),
		urldecode('%F3%BE%87%8A'),
		urldecode('%F3%BE%87%8B'),
		urldecode('%F3%BE%87%8C'),
		urldecode('%F3%BE%87%8D'),
		urldecode('%F3%BE%87%8E'),
		urldecode('%F3%BE%87%8F'),
		urldecode('%F3%BE%87%90'),
		urldecode('%F3%BE%87%91'),
		urldecode('%F3%BE%87%92'),
		urldecode('%F3%BE%87%93'),
		urldecode('%F3%BE%87%94'),
		urldecode('%F3%BE%87%95'),
		urldecode('%F3%BE%87%96'),
		urldecode('%F3%BE%87%97'),
		urldecode('%F3%BE%87%98'),
		urldecode('%F3%BE%87%99'),
		urldecode('%F3%BE%87%9B'), 
		urldecode('%F3%BE%8C%AC'),
		urldecode('%F3%BE%8C%AD'),
		urldecode('%F3%BE%8C%AE'),
		urldecode('%F3%BE%8C%AF'),
		urldecode('%F3%BE%8C%B0'),
		urldecode('%F3%BE%8C%B2'),
		urldecode('%F3%BE%8C%B3'),
		urldecode('%F3%BE%8C%B4'),
		urldecode('%F3%BE%8C%B6'),
		urldecode('%F3%BE%8C%B8'),
		urldecode('%F3%BE%8C%B9'),
		urldecode('%F3%BE%8C%BA'),
		urldecode('%F3%BE%8C%BB'),
		urldecode('%F3%BE%8C%BC'),
		urldecode('%F3%BE%8C%BD'),
		urldecode('%F3%BE%8C%BE'),
		urldecode('%F3%BE%8C%BF'), 
		urldecode('%F3%BE%8C%A0'),
		urldecode('%F3%BE%8C%A1'),
		urldecode('%F3%BE%8C%A2'),
		urldecode('%F3%BE%8C%A3'),
		urldecode('%F3%BE%8C%A4'),
		urldecode('%F3%BE%8C%A5'),
		urldecode('%F3%BE%8C%A6'),
		urldecode('%F3%BE%8C%A7'),
		urldecode('%F3%BE%8C%A8'),
		urldecode('%F3%BE%8C%A9'),
		urldecode('%F3%BE%8C%AA'),
		urldecode('%F3%BE%8C%AB'), 
		urldecode('%F3%BE%8D%80'),
		urldecode('%F3%BE%8D%81'),
		urldecode('%F3%BE%8D%82'),
		urldecode('%F3%BE%8D%83'),
		urldecode('%F3%BE%8D%84'),
		urldecode('%F3%BE%8D%85'),
		urldecode('%F3%BE%8D%86'),
		urldecode('%F3%BE%8D%87'),
		urldecode('%F3%BE%8D%88'),
		urldecode('%F3%BE%8D%89'),
		urldecode('%F3%BE%8D%8A'),
		urldecode('%F3%BE%8D%8B'),
		urldecode('%F3%BE%8D%8C'),
		urldecode('%F3%BE%8D%8D'),
		urldecode('%F3%BE%8D%8F'),
		urldecode('%F3%BE%8D%90'),
		urldecode('%F3%BE%8D%97'),
		urldecode('%F3%BE%8D%98'),
		urldecode('%F3%BE%8D%99'),
		urldecode('%F3%BE%8D%9B'),
		urldecode('%F3%BE%8D%9C'),
		urldecode('%F3%BE%8D%9E'), 
		urldecode('%F3%BE%93%B2'), 
		urldecode('%F3%BE%93%B4'),
		urldecode('%F3%BE%93%B6'), 
		urldecode('%F3%BE%94%90'),
		urldecode('%F3%BE%94%92'),
		urldecode('%F3%BE%94%93'),
		urldecode('%F3%BE%94%96'),
		urldecode('%F3%BE%94%97'),
		urldecode('%F3%BE%94%98'),
		urldecode('%F3%BE%94%99'),
		urldecode('%F3%BE%94%9A'),
		urldecode('%F3%BE%94%9C'),
		urldecode('%F3%BE%94%9E'),
		urldecode('%F3%BE%94%9F'),
		urldecode('%F3%BE%94%A4'),
		urldecode('%F3%BE%94%A5'),
		urldecode('%F3%BE%94%A6'),
		urldecode('%F3%BE%94%A8'), 
		urldecode('%F3%BE%94%B8'),
		urldecode('%F3%BE%94%BC'),
		urldecode('%F3%BE%94%BD'), 
		urldecode('%F3%BE%9F%9C'), 
		urldecode('%F3%BE%A0%93'),
		urldecode('%F3%BE%A0%94'),
		urldecode('%F3%BE%A0%9A'),
		urldecode('%F3%BE%A0%9C'),
		urldecode('%F3%BE%A0%9D'),
		urldecode('%F3%BE%A0%9E'),
		urldecode('%F3%BE%A0%A3'), 
		urldecode('%F3%BE%A0%A7'),
		urldecode('%F3%BE%A0%A8'),
		urldecode('%F3%BE%A0%A9'), 
		urldecode('%F3%BE%A5%A0'), 
		urldecode('%F3%BE%A6%81'),
		urldecode('%F3%BE%A6%82'),
		urldecode('%F3%BE%A6%83'), 
		urldecode('%F3%BE%AC%8C'),
		urldecode('%F3%BE%AC%8D'),
		urldecode('%F3%BE%AC%8E'),
		urldecode('%F3%BE%AC%8F'),
		urldecode('%F3%BE%AC%90'),
		urldecode('%F3%BE%AC%91'),
		urldecode('%F3%BE%AC%92'),
		urldecode('%F3%BE%AC%93'),
		urldecode('%F3%BE%AC%94'),
		urldecode('%F3%BE%AC%95'),
		urldecode('%F3%BE%AC%96'),
		urldecode('%F3%BE%AC%97'),
		);
		$message = preg_replace('/{{r}}/', $emo[rand(0,count($emo)-1)], $mess);
		return $message;
	}


}