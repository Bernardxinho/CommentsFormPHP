<?php
    require("functions.php")

    $response = null;

    if(isset($_POST['submit'])){
        $response = storeMessage($_POST['name'],$_POST['email'], $_POST['subject'], $_POST['message']);
        if($repsonse == "success"){
            unset($_POST);
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storing messages</title>
</head>
<body>

<form action="" method="post">

   <h3>Contact us</h3>

   <label>Name</label>
   <input type="text" name="name" value="<?php echo @$_POST['name']?>">

   <label>Enter your email</label>
   <input type="email" name="email" value="<?php echo @$_POST['email']?>">
 
   <label>Rating</label>
    <input type="number" name="rating" min="1" max="5" value="<?php echo @$_POST['rating']?>"> 

   <label>Enter your message</label>
   <textarea name="message"><?php echo @$_POST['message']?></textarea>
 
   <input type="submit" name="submit" value="Submit">


   <?php
        if($response == "success"){
            ?>
                <p class="success">Success!</p>
            <?php

        }else{
            ?>
                <p class="error"><?php echo$response ?></p>
            <?php
        }
   ?>

</form>

</body>
</html>




