<?php 
   session_start();

   $db = mysqli_connect("localhost","root","","selfLearning2");
   $result = mysqli_query($db , "SELECT * FROM user") ;   

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Welcome</title>
   <style>
      body{
         background-color: #e5e5e5;
         font-family: sans-serif;
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .welcomeBox{
         background-color: #e5edeb;
         height: auto;
         width: 1000px;
         margin-top: 50px;
      }

      .title{
         text-align: center;
         margin-top: 50px;
         padding-bottom: 70px;
         font-size: large;
      }

      .greetings{
         text-align: center;
         font-size: xx-large;
      }

      .buttons{
         text-align: center;
         margin-top: 65px;
         margin-bottom: 100px;
      }

      .buttons a{
         text-decoration: none;
         color: black;
         font-size: xx-large;
         justify-content: space-between;
      }

      .login {
         background-color: #99d6ed;
         margin: 20px;
         padding: 20px 30px;
      }

      .register{
         background-color: #c6ed99;
         margin: 20px;
         padding: 20px 30px;
      }

      .instruction{
         text-align: center;
         padding: 10px;
         font-size: large;
      }

   </style>
</head>
<body>
   <div class="welcomeBox">
      <div class="title">
         Aplikasi Pengelolaan Keuangan
      </div>

      <div class="greetings">
         Selamat Datang di Aplikasi Pengelolaan Keuangan
      </div>
      
      <div class="instruction">
         <?php if(mysqli_num_rows($result) === 0 ) { ?>
            Silahkan lakukan registrasi terlebih dahulu  
         <?php } else { ?>
            Silahkan lakukan login
         <?php } ?>
      </div>

      <div class="buttons">
         <?php if(mysqli_num_rows($result) === 0 ) { ?>
            <a href="" class="login">Login</a>
            <a href="register.php" class="register">Register</a>
         <?php } else { ?>
            <a href="login.php" class="login">Login</a>
            <a href="register.php" class="register">Register</a>
         <?php } ?>
        
      </div>

      
   </div>
</body>
</html>