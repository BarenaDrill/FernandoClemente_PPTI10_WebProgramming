<?php 
   session_start();
   if(isset($_SESSION['id'])){
      header("Location: home.php");
      exit;
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <style>
      body{
         background-color: #e5e5e5;
         font-family: sans-serif;
         display: flex;
         justify-content: center;
         align-items: center;
      }

      
      .loginBG{
         background-color: #fbfdac;
         height: 500px;
         width: 1000px;
         margin-top: 50px;
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: column;
      }

      .loginBox{
         background-color: #ace6fd;
         width: 500px;
         height: 250px;
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: column;
      }

      .title{
         text-align: center;
         padding-bottom: 30px;
         font-size: larger;
      }

      .buttons{
         text-align: center;
         height: 80px;
      }

      .buttons a{
         text-decoration: none;
         color: black;
         justify-content: space-between;
         
      }

      .kembali {
         background-color: #fdd7ac;
         border-radius: 10%;
         border-width: 1px;
         border-style: solid;
         margin-left: 15px;
         padding: 10px 15px;
      }

      input[type="submit"]{
         background-color: #adf59f;
         margin-right: 15px;
         border-radius: 10%;
         

         padding: 10px 15px;
      }

      .space{
         height: 15px;
      }

   </style>
</head>
<body>
   <div class="loginBG">
      <div class="title">
            Login
      </div>
      <div class="loginBox">
         <form action="loginProses.php" method="post">
            <table>
               <tr>
                  <td>
                     <label for="username">Username &emsp; </label>
                  </td>
                  <td>
                     <input type="text" name="username" id="username" required size="30">
                  </td>
               </tr>
               <tr class="space"></tr>
               <tr>
                  <td>
                     <label for="password">Password &emsp; </label>
                  </td>
                  <td>
                     <input type="password" name="password" id="password" required size="30">  
                  </td>
               </tr>
               <tr>
                  <td></td>
                  
                  <td class="buttons">
                     <input type="submit" name="submit" value="Login">
                     <a href="welcome.php" class="kembali">Kembali</a>
                  </td>
                  
               </tr>
            </table>
         </form>
      </div>
   </div>
</body>
</html>