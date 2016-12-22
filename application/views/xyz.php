  <td  onClick= "send_data(<?php echo "'"; echo $mail->subject; echo "'"; echo ","; 
              echo "'" ; echo $mail->body; echo "'"; echo ","; echo "'"; echo $mail->date; 
              echo "'";  if($mail->reply != null){echo ","; echo "'" ; echo $mail->reply; echo "'";}
              if($mail->forwarded == 1){echo ","; echo "'" ; echo $mail->forwarded; echo "'";} ?>)">
              	<a href="#">
    				<div style="height:100%;width:70%">
      					<?php echo $mail->subject?>
   					 </div>
  				</a>
  				</td>