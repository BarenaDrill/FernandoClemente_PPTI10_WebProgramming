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
         flex-direction: column;
      }
      
      a[name="profile"]{
         color: black;
         margin-left: 15px;
      }
      a[name="home"]{
         color: black;
         margin-right: 15px;
         text-decoration: none;
      }

      td{
          vertical-align: top;
       }

       .spaceleftright{
          width: 50px;
       }

       .space{
          height: 40px;
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
      <table>
         <h3>Profil Pribadi </h1>
      </table>
      <table>
         <tr>
            <td>Nama Depan</td>
            <td><b><?php echo $_SESSION['namaDepan'] ; ?></b></td>
            <td class="spaceleftright"></td>
            <td>Nama Tengah</td>
            <td><b><?php echo $_SESSION['namaTengah'] ; ?></b></td>
            <td class="spaceleftright"></td>
            <td>Nama Belakang</td>
            <td><b><?php echo $_SESSION['namaBelakang'] ; ?></b></td>
         </tr>
         <tr class="space"></tr>
         <tr>
            <td>Tempat Lahir</td>
            <td><b><?php echo $_SESSION['tempatLahir'] ; ?></b></td>
            <td class="spaceleftright"></td>
            <td>Tanggal Lahir</td>
            <td><b><?php echo $_SESSION['tanggalLahir'] ; ?></b></td>
            <td class="spaceleftright"></td>
            <td>NIK</td>
            <td><b><?php echo $_SESSION['NIK'] ; ?></b></td>
         </tr>
         <tr class="space"></tr>
         <tr>
            <td>Warga Negara</td>
            <td><b><?php echo $_SESSION['wargaNegara'] ; ?></b></td>
            <td class="spaceleftright"></td>
            <td>Email</td>
            <td><b><?php echo $_SESSION['email'] ; ?></b></td>
            <td class="spaceleftright"></td>
            <td>No HP</td>
            <td><b><?php echo $_SESSION['noHP'] ; ?></b></td>
         </tr>
         <tr class="space"></tr>
         <tr>
            <td>Alamat</td>
            <td><b><?php echo $_SESSION['alamat'] ; ?></b></td>
            <td class="spaceleftright"></td>
            <td>Kode Pos</td>
            <td><b><?php echo $_SESSION['kodePos'] ; ?></b></td>
            <td class="spaceleftright"></td>
            <td>Foto Profil</td>
            <td>
               <img src="img/<?php echo $_SESSION["fotoProfil"] ; ?>" width="80"> <br>
               <?php echo $_SESSION['fotoProfil'] ; ?>
            </td> 
            
            
         </tr>
      </table>
   </div>

</body>
</html>