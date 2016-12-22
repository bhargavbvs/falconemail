<?php

class SentModel extends CI_Model
{
    
    public function do_post_request($baseurl) {
        $url = $baseurl.'/sent';
        // $fields = array('userid'=>'1');

        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('userid' => $_SESSION['userid'])));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        return $result;
      }

    public function get_mail_data($message_id, $baseurl){
        $url = $baseurl.'/message';
        // $fields = array('userid'=>'1');

        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('message_id' => $message_id, 'from' => 2)));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        return $result;
    }
}