<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{
	function index(){
		print_r($_REQUEST);
	if($this->input->post('id')){
		$img = $_FILES['img']; 
		if($img['name']==''){
			echo '<script>alert("Vui long chon file upload")</script>';
		}else{
			$filename = $img['tmp_name']; 
			$client_id="3f9a53bd5ebb2fa"; 
			$handle = fopen($filename, "r"); 
			$data = fread($handle, filesize($filename)); 
			$pvars   = array('image' => base64_encode($data)); 
			$this->load->model('m_test');
			$upload_done = $this->m_test->test($client_id, $pvars);
			if($upload_done == false){
				echo '<script>alert("Khong the download")</script>';
			}else{
				echo $upload_done;
			}
		}
		exit;
	}

		echo '
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<form action="" enctype="multipart/form-data" id="upload_file"> 
		<input type="hidden" name="id" value="1">
 Choose Image : <input name="img" size="35" type="file" id="img"/><br/> 

 <input type="submit" name="submit" value="Upload"/> 
</form> 
';
	$this->load->view('test');
}
	function abc(){

		$this->load->model('m_test');
		print_r($_POST);
		$this->load->view('test2');
		

	}

}