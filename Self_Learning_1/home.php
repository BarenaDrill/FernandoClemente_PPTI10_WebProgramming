<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <style>
      body{
         background-color: #e5e5e5;
         font-family: sans-serif;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
      }
      .navbar{
         background-color: #f9ffca;
         height: auto;
         width: 900px;
         margin-top: 50px;
         padding: 10px;
         display: flex;
         flex-direction: row;
         justify-content: space-between;
      }
      a[name="logout"]{
         text-decoration: none;
         color: black;
      }
      .content{
         background-color: #cad1ff;
         height: 400px;
         width: 900px;
         padding: 10px;
         display: flex;
         align-items: center;
         justify-content: center;
      }
      .hello{
         text-align: center;
      }
      a[name="profile"]{
         text-decoration: none;
         color: black;
         margin-left: 15px;
      }
      a[name="home"]{
         color: black;
         margin-right: 15px;
      }
      

   </style>
</head>
<body>
   <div class="navbar">
      <div class="title">
         Aplikasi Pengelolaan Keuangan
      </div>
      <div class="menu">
         <a href="home.php" name="home">Home</a>
         <a href="profile.php" name="profile">Profile</a>
      </div>
      <div class="logout">
         <a href="logout.php" name="logout">Logout</a>
      </div>
   </div>
   <div class="content">
      <div class="hello">
         Halo <b><?php echo $_SESSION['namaDepan']." ".$_SESSION['namaTengah']." ".$_SESSION['namaBelakang'] ; ?></b>,Selamat datang di Aplikasi Pengelolaan Keuangan
         <br><br><br><br><br><br>
      </div>
   </div>
</body>
</html>