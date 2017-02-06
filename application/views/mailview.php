<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html xmlns:height="http://www.w3.org/1999/xhtml">
<head>
    <title>Falcon Mail</title>
    <base href="http://localhost/falconemail/index.php/mail/"/>
    <link rel='stylesheet prefetch' href='http://localhost/falconemail/style/css/email.css'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Sent</title>
</head>
<body>


<div class="container">
    <div class="mail-box">
        <aside class="sm-side">
            <div class="user-head">
                <div class="user-name">
                    <h5><a href="#"><?php echo $_SESSION['username']; ?></a></h5>
                    <span><a href="#"><?php echo $_SESSION['useremail']; ?></a></span>
                </div>

            </div>


            <div class="inbox-body">
                <a href="#myModal" data-toggle="modal" title="Compose" class="btn btn-compose">
                    Compose
                </a>
                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal"
                     class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" onclick="composeEmail('1')"
                                        type="button">×
                                </button>
                                <h4 class="modal-title">Compose</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="compose/<?php echo $source; ?>" role="form"
                                      class="form-horizontal" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">To</label>
                                        <div class="col-lg-10">
                                            <input type="text" placeholder="" name="email" id="email"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Cc / Bcc</label>
                                        <div class="col-lg-10">
                                            <input type="text" placeholder="" id="cc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Message</label>
                                        <div class="col-lg-10">
                                            <textarea rows="10" cols="30" class="form-control" name="body"
                                                      id="body"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                          <label for="attachment">Attachment</label>
                                                        <input type="file" id="attachment" name="attachment[]" multiple>
                                                      </span>
                                            <button class="btn btn-send" type="submit"
                                            ">
                                            Send
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>


            <ul class="inbox-nav inbox-divider">
                <li <?php
                if ($source == '1') {
                    echo "class='active'";
                } ?>>
                    <a href="inbox"><i class="fa fa-inbox"></i> Inbox </a>

                </li>
                <li <?php
                if ($source == '2') {
                    echo "class='active'";
                } ?>>
                    <a href="sent"><i class="fa fa-envelope-o"></i> Sent Mail</a>
                </li>
                <li <?php
                if ($source == '3') {
                    echo "class='active'";
                } ?>>
                    <a href="drafts"><i class=" fa fa-external-link"></i> Drafts </a>
                </li>
                <li <?php
                if ($source == '4') {
                    echo "class='active'";
                } ?>>
                    <a href="trash"><i class=" fa fa-trash-o"></i> Trash</a>
                </li>
            </ul>
            <div class="inbox-body text-center">
            </div>

        </aside>
        <div class="lg-side">
            <div class="inbox-head">
                <h3>Sent</h3>
                <form action="#" class="pull-right position">
                    <div class="input-append">
                        <input type="text" class="sr-input" placeholder="Search Mail">
                        <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>

            <div class="inbox-body">
                <div class="modal-header">
                    <button class="btn" type="submit"
                            onclick="location.href='http://localhost/falconemail/index.php/mail/<?php
                            if ($source == 1) {
                                echo 'inbox';
                            } elseif ($source == 2) {
                                echo 'sent';
                            } elseif ($source == 3) {
                                echo 'drafts';
                            } elseif ($source == 4) {
                                echo 'trash';
                            }
                            ?>'">Back
                    </button>

                    <?php if($source != 3){?>

                    <a href="#myModa" data-toggle="modal" title="Forward" class="btn btn-forward">
                        Forward
                    </a>
                    <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModa"
                         class="modal fade" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close"
                                            onclick="composeEmail('1')" type="button">×
                                    </button>
                                    <h4 class="modal-title">Forward</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="forward/<?php echo $source; ?>" role="form"
                                          class="form-horizontal" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">To</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="" name="email" id="email"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Message</label>
                                            <div class="col-lg-10">
                                                <textarea rows="10" cols="30" class="form-control" name="body"
                                                          id="body"></textarea>
                                            </div>
                                        </div>
                                        <?php
                                        $jsonarray = json_decode($message);
                                        $mail_data = $jsonarray->data;
                                        foreach ($mail_data as $mail) {
                                            if (sizeof($mail->cc_emails) > 0) {
                                                foreach ($mail->cc_emails as $cc_email) {
                                                    echo '
                                                        <div class="form-group">
                                                        <input type="hidden" id="data" name="data[]" class="form-control" value="' . $cc_email->inbox_id . '" />
                                                        </div>';
                                                }
                                            } else {
                                                echo '
                    <div class="form-group">
                    <input type="hidden" id="data" name="data[]" class="form-control" value="' . $mail->inbox_id . '" />
                    </div>';
                                            }
                                        }
                                        ?>

                                        <button class="btn btn-send" type="submit">
                                            Send
                                        </button>

                                    </form>


                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <button class="btn btn-delete" type="submit" onclick='  moveToTrash(
                    <?php
                    if($source == 1) {
                        $jsonarray = json_decode($message);
                        $mail_data = $jsonarray->data;
                        foreach ($mail_data as $mail) {
                            $inbox_ids = array();
                            if (sizeof($mail->cc_emails) > 0) {

                                foreach ($mail->cc_emails as $cc_email) {
                                    array_push($inbox_ids, $cc_email->inbox_id);
                                }
                                echo json_encode($inbox_ids);
                            } else {
                                array_push($inbox_ids, $mail->inbox_id);
                                echo json_encode($inbox_ids);
                            }
                        }
                    }elseif($source == 2 ){
                        $jsonarray = json_decode($message);
                        $mail_data = $jsonarray->data;
                        foreach ($mail_data as $mail) {
                            $sent_ids = array();
                            if (sizeof($mail->cc_emails) > 0) {

                                foreach ($mail->cc_emails as $cc_email) {
                                    array_push($sent_ids, $cc_email->sent_id);
                                }
                                echo json_encode($sent_ids);
                            } else {
                                array_push($sent_ids, $mail->sent_id);
                                echo json_encode($sent_ids);
                            }
                        }
                    }

                    echo ",";
                       echo $source; ?>     )'>Delete
                    </button>

                    <?php } else{ ?>
                    <a href="#myModa" data-toggle="modal" title="Resend" class="btn btn-send">
                        Resend
                    </a>
                    <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModa"
                         class="modal fade" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"
                                            onclick="composeEmail('1')" type="button">×
                                    </button>
                                    <h4 class="modal-title">Forward</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="compose/3/<?php echo $message_id;?>" role="form"
                                          class="form-horizontal" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">To</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="" name="email" id="email"
                                                       class="form-control" value="<?php
                                                $jsonarray = json_decode($message);
                                                $mail_data = $jsonarray->data;
                                                foreach ($mail_data as $mail) {
                                                    echo $mail->to_email;
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Subject</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="" id="subject" name="subject" class="form-control"
                                                       required value="<?php
                                                $jsonarray = json_decode($message);
                                                $mail_data = $jsonarray->data;
                                                foreach ($mail_data as $mail) {
                                                    echo $mail->subject;
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Message</label>
                                            <div class="col-lg-10">
                                                <textarea rows="10" cols="30" class="form-control" name="body"
                                                          id="body" ><?php echo $mail->body;?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                          <label for="attachment">Attachment</label>
                                                        <input type="file" id="attachment" name="attachment[]" multiple>
                                                      </span>
                                                <button class="btn btn-send" type="submit" name = "send" id = "send"
                                                        onClick="submitform();this.disabled=true;this.value='Submitting...'">
                                                    Send
                                                </button>
                                            </div>
                                        </div>

                    </form>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
                    <?php } ?>

                </div>
            </div>

            <?php
            if ($message) {
//                        echo $message;
            $jsonarray = json_decode($message);
            $mail_data = $jsonarray->data;
            foreach ($mail_data as $mail) {
            ?>

            <div class="mail" style="margin-left:20px;">
                <div class="mail-container">
                    <br>
                    <h4 class="subject"><?php echo $mail->subject; ?></h4>
                    <h5><i class="from"></i> <?php

                        if ($source == '2') {
                            echo "to   ";
                            $size = sizeof($mail->cc_emails);
                            if ($size > 0) {
                                $i = $size - 1;
                                foreach ($mail->cc_emails as $cc_email) {
                                    echo " ";
                                    echo $cc_email->email_address;
                                    if ($i) {
                                        $i--;
                                        echo ",";
                                    }
                                }
                            } else {
                                echo $mail->to_username;
                            }
                        } elseif ($source == '1') {
                            echo "from   ";
                            $size = sizeof($mail->cc_emails);
                            if ($size > 0) {
                                $i = $size - 1;
                                foreach ($mail->cc_emails as $cc_email) {
                                    echo " ";
                                    echo $cc_email->email_address;
                                    if ($i) {
                                        $i--;
                                        echo ",";
                                    }
                                }
                            } else {
                                echo $mail->from_username;
                            }
                        }elseif ($source == '3') {
                            echo "to   ";
                            echo $mail->to_email;

                        };
                        ; ?></h5>

                    <hr>
                    <p><?php echo $mail->body; ?></p>

                    <?php
                    if($source != 3) {
                        if (sizeof($mail->attachments) > 0) { ?>
                            <hr>
                            <h5 class="subject">Attachments:</h5>
                            <?php
                            foreach ($mail->attachments as $attachment) {
                                if ($attachment->file_name != null) {
                                    ?>
                                    <div class="col-md-4">
                                        <iframe src="http://localhost/falconemail/attachments/<?php echo $attachment->file_name; ?>"
                                                style="width:160px; height:100px;" frameborder="0"></iframe>

                                        <form method="get" target="_blank"
                                              action="http://localhost/falconemail/attachments/<?php echo $attachment->file_name; ?>">
                                            <button class="btn btn-download" type="submit">Download</button>
                                        </form>
                                    </div>


                                <?php }
                            }
                        }
                    }?>

                </div>

                <?php
                if($source != 3) {
                    if (sizeof($mail->replies) > 0) {
                        $i = 20;
                        foreach ($mail->replies as $reply) {
                            ?>

                            <div class="col-md-12">

                                <div class="mailview" style="margin-left:<?php echo $i; ?>px;">
                                    <div class="mail-container">
                                        <br>
                                        <h5><i class="from"></i> <?php
                                            if ($source == '2') {
                                                echo $reply->email_address;
                                                echo "   says at   ";
                                                $php_timestamp_date = date("m/d/Y", strtotime($mail->received_date));
                                                echo "" . $php_timestamp_date . "";
                                            } elseif ($source == '1') {
                                                echo $reply->email_address;
                                                echo "   says at   ";
                                                $php_timestamp_date = date("m/d/Y", strtotime($mail->received_date));
                                                echo "" . $php_timestamp_date . "";
                                            }; ?></h5>

                                        <p><?php echo $reply->body; ?></p>
                                        <hr>
                                        <?php if ($reply->attachments) {
                                            foreach ($reply->attachments as $attachment) {
                                                if ($attachment->file_name != null) {
                                                    ?>

                                                    <div class="col-md-4">
                                                        <h5 class="subject">Attachments:</h5>
                                                        <iframe src="http://localhost/falconemail/attachments/<?php echo $attachment->file_name; ?>"
                                                                style="width:160px; height:100px;" frameborder="0"
                                                                frameborder="0"></iframe>
                                                        <form method="get" target="_blank"
                                                              action="http://localhost/falconemail/attachments/<?php echo $attachment->file_name; ?>">
                                                            <button class="btn btn-download" type="submit">Download
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php }
                                            }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i = $i + 20;
                        }
                    }
                }
                ?>

                <?php
                }
                }
                ?>


            </div>
            <?php if($source != 3) {?>
            <div class="col-md-12">
                <div class="reply">
                    <hr>

                    <form method="post" action="reply/<?php echo $source; ?>/<?php echo $message_id; ?>" role="form"
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        <h5 class="subject">Reply</h5>
                        <div class="form-group">
                            <div class="col-lg-10">
                                <textarea class="form-control" id="reply" name="reply"></textarea>
                            </div>
                        </div>

                        <?php

                            if (sizeof($mail->cc_emails) > 0) {
                                foreach ($mail->cc_emails as $cc_email) {
                                    echo '
                    <div class="form-group">
                    <input type="hidden" id="data" name="data[]" class="form-control" value="' . $cc_email->inbox_id . '" />
                    </div>';
                                }
                            } else {
                                echo '
                    <div class="form-group">
                    <input type="hidden" id="data" name="data[]" class="form-control" value="' . $mail->inbox_id . '" />
                    </div>';
                            }

                        ?>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                        <label for="attachment">Attachment</label>
                                                        <input type="file" id="attachment" name="attachment[]"
                                                               multiple>
                                                      </span>
                                <button class="btn btn-send" type="submit"
                                        onClick="submitform();this.disabled=true;this.value='Submitting...'">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php }?>
                <div>
                </div>

                </aside>
            </div>
        </div>

        <script>
            function moveToTrash(inbox_ids, source) {

                console.log(inbox_ids);

                $.ajax({
                    type: "POST",
                    data: {
                        inbox_ids: inbox_ids,
                        source:source
                    },
                    dataType: "JSON",
                    url: "http://localhost/falconbackend/v1/mt",
                    error: function (data, jqXHR, textStatus, errorThrown) {
                        console.log(textStatus + ': ' + errorThrown);
                    },
                    success: function (data) {
                        console.log("successs");
                        window.location = 'http://localhost/falconemail/index.php/mail/<?php echo "sent";?>';
                    }

                });
                console.log(email);
            }
        </script>


        <script>

            function submitform() {
                var f = document.getElementsByTagName('email');
                if(f.checkValidity()) {
                    f.submit();
                } else {
                    alert(document.getElementById('email').validationMessage);
                }
            }

        </script>

</body>
</html>
