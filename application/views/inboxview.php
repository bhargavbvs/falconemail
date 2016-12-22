<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<!doctype html>
<html><body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<button type="button" id = "Inbox" onclick="taketo('Inbox')">Inbox</button>

<button type="button" onclick="taketo('Sent')">Sent</button>

<button type="button" onclick="taketo('Drafts')">Drafts</button>

<button type="button" onclick="taketo('Trash')">Trash</button>

<button type="button" onclick="taketo('Compose')">Compose</button>

<table  bgcolor="#C0C0C0" id='myTable'>

        <tbody id="data"  data-link="row" class="rowlink">

          <?php
          if ($mails) {
              $i = 1;
              $jsonarray = json_decode($mails);
              $mail_data = $jsonarray->data;
              foreach ($mail_data as $mail) {

              	?>

              	<tr>

              <td  onClick= "">
              	<a href=<?php echo "Inbox/show_view"; echo "/"; echo $mail->message_id;?>>
    				<div style="height:100%;width:70%">
      					<?php echo $mail->subject?>
   					 </div
  				</a>
  				</td>

              <!-- <a href="" </a></td> -->
              
              	<td><?php echo $mail->date ?></td>

            </tr>

            <tr>

            <td><?php if($mail->forwarded == 1){ echo "(Forwarded Mail)";} ?></td>
            </tr>
            <tr> 

            <td><?php echo $mail->body ?></td>
            </tr>

            <tr>

              <td><?php if($mail->reply != null){ echo "(Reply)";} ?></td>

            </tr>

            <tr>

              <td><?php if($mail->reply != null){ echo $mail->reply;} ?></td>

            </tr>

            <?php
              $i++;
              }

              }

         
          ?>
        </tbody>
      </table>

<script>
    function taketo(parameter) {

    location.href = "http://localhost/falconemail/index.php/" + parameter;
	}
 </script>

 <script>
 	
 	function send_data(a, b,c, d,e) {
 		var site_url = "http://localhost/falconemail/index.php/Inbox/show_view";
		console.log(a);
		console.log(b);
		console.log(c);
		console.log(d);
		console.log(e);

		$.ajax({
        type:"POST",
        data:{
          subject:a,
          body:b,
          date:c
        },
        dataType:"JSON",
        url:"http://localhost/falconemail/index.php/Inbox/show_mail_details",
        error: function(data, jqXHR, textStatus, errorThrown) {
          // console.log(textStatus + ': ' + errorThrown);
        },
        success: function(data){

            console.log("successs");	
            if(!data.error){
            // <?php $_SESSION["subject"] = "a"; $_SESSION["body"] = "b"; ?>
            location.href = "http://localhost/falconemail/index.php/Inbox/show_view";
        }
             return true;
            }
      });
      return false;

	}


	
 </script>


</body></html>