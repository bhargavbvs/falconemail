<?php

class Inbox extends CI_Controller {

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
		$this->load->model('InboxModel');
		
	}

	public function index(){
		$data['url'] = 'http://localhost/falconbackend/v1/';
		$data['mails'] = $this->InboxModel->do_post_request($data['url']);
		// echo $data;
		$this->load->view('inboxview', $data);

	}

	// public ActionResult 

	public function show_mail_details(){
		if($this->input->is_ajax_request()){
			if(!empty($_POST)){
				$subject=$_POST['subject'];
				$body=$_POST['body'];
				$date=$_POST['date'];
				echo '{"error": false}';
			}
			else{
				$data['message']='not post error';
			}
		}
		else{
			$data['message']='not ajax error';
		}

		// echo json_encode($data);
		exit;
	}

	public function show_view($message_id){
		$data['url'] = 'http://localhost/falconbackend/v1/';
		$data['message'] = $this->InboxModel->get_mail_data($message_id, $data['url']);
		$data['message_id'] = $message_id;
		// echo var_dump($data['message']);
		$this->load->view('mailview', $data);
		
	}
				


}

?>