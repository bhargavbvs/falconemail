<?php

class Sent extends CI_Controller {

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
		$this->load->model('SentModel');
	}

	public function index(){
		$data['url'] = 'http://localhost/falconbackend/v1/';
		$data['mails'] = $this->SentModel->do_post_request($data['url']);
		// echo $data;
		$this->load->view('sentview', $data);

	}

	// public ActionResult 

	public function show_mail_details(){
		if($this->input->is_ajax_request()){
			if(!empty($_POST)){
				$subject=$_POST['subject'];
				$body=$_POST['body'];
				$date=$_POST['date'];
				echo '{"error": false}';
				// $this->load->view('mailview', TRUE);
				// echo $data;
				// $this->load->view('mailview', $object);
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
		$data['message'] = $this->SentModel->get_mail_data($message_id, $data['url']);
		$data['message_id'] = $message_id;
		// echo var_dump($data['message']);
		$this->load->view('mailview', $data);
		
	}
				


}

?>