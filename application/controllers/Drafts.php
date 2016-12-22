<?php

class Drafts extends CI_Controller {

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
		$this->load->model('DraftsModel');
	}

	public function index(){
		$data['url'] = 'http://localhost/falconbackend/v1/';
		$data['mails'] = $this->DraftsModel->do_post_request($data['url']);
		// echo $data;
		$this->load->view('draftsview', $data);
	}

}

?>