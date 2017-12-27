<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_func extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function convert_day_to_mktime($h, $d){
		$h_arr = explode(':', $h);
		$d_arr = explode('/', $d);
		return mktime($h_arr[0],$h_arr[1],0,$d_arr[0],$d_arr[1],$d_arr[2]);
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
	
	public function curl_url_cookie($url,$cookie, $browser = 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14'){
	    $ch = @curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    $head[] = "Connection: keep-alive";
	    $head[] = "Keep-Alive: 300";
	    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	    $head[] = "Accept-Language: en-us,en;q=0.5";
	    curl_setopt($ch, CURLOPT_USERAGENT, $browser);
	    curl_setopt($ch, CURLOPT_ENCODING, '');
	    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
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
	function check_isset_db($idfb, $where){
		$this->db->where('idfb', $idfb);
		$ok = $this->db->get($where);
		if($ok->num_rows() > 0){
			return false;
		}else{
			return true;
		}
	}
	function upload_imgur($client_id,$pvars, $timeout=30){
		  $curl = curl_init(); 
		  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		  curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json'); 
		  curl_setopt($curl, CURLOPT_TIMEOUT, $timeout); 
		  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id)); 
		  curl_setopt($curl, CURLOPT_POST, 1); 
		  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		  curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars); 
		  $out = curl_exec($curl); 
		  curl_close ($curl); 
		  $pms = json_decode($out,true); 
		  if(isset($pms['data']['link'])){
		  	return $pms['data']['link'];
		  }else{
		  	return false;
		  }
	}

	public function post_data_cookie($site,$data,$cookie, $browser = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'){
	    $datapost = curl_init();
	    $headers = array("Expect:");
	    curl_setopt($datapost, CURLOPT_URL, $site);
	    curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
	    curl_setopt($datapost, CURLOPT_HEADER, TRUE);
	    curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($datapost, CURLOPT_USERAGENT, $browser);
	    curl_setopt($datapost, CURLOPT_POST, TRUE);
	    curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($datapost, CURLOPT_COOKIE,$cookie);
	    ob_start();
	    return curl_exec ($datapost);
	    ob_end_clean();
	    curl_close ($datapost);
	    unset($datapost); 
	}
	function get_money($id){
		$this->db->where('id', $id);
		$bg = $this->db->get('member');
		$ok = $bg->result_array();
		return $ok[0]['money'];
	}

	function check_money($use, $id){
		if($use > $this->get_money($id)){
			return FALSE;
		}else{
			return true;
		}
	}
	function email_to_id($e){
		$this->db->where('email', $e);
		$query = $this->db->get('member');
		$result = $query->result_array();
		return $result[0]['id'];
	}
	function tru_tien($tien, $id){
		return $this->db->query("UPDATE member SET money = money -$tien WHERE id = $id");

	}
	public function timeAgo($time_ago){
		  $cur_time 	= time();
		  $time_elapsed = $cur_time - $time_ago;
		  $seconds 		= $time_elapsed ;
		  $minutes 		= round($time_elapsed / 60 );
		  $hours 		= round($time_elapsed / 3600);
		  $days 		= round($time_elapsed / 86400 );
		  $weeks 		= round($time_elapsed / 604800);
		  $months 		= round($time_elapsed / 2600640 );
		  $years 		= round($time_elapsed / 31207680 );
		  // Seconds
		  if($seconds <= 60){
			return "$seconds giây trước";
		  }
		  //Minutes
		  else if($minutes <=60){
			if($minutes==1){
			  return "1 phút trước";
			}
			else{
			  return "$minutes phút trước";
			}
		  }
		  //Hours
		  else if($hours <=24){
			if($hours==1){
			  return "1 giờ trước";
			}else{
			  return "$hours giờ trước";
			}
		  }
		  //Days
		  else if($days <= 7){
			if($days==1){
			  return "hôm qua";
			}else{
			  return "$days ngày tước";
			}
		  }
		  //Weeks
		  else if($weeks <= 4.3){
			if($weeks==1){
			  return "1 tuần trước";
			}else{
			  return "$weeks tuần trước";
			}
		  }
		  //Months
		  else if($months <=12){
			if($months==1){
			  return "1 tháng trước";
			}else{
			  return "$months tháng trước";
			}
		  }
		  //Years
		  else{
			if($years==1){
			  return "1 năm trước";
			}else{
			  return "$years năm trước";
			}
		  }
	}


	public function time_remaining($so_giay){
		$dt1 = new DateTime("@0");  
    	$dt2 = new DateTime("@$so_giay");  
    	return $dt1->diff($dt2)->format('%a ngày, %h giờ'); 
	}

	function name_admin($admin){
		switch ($admin) {
			case '1':
				$name = 'QUẢN TRỊ VIÊN';
				break;
			case '2':
				$name = 'QUẢN LÝ';
				break;
			case '3':
				$name = 'CỘNG TÁC VIÊN';
				break;
			default:
				$name = 'KHÁCH HÀNG';
				break;
		}
		return $name;
	}
	function get_gia($where){
		$this->db->where('id', 1);
		$bg = $this->db->get('bang_gia');
		$ok = $bg->result_array();
		return $ok[0][$where];
	}
	function check_user_creat($table, $user_creat, $id){
		$this->db->where('id', $id);
		$this->db->where('user_creat', $user_creat);
		$bg = $this->db->get($table);
		if($bg->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function name_reactions($id){
		switch ($id) {
			case '1':
				return 'LIKE';
				break;
			case '2':
				return 'LOVE';
				break;
			case '3':
				return 'HAHA';
				break;
			case '4':
				return 'WOW';
				break;
			case '5':
				return 'ANGRY';
				break;
			case '6':
				return 'SAD';
				break;
			default:
				return 'RANDOM';
				break;
		}
	}
	function strMiddleReduceWordSensitive($string, $max = 50, $rep = '[...]') {
		   $strlen = strlen($string);
		    
		    if ($strlen <= $max)
		    return $string;
		     
		   $lengthtokeep=$max - strlen($rep);
		   $start = 0;
		   $end = 0;
		     
		    if (($lengthtokeep % 2) == 0) {
		       $start = $lengthtokeep / 2;
		       $end = $start;
		   } else {
		       $start = intval($lengthtokeep / 2)+2;
		       $end = $start - 5;
		   }
		   $i = $start;
		   $tmp_string = $string;
		   while ($i < $strlen) {
		       if (isset($tmp_string[$i]) and $tmp_string[$i] == ' ') {
		           $tmp_string = mb_substr($tmp_string, 0, $i,'UTF-8') . $rep;
		           $return = $tmp_string;
		       }
		       $i++;
		   }
		    
		   $i = $end;
		   $tmp_string = strrev ($string);
		   while ($i < $strlen) {
		       if (isset($tmp_string[$i]) and $tmp_string[$i] == ' ') {
		           $tmp_string = mb_substr($tmp_string, 0, $i,'UTF-8');
		           $return .= strrev ($tmp_string);
		       }
		       $i++;
		   }
		   if(isset($return)) return $return;
		   return mb_substr($string, 0, $start,'UTF-8') . $rep . mb_substr($string, - $end,'UTF-8');
	}
}