<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Falcon Mail</title>
    <base href="http://localhost/falconemail/index.php/mail/" />
    <link rel='stylesheet prefetch' href='http://localhost/falconemail/style/css/email.css'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>
        <?php
        if ($source == '1') {
            echo "Inbox";
        }
        if ($source == '2') {
            echo "Sent";
        }
        if ($source == '3') {
            echo "Drafts";
        }
        if ($source == '4') {
            echo "Trash";
        }
        ?>
    </title>
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
                     class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" onclick="composeEmail('1')"
                                        type="button">×
                                </button>
                                <h4 class="modal-title">Compose</h4>
                            </div>
                            <div class="modal-body">
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                <form method="post" action="compose/<?php echo $source;?>" role="form"
                                      class="form-horizontal" enctype="multipart/form-data" id="myForm">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">To</label>
                                        <div class="col-lg-10">
                                                <input type="text" placeholder="" name="email" id="email" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Subject</label>
                                        <div class="col-lg-10">
                                            <input type="text" placeholder="" id="subject" name="subject" class="form-control"
                                            required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Message</label>
                                        <div class="col-lg-10">
                                            <textarea rows="10" cols="30" class="form-control" name="body" id="body"
                                            required></textarea>
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
                                                    onClick="this.disabled = true;this.form.submit();"
                                                    >
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
                    <a href="inbox"><i class="fa fa-inbox"></i> Inbox
                        <?php if($source == 1){?>
                        <span
                                class="label label-danger pull-right">
                       <?php if ($mails) {
//                        print_r($mails);
                           $i = 1;
                           $jsonarray = json_decode($mails);
                           $mail_data = $jsonarray->data;
                           $count = 0;
                           foreach ($mail_data as $mail) {
                                if(!($mail->is_read)) {
                                    $count++;
                                }
                           }
                           echo $count;
                       }
                            ?>

                        </span>
                        <?php }?>

                    </a>
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
        <aside class="lg-side">
            <div class="inbox-head">
                <h3><?php
                    if ($source == '1') {
                        echo "Inbox";
                    }
                    if ($source == '2') {
                        echo "Sent";
                    }
                    if ($source == '3') {
                        echo "Drafts";
                    }
                    if ($source == '4') {
                        echo "Trash";
                    }
                    ?></h3>

            </div>
            <div class="inbox-body">
                <div class="mail-option">
                <table class="table table-inbox table-hover">
                    <tbody>

                    <?php
                    if ($mails) {
//                        print_r($mails);
                        $i = 1;
                        $jsonarray = json_decode($mails);
                        $mail_data = $jsonarray->data;
                        foreach ($mail_data as $mail) {
                            ?>
                            <tr class=<?php
                            if($source == '1') {
                                if ($mail->is_read) {
                                    echo "read";
                                } else {
                                    echo "unread";
                                }
                            }else{
                                echo "read";
                            }
                            if($source != 4) { ?>
                                onclick="location.href='http://localhost/falconemail/index.php/mail/show_view/ <?php
                                }
                                if($source != 4) {
                                    echo $mail->id;
                                    echo '/';
                                    echo $source;
                                }?>';">
                                <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                <td class="view-message  dont-show"><?php
                                    if ($source == '2') {
                                        $size = sizeof($mail->cc_emails);
                                        if($size >0) {
                                            $i = $size -1;
                                            foreach ($mail->cc_emails as $cc_email) {
                                                echo " ";
                                                echo $cc_email->username;
                                                if($i) {
                                                    $i--;
                                                    echo ",";
                                                }
                                            }
                                        }else{
                                            echo $mail->to_username;
                                        }
                                    } elseif ($source == '1') {
                                        $size = sizeof($mail->cc_emails);
                                        if($size >0) {
                                            $i = $size -1;
                                            foreach ($mail->cc_emails as $cc_email) {
                                                echo " ";
                                                echo $cc_email->username;
                                                if($i) {
                                                    $i--;
                                                    echo ",";
                                                }
                                            }
                                        }else{
                                            echo $mail->from_username;
                                        }
                                    }elseif ($source == '4') {
                                        echo $mail->username;

                                    }elseif ($source == '3') {
                                        echo $mail->to_user;

                                    };
                                    if($source != 4 && $source != 3) {
                                        if (count($mail->replies) > 0) {
                                            echo "  (";
                                            echo count($mail->replies);
                                            echo ")";
                                        }
                                    }?> <span class="label label-danger"><?php
                            if($source != 3) {
                                if ($mail->forwarded == 1) {
                                    echo "forwarded";
                                }
                            }?></span></td>
                                <td class="view-message "><?php echo $mail->subject; ?></td>
                                <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                <td class="view-message  text-right"><?php
                                    $php_timestamp_date =date("Y-F-d H:i:s", strtotime($mail->received_date));
                                    echo "".$php_timestamp_date.""; ?></td>
                            </tr>

                            <?php
                            $i++;
                        }

                    }

                    ?>

                    </tbody>
                </table>
            </div>
        </aside>
    </div>
</div>

<script>

    function composeEmail(draft) {

        var email = document.getElementById('email').value;
        var subject = document.getElementById('subject').value;
        var body = document.getElementById('body').value;

        attachment= '';

        $.ajax({
            type: "POST",
            data: {
                userid: <?php echo $_SESSION['userid']; ?>,
                email: email,
                subject: subject,
                body: body,
                forwarded: '0',
                draft: 1,
                attachment:''
            },
            dataType: "JSON",
            url: "http://localhost/falconbackend/v1/compose",
            error: function (data, jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            },
            success: function (data) {
                console.log("successs");
                return true;
            }

        });
        console.log(email);
    }
</script>

<script>

//    function submitform() {
//        var f = document.getElementsByTagName('email');
//        var button = $('#send');
////        if(!f.checkValidity()) {
////            alert(document.getElementById('email').validationMessage);
////        }
//        button.prop('disabled', true);
//        f.submit();
//    }

    $('myForm').formValidation({
        ...
    }).on('success.myForm.fv', function(e) {
    $('#send').prop('disabled', true);
        e.preventDefault();
        var $form = $(e.target);

        // Enable the submit button
        $form.formValidation('disableSubmitButtons', false);
    });



</script>

</body>
</html>
