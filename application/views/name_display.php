<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Admin</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
</head>
<body>

<div id="container">
	<h1>Welcome to Admin!</h1>

        <p id="message"> </p>
        <br> <br> <br>
        
        <h3> Create person</h3>
        <form> 
            <!--user-->
            <label for='Name'>Name</label>
        <input type='text' name='username'  id='username' size='30'/> <br>
        
        
        <label for='Telephone'>Telephone</label>
        <input type='text' name='number'  id='number' size='30'/> <br>
        
         <label for='Email'>Email</label>
        <input type='email' name='email'  id='sender' size='30'/> <br>
         <label for='Book id'>book id</label>
        <input type='text' name='book_id'  id='book_id' size='30'/> <br>
        <!--vendor-->
        
        <label for='Vendor name'>vendor name</label>
        <input type='text' name='vendor name'  id='vendor_name' size='30'/> <br>
        
        <label for='Vendor number'>vendor number</label>
        <input type='text' name='vendor number'  id='vendor_mob' size='30'/> <br>
        
        <input type="submit" value="Create" id="create" />
        </form>
        <br> <br> <br>
        
      
        
        
        <script>
            $(document).ready(function(){
        
        $("#create").click(function(event){
            event.preventDefault();
            
            var username=$("input#username").val();
            var book_id= $("input#book_id").val();
            var number=$("input#number").val();
            var sender=$("input#sender").val();
            var vendor_name= $("input#vendor_name").val();
            var vendor_mob=$("input#vendor_mob").val();
            
            $.ajax({
                
            method: "POST",
            url: "<?php echo base_url();?>index.php/people/index",
            data: {username: username, book_id:book_id,number:number,sender:sender,vendor_name:vendor_name,vendor_mob:vendor_mob},      
            success: function(data){
              console.log(username, book_id, vendor_name);
        var simple = '<?php echo $res; ?>';
     var simple2 = '<?php echo $ans; ?>';
      var simple3 = '<?php echo $ans1; ?>';
     console.log(simple2);
     console.log(simple3);
    
        
        if(simple==="send"){
        $("#message").html("You have successfully send email and SMS  to " + username + simple2 + simple3 + " Thankyou" );
    }
    else{
       $("#message").html("Your mail has not been  send due to technical errors   try again" );
    }       
               
        $("#message").show();      
     
       }
        });
        });
});

  
  
  
  
  
  
 



   </script>  
    
 
</div>

</body>
</html>
