<?php
// Start the session
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!doctype html>
<html><body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<form >

Username : <input type="text" id="username"/><br /><br />

Email : <input type="text" id="email"/><br /><br />

</form>

<input type="button" value="Login" onclick="submit()" /><br /><br />

<script>
    function submit() {
      var username = document.getElementById('username').value;
      var email = document.getElementById('email').value;
      
      console.log(username);
      console.log(email);
      $.ajax({
        type:"POST",
        data:{
          username:username,
          email:email
        },
        dataType:"JSON",
        url:"http://localhost/falconbackend/v1/login",
        error: function(data, jqXHR, textStatus, errorThrown) {
          console.log(textStatus + ': ' + errorThrown);
        },
        success: function(data){

              if(data.userid != null){
                send_user_id(data.userid);
              }
             return true;
        }
      
      });
      return false;

    }

    function send_user_id(user_id) {
      var userid = user_id;
      
      console.log(userid);
      $.ajax({
        type:"POST",
        data:{
          userid:userid
        },
        dataType:"JSON",
        url:"http://localhost/falconemail/index.php/Login/get_user_id",
        error: function(data, jqXHR, textStatus, errorThrown) {
          console.log(textStatus + ': ' + errorThrown);
        },
        success: function(data){

            console.log("success");

            location.href = "http://localhost/falconemail/index.php/Inbox";
             return true;
        }
      
      });
      return false;

    }


  </script>


</body></html>