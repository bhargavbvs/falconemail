<?php

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		session_write_close();

		if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
		if(!empty($_SESSION["userid"])){
			$this->load->helper('url');
			redirect('Inbox');
		}
	}

	public function index(){
		$this->load->view('loginview');
	}

	public function get_user_id(){
		if($this->input->is_ajax_request()){
			if(!empty($_POST)){
				$userid=$_POST['userid'];
				$_SESSION["userid"] = $userid;
				echo '{"error": false}';
			}
			else{
				$data['message']='not post error';
			}
		}
		else{
			$data['message']='not ajax error';
		}
	}
}

?>