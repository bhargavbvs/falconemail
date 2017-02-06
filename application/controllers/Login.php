<?php

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!isset($_SESSION))
    {
        session_start();
    }
		if(!empty($_SESSION["userid"])){
			$this->load->helper('url');
			redirect('mail');
		}
	}

	public function index(){
		$this->load->view('loginview');
	}

	public function get_user_id(){
		if($this->input->is_ajax_request()){
			if(!empty($_POST)){
				$user_id = $_POST['userid'];
				$user_name = $_POST['username'];
                $user_email = $_POST['useremail'];

                $_SESSION["userid"] = $user_id;
                $_SESSION["username"] = $user_name;
                $_SESSION["useremail"] = $user_email;
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