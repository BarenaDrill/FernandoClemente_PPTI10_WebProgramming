<?php 
   
   $db = mysqli_connect("localhost","root","","selfLearning2");
   $status = 0 ;

   function upload(){
      $namaFile = $_FILES['fotoProfil']['name'] ;
      $error = $_FILES['fotoProfil']['error'];
      $tmpName = $_FILES['fotoProfil']['tmp_name'];

      if( $error == 4 ){
         echo "<script>
                  alert('pilih gambar terlebih dahulu');
               </script>;
         ";
         return false ;
      }

      $ekstensiGambarValid = ['png','jpg','jpeg'] ;
      $ekstensiGambar = explode('.',$namaFile);
      $ekstensiGambar = strtolower(end($ekstensiGambar));

      if( !in_array($ekstensiGambar,$ekstensiGambarValid)){
         echo "<script>
                  alert('yang anda upload bukan gambar');
               </script>;
         ";
         return false ;
      }


      move_uploaded_file($tmpName ,'img/'.$namaFile);

      return $namaFile ;
   }

   function registrasi($data){

      global $db;
      $username = stripslashes($data['username']) ;
      $password = mysqli_real_escape_string($db,$data['password']) ;
      $namaDepan = $data['namaDepan'];
      $namaTengah = $data['namaTengah'] ;
      $namaBelakang = $data['namaBelakang'];
      $tempatLahir = $data['tempatLahir'];
      $tglLahir = strtotime($data["tanggalLahir"]);
      $tglLahir = date('Y-m-d', $tglLahir);
      $NIK= $data['NIK'];
      $wargaNegara = $data['wargaNegara'];
      $email = $data['email'];
      $noHP = $data['noHP'];
      $alamat = $data['alamat'];
      $kodePos = $data['kodePos'];
      $fotoProfil = upload();

      $result = mysqli_query($db,"SELECT username FROM user WHERE username = '$username' ") ;
      if(mysqli_fetch_assoc($result)){
         echo "<script>
            alert('username sudah terdaftar');
         </script>" ;
         return false ;
      }

      $password = password_hash($password,PASSWORD_DEFAULT) ;

      mysqli_query($db,"INSERT INTO user 
      VALUES ('','$namaDepan','$namaTengah','$namaBelakang','$tempatLahir','$tglLahir','$NIK','$wargaNegara','$email','$noHP','$alamat','$kodePos','$fotoProfil','$username','$password')") ;

      return mysqli_affected_rows($db) ;

   }

   if(isset($_POST['submit'])){

      $username = $_POST['username'] ;
      $result = mysqli_query($db,"SELECT username FROM user WHERE username = '$username' ") ;

      if ($_POST['confirmPassword'] != $_POST['password']){
         echo "<script>
                  alert('Password1 dan Password2 tidak sama !');
               </script>" ;
         $status++;
      }else if(   
                  // validasi registrasi
                  !preg_match("/^[a-zA-Z]*$/",$_POST['namaDepan']) || 
                  !preg_match("/^[a-zA-Z]*$/",$_POST['namaTengah']) || 
                  !preg_match("/^[a-zA-Z]*$/",$_POST['namaBelakang']) || 
                  !preg_match("/^[a-zA-Z]*$/",$_POST['tempatLahir']) || 
                  (!preg_match("/^[0-9]*$/",$_POST['NIK']) || (strlen($_POST['NIK'])) !=  16) ||
                  !preg_match("/^[a-zA-Z]*$/",$_POST['wargaNegara']) || 
                  !preg_match("/^[a-zA-Z0-9._-]*+[@]+[a-zA-Z0-9]*+[.]+[a-zA-Z]*$/",$_POST['email']) || 
                  (!preg_match("/^[0-9+]*$/",$_POST['noHP']) || strlen($_POST['noHP']) <  10) ||
                  !preg_match("/^[0-9]*$/",$_POST['kodePos']) || 
                  (!preg_match("/^[a-zA-Z0-9-_.]*$/",$_POST['username']) || strlen($_POST['username']) < 3) ||
                  (!preg_match("/^[a-zA-Z0-9-_.!@#$%^&*()+=]*$/",$_POST['password']) ||strlen($_POST['password']) <  3) ||
                  (!preg_match("/^[a-zA-Z0-9-_.!@#$%^&*()+=]*$/",$_POST['confirmPassword']) || strlen($_POST['confirmPassword']) <  3) ||
                  (upload() == false)
                  ) {
         echo "<script>
                  alert('Mohon isi data sesuai dengan ketentuan');
               </script>" ;
         $status++;               
      }else if(mysqli_fetch_assoc($result)){
         echo "<script>
            alert('username sudah terdaftar');
         </script>" ;
         $status++;               
      }else{
         if(registrasi($_POST) > 0){
            echo "<script>
               alert('user baru berhasil ditambahkan') ;
               document.location.href = 'welcome.php' ;
            </script>" ;
         }else{
            echo mysqli_error($db) ;
         }
      }

   }



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <style>
      body{
         background-color: #e5e5e5;
         font-family: sans-serif;
         display: flex;
         justify-content: center;
         align-items: center;
      }
      .registerBox{
         background-color: #c2f0f7;
         height: auto;
         width: 1000px;
         margin-top: 50px;
      }
      .title{
         text-align: center;
         margin-top: 25px;
         padding-bottom: 30px;
         font-size: larger;
      }
      form{
         display: flex;
         justify-content: center;
         align-items: center;
      }
      
      input[type="text"]{
         margin-right: 20px;
      }
      input[type="password"]{
         margin-right: 20px;
      }
      
      input[type="file"]{
         width: 180px;
      }

      input[type="date"]{
         width: 165px;
      }

      input[name="alamat"]{
         height: 90px;
      }
       
       td{
          vertical-align: top;
       }
      

      .buttons{
         text-align: center;
         height: 100px;
         display: block;
         align-items: center;
         justify-content: center;
      }

      a{
         text-decoration: none;
         color: black;
         border-width: 1px;
         border-style: solid;
      }

      .kembali {
         background-color: #fdd7ac;
         border-radius: 10%;
         padding: 10px 15px;
      }

      input[type="submit"]{
         background-color: #adf59f;
         border-radius: 10%;
         border-style: solid;
         border-width: 2px;
         padding: 10px 15px;
         margin-left: 10px;
      }
         
      .space{
         height: 10px;
      }

      textarea{
         height: 70px;
         width: auto;
         resize: none;
      }

      .errorMsg{
         font-size: smaller;
         color: red;
      }

      
   </style>
</head>
<body>
   <div class="registerBox">
      <div class="title">
         Register
      </div>
      <form action="" method="post" name="regisForm" enctype="multipart/form-data">
         <table>
            <tr>
               <td ><label for="namaDepan">Nama Depan</label></td>
               <td ><input type="text" name="namaDepan" id="namaDepan" required></td>
               <td ><label for="namaTengah">Nama Tengah</label></td>
               <td ><input type="text" name="namaTengah" id="namaTengah" required></td>
               <td ><label for="namaBelakang">Nama Belakang</label></td>
               <td ><input type="text" name="namaBelakang" id="namaBelakang" required></td>
            </tr>
            <tr>
               <?php if($status != 0) { ?>
                  <td></td>
                  <td class="errorMsg">* Only letters allowed !</td>
                  <td></td>
                  <td class="errorMsg">* Only letters allowed !</td>
                  <td></td>
                  <td class="errorMsg">* Only letters allowed !</td>
               <?php } ?>
            </tr>
            <tr class="space"></tr>
            <tr>
               <td ><label for="tempatLahir">Tempat Lahir</label></td>
               <td ><input type="text" name="tempatLahir" id="tempatLahir" required></td>
               <td ><label for="tanggalLahir">Tgl Lahir</label></td>
               <td ><input type="date" name="tanggalLahir" id="tanggalLahir"  placeholder="dd/mm/yyyy" required
               ></td>
               <td ><label for="NIK">NIK</label></td>
               <td ><input type="text" name="NIK" id="NIK" required></td>
            </tr>
            <?php if($status != 0) { ?>
               <td></td>
               <td class="errorMsg">* Only letters allowed !</td>
               <td></td>
               <td></td>
               <td></td>
               <td class="errorMsg">* 16 numbers required !</td>
            <?php } ?>
            <tr class="space"></tr>
            <tr>     
               <td ><label for="wargaNegara">Warga Negara</label></td>
               <td ><input type="text" name="wargaNegara" id="wargaNegara" required></td>
               <td ><label for="email">Email</label></td>
               <td ><input type="text" name="email" id="email" required></td>
               <td ><label for="noHP">No HP</label></td>
               <td ><input type="text" name="noHP" id="noHP" required></td>
            </tr>
            <?php if($status != 0) { ?>
               <td></td>
               <td class="errorMsg">* Only letters allowed !</td>
               <td></td>
               <td class="errorMsg">* ex. abc@gmail.com ! <br> (harus ada @ dan '.' )</td>
               <td></td>
               <td class="errorMsg">* minimal 10 numbers required ! <br> (boleh diawali dengan +)</td>
            <?php } ?>
            <tr class="space"></tr>
            <tr>
               <td ><label for="alamat">Alamat</label></td>
               <td ><textarea type="text" name="alamat" id="alamat" required></textarea></td>
               <td ><label for="kodePos">Kode Pos</label></td>
               <td >
                  <input type="text" name="kodePos" id="kodePos" required><br>
                  <?php if($status != 0) { ?>
                  <font class="errorMsg">* Only numbers allowed !</font>
                  <?php } ?>
               </td>
               <td >Foto Profil</td>
               <td >
                  Silahkan Pilih Foto <br>
                  <input type="file" name="fotoProfil" id="fotoProfil"  >
                  <?php if($status != 0) { ?>
                  <font class="errorMsg"><br>* Only .png, .jpg, .jpeg </font>
                  <?php } ?> 
               </td>
            </tr>
            <tr class="space"></tr>
            <tr>
               <td ><label for="username">Username</label></td>
               <td ><input type="text" name="username" id="username" required></td>
               <td ><label for="password">Password 1</label></td>
               <td ><input type="password" name="password" id="password" required></td>
               <td ><label for="confirmPassword">Password 2</label></td>
               <td ><input type="password" name="confirmPassword" id="confirmPassword" required></td>
            </tr> 
               <?php if($status != 0) { ?>
                  <td></td>
                  <td class="errorMsg">* Minimal 3 chararcters required ! </td>
                  <td></td>
                  <td class="errorMsg">* Minimal 3 chararcters required ! </td>
                  <td></td>
                  <td class="errorMsg">* Minimal 3 chararcters required ! </td>
               <?php } ?>
            <tr class="space"></tr>
            <tr class="space"></tr> 
            <tr class="space"></tr>
            <tr>
               <td ></td>
               <td ></td>
               <td ></td>
               <td ></td>
               <td ></td>
               <td class="buttons">
                  <a href="welcome.php" class="kembali">Kembali</a>
                  <input type="submit" name="submit" value="Register">
               
               </td>
            </tr>
            
         </table>
      </form>

      
   </div>
</body>
</html>