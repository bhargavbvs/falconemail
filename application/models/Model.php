<?php

class Model extends CI_Model
{

    public function do_post_request($baseurl, $where)
    {
        $url = $baseurl . '/' . $where;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('userid' => $_SESSION['userid'])));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        return $result;
    }

    public function get_mail_data($message_id, $baseurl, $from, $is_read =1)
    {

        $url = $baseurl . '/message';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('message_id' => $message_id, 'from' => $from,
            'userid' => $_SESSION['userid'], 'is_read'=> $is_read)));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        return $result;
    }

    public function compose($baseurl, $email, $subject, $body, $attachment, $draft_id)
    {
        $url = $baseurl . '/compose';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(
                array(
                    'email' => $email,
                    'subject' => $subject,
                    'userid' => $_SESSION['userid'],
                    'body' => $body,
                    'forwarded' => 0,
                    'draft' => 0,
                    'attachment' => $attachment,
                    'draft_id' => $draft_id)
            )
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        return $result;
    }

    public function forward($baseurl, $inbox_ids, $body, $emails)
    {
        $url = $baseurl . '/forward';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(
                array(
                    'inbox_ids' => $inbox_ids,
                    'body' => $body,
                    'userid' => $_SESSION['userid'],
                    'emails'=>$emails)
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        return $result;
    }

    public function reply($baseurl, $inbox_ids, $reply, $attachment)
    {
        $url = $baseurl . '/reply';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(
                array(
                    'inbox_ids' => $inbox_ids,
                    'reply' => $reply,
                    'userid' => $_SESSION['userid'],
                    'attachments' => $attachment
                )
            )
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        return $result;
    }
}