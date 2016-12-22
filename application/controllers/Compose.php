<?php

class Compose extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION)) 
    	{ 
        	session_start(); 
    	} 
		
		if (empty($_SESSION["userid"])) {
			$this->load->helper('url');
			redirect("Login");
		}
	}

	public function index(){
		$this->load->view('composeview');

	}


				


}

?>