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

<button type="button" onclick="taketo('Trash')">Move To Trash</button>

<br/>

<table  bgcolor="#C0C0C0" id='myTable'>

        <tbody id="data"  data-link="row" class="rowlink">

          <?php
          if ($message) {
              $i = 1;
              $jsonarray = json_decode($message);
              // echo var_dump($jsonarray);
              $mail_data = $jsonarray->data;
              // foreach ($mail_data as $mail) {
                  // echo $mail->user_id;
              	?>

              	<tr><br />

              <td >
              	<a href= "#">
    				<div style="height:100%;width:100%">
      					<?php echo $mail_data[0]->subject?>
   					 </div
  				</a>
  				</td>

              <!-- <a href="" </a></td> -->
              
              	<td><?php echo $mail_data[0]->date ?></td>

            </tr>

            <tr> 

            <td><?php echo $mail_data[0]->body ?></td>
            </tr>

            <tr>

            <?php
              // $i++;
              // }

              }

         
          ?>
        </tbody>
      </table>

      <br />	


      <form ><br /> 

Reply : <br /> <input type="text" id="reply" style="width: 300px; height: 80px;"/><br /><br />

</form>

<input type="button" value="Send" onclick="reply()" /><br /><br />




<button type="button" onclick="trash('Trash')">Take to Trash</button>
      

<script>
    function taketo(parameter) {

    location.href = "http://localhost/falconemail/index.php/" + parameter;
	}
 </script>

 <script>
 	
 	function reply() {
 		var subject = <?php echo"'"; echo $mail_data[0]->subject; echo "'"; ?>;
    var body = document.getElementById('reply').value;
    var touserid =  <?php echo"'"; echo $mail_data[0]->user_id; echo "'"; ?>;
    var message_id = <?php echo"'"; echo $message_id; echo "'"; ?>;

      // var user_id = <?php echo "'"; echo "green"; echo "'"; ?>;


    console.log(message_id);

    
    $.ajax({
        type:"POST",
        data:{
          subject:subject,
          body:body,
          touserid:touserid,
          userid: <?php echo "'"; echo $_SESSION['userid']; echo "'";?>,
          message_id: message_id
        },
        dataType:"JSON",
        url:"http://localhost/falconbackend/v1/reply",
        error: function(data, jqXHR, textStatus, errorThrown) {
          // console.log(textStatus + ': ' + errorThrown);
        },
        success: function(data){

            console.log("successs");  
            if(!data.error){
              // location.href = "http://localhost/falconemail/index.php/Inbox";
        }
             return true;
            }
      });
      return false;

	}


	
 </script>

  <script>
  
  function trash() {
    var message_id = <?php echo"'"; echo $message_id; echo "'"; ?>;

      // var user_id = <?php echo "'"; echo "green"; echo "'"; ?>;


    console.log(message_id);

    
    $.ajax({
        type:"POST",
        data:{
          userid: 1,
          message_id: message_id
        },
        dataType:"JSON",
        url:"http://localhost/falconbackend/v1/mt",
        error: function(data, jqXHR, textStatus, errorThrown) {
          // console.log(textStatus + ': ' + errorThrown);
        },
        success: function(data){

            console.log("successs");  
            if(!data.error){
              location.href = "http://localhost/falconemail/index.php/Sent";
            }
             return true;
            }
      });
      return false;

  }


  
 </script>


</body></html>