<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_test extends CI_Model
{
	function upload_imgur($client_id, $image){
		  $curl = curl_init(); 
		  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		  curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json'); 
		  curl_setopt($curl, CURLOPT_TIMEOUT, 30); 
		  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id)); 
		  curl_setopt($curl, CURLOPT_POST, 1); 
		  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		  curl_setopt($curl, CURLOPT_POSTFIELDS, $image); 
		  $out = curl_exec($curl); 
		  curl_close ($curl); 
		  $pms = json_decode($out,true); 
		  $url = $pms['data']['link']; 
		  if($url != ''){
		  	return $url;
		  }else{
		  	return false;
		  }
	}
	function test($client_id,$pvars, $timeout=30){
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
		  $url=$pms['data']['link']; 
		  if($url!=""){ 
		   return $url;
		  }else{ 
		   return false;
		  }
	}

}