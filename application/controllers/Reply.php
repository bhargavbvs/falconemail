<?php

class Reply extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
		if(!empty($_SESSION["userid"])){
			$this->load->helper('url');
			redirect('Inbox');
		}

		// $this->load->model('LoginModel');
	}

	public function index(){
		$this->load->view('replyview');
	}
}

?>