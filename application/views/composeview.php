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


<form ><br />

Email : <input type="text" id="email"/><br /><br />

Subject : <br />  <input type="text" id="subject" style="width: 300px; height: 30px;"   /><br /><br />

Body : <br /> <input type="text" id="body" style="width: 300px; height: 80px;"/><br /><br />

</form>

<input type="button" value="Send" onclick="compose()" /><br /><br />

<input type="button" value="Save Draft" onclick="savedraft()" /><br /><br />

<script>
    function taketo(parameter) {

    location.href = "http://localhost/falconemail/index.php/" + parameter;
	}
 </script>

 <script>
 	
 	function compose() {

    var subject = document.getElementById('subject').value;
    var body = document.getElementById('body').value;
      var email = document.getElementById('email').value;

      // var user_id = <?php echo "'"; echo $_SESSION["userid"]; echo "'"; ?>;

    // console.log(user_id);

 		
		$.ajax({
        type:"POST",
        data:{
          subject:subject,
          body:body,
          email:email,
          userid: <?php echo "'"; echo $_SESSION['userid']; echo "'";?>
        },
        dataType:"JSON",
        url:"http://localhost/falconbackend/v1/compose",
        error: function(data, jqXHR, textStatus, errorThrown) {
          // console.log(textStatus + ': ' + errorThrown);
        },
        success: function(data){

            console.log("successs");	
            if(!data.error){
              location.href = "http://localhost/falconemail/index.php/Inbox";
        }
             return true;
            }
      });
      return false;

	}


  function savedraft() {

    var subject = document.getElementById('subject').value;
    var body = document.getElementById('body').value;
      var email = document.getElementById('email').value;
    
    $.ajax({
        type:"POST",
        data:{
          subject:subject,
          body:body,
          email:email,
          userid: <?php echo "'"; echo $_SESSION['userid']; echo "'";?>
        },
        dataType:"JSON",
        url:"http://localhost/falconbackend/v1/sd",
        error: function(data, jqXHR, textStatus, errorThrown) {
          // console.log(textStatus + ': ' + errorThrown);
        },
        success: function(data){

            console.log("successs");  
            if(!data.error){
              // location.href = "http://localhost/falconemail/index.php/Drafts";
        }
             return true;
            }
      });
      return false;

  }


	
 </script>


</body></html>