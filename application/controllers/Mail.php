<?php

class Mail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        if (empty($_SESSION["userid"])) {
            $this->load->helper('url');
            redirect("http://localhost/falconemail/index.php/Login");
        }
        $this->load->model('Model');
    }

    public function index()
    {
        $this->inbox();
    }

    public function inbox()
    {
        $data['mails'] = $this->Model->do_post_request(base_url(), 'inbox');
        $data['source'] = '1';
        $this->load->view('view', $data);
    }

    public function sent()
    {
        $data['mails'] = $this->Model->do_post_request(base_url(), 'sent');
        $data['source'] = '2';
        $this->load->view('view', $data);
    }

    public function drafts()
    {
        $data['mails'] = $this->Model->do_post_request(base_url(), 'drafts');
        $data['source'] = '3';
        $this->load->view('view', $data);
    }

    public function trash()
    {
        $data['mails'] = $this->Model->do_post_request(base_url(), 'trash');
        $data['source'] = '4';
        $this->load->view('view', $data);
    }

    public function compose($from, $draft_id= 0)
    {
        if (!empty($_POST['email']) && !empty($_POST['body']) && !empty($_POST['subject'])) {

            $subject = $_POST['subject'];
            $body = $_POST['body'];
            $emails = $_POST['email'];
            $attachments = array();

            if (!empty($_FILES['attachment'])) {
                $myFile = $_FILES['attachment'];
                $fileCount = count($myFile["name"]);

                for ($i = 0; $i < $fileCount; $i++) {
                    $file_name = $myFile['name'][$i];
                    array_push($attachments, $file_name);
                    $tmp_name = $myFile['tmp_name'][$i];
                    $target = 'C:\xampp\htdocs\falconemail\attachments/';

                    $target = $target . basename($file_name);
                    if (move_uploaded_file($tmp_name, $target)) {
//                $this->load->view('sentview');
                    } else {
                        echo "Sorry, there was a problem uploading your file.";
                    }
                }
            }

            $result = $this->Model->compose(base_url(), $emails, $subject, $body, $attachments, $draft_id);

            $this->redirect($from);

        } else {
            $this->redirect($from);
        }
    }

    public function reply($from, $message_id)
    {
        if (!empty($_POST['reply'])) {

            $reply = $_POST['reply'];
            $inbox_ids = $_POST['data'];
            $attachments = array();

            if (!empty($_FILES['attachment'])) {
                $myFile = $_FILES['attachment'];
                $fileCount = count($myFile["name"]);

                for ($i = 0; $i < $fileCount; $i++) {
                    $file_name = $myFile['name'][$i];
                    array_push($attachments, $file_name);
                    $tmp_name = $myFile['tmp_name'][$i];
                    $target = 'C:\xampp\htdocs\falconemail\attachments/';

                    $target = $target . basename($file_name);
                    if (move_uploaded_file($tmp_name, $target)) {
//                $this->load->view('sentview');
                    }
                }
            }

            $result = $this->Model->reply(base_url(), $inbox_ids, $reply, $attachments);

            $message_id = 'xyz' . $message_id;
            $this->show_view($message_id, $from, 0);
        } else {
            $this->redirect($from);
        }
    }


    public function forward($from)
    {
        if (!empty($_POST['email'])) {

            $body = $_POST['body'];
            $emails = $_POST['email'];
            $inbox_ids = $_POST['data'];

            $this->Model->forward(base_url(), $inbox_ids, $body, $emails);
            $this->redirect($from);

        } else {
            $this->redirect($from);
        }
    }

    public function save_draft($from)
    {
        if (!empty($_POST['email'])) {

            $body = $_POST['body'];
            $emails = $_POST['email'];
            $inbox_ids = $_POST['data'];

            $this->Model->forward(base_url(), $inbox_ids, $body, $emails);
            $this->redirect($from);

        } else {
            $this->redirect($from);
        }
    }

    public function delete_mail($from)
    {
        if (!empty($_POST['email'])) {

            $body = $_POST['body'];
            $emails = $_POST['email'];
            $inbox_ids = $_POST['data'];

            $this->Model->forward(base_url(), $inbox_ids, $body, $emails);
            $this->redirect($from);

        } else {
            $this->redirect($from);
        }
    }

    public function show_view($message_id, $source, $is_read = 1)
    {
        $message_id = substr($message_id, 3);
        $data['message'] = $this->Model->get_mail_data($message_id, base_url(), $source, $is_read);
        $data['message_id'] = $message_id;
        $data['source'] = $source;
        $this->load->view('mailview', $data);
    }

    public function redirect($to)
    {
        if ($to == 1) {
            redirect('http://localhost/falconemail/index.php/mail/inbox');
        } elseif ($to == 2) {
            redirect('http://localhost/falconemail/index.php/mail/sent');
        } elseif ($to == 3) {
            redirect('http://localhost/falconemail/index.php/mail/drafts');
        } elseif ($to == 4) {
            redirect('http://localhost/falconemail/index.php/mail/trash');
        }
    }

}

?>