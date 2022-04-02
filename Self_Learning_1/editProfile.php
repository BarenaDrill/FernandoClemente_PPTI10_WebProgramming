<?php 
   session_start();
   $status = 0 ;
   if(!isset($_SESSION["id"])){
      header("Location: welcome.php");
      exit;
   }

   $db = mysqli_connect("localhost","root","","selfLearning2");
   $id = $_SESSION['id'];
   $result = mysqli_query($db,"SELECT * FROM user WHERE id = '$id' ") ;
   $row = mysqli_fetch_assoc($result);

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

   function update($data){

      global $db;
      global $id;
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
      if(isset($data['fotoProfil'])){
         $fotoProfil = $data['fotoProfil'];
      }
      $fotoProfilLama = $data['gambarLama'];

      if ($_FILES['fotoProfil']['error'] === 4){
         $fotoProfil = $fotoProfilLama;
      }else{
         if (upload() == false){
            echo "<script>
                  alert('ukuran file terlalu besar atau bukan merupakan image');
               </script>;
            ";
            $fotoProfil = $fotoProfilLama;
         }else{
            $fotoProfil = upload();
         }
         
      }


      mysqli_query($db,"UPDATE user SET
            namaDepan = '$namaDepan' , 
            namaTengah = '$namaTengah' ,
            namaBelakang = '$namaBelakang' ,
            tempatLahir = '$tempatLahir', 
            tglLahir = '$tglLahir',
            NIK = '$NIK',
            wargaNegara = '$wargaNegara',
            email = '$email',
            noHP = '$noHP',
            alamat = '$alamat',
            kodePos = '$kodePos',
            gambar = '$fotoProfil'
            WHERE id = $id 
      ");

      return mysqli_affected_rows($db) ;

   }

   if(isset($_POST['submit'])){

      if(   
         // validasi update
         !preg_match("/^[a-zA-Z]*$/",$_POST['namaDepan']) || 
         !preg_match("/^[a-zA-Z]*$/",$_POST['namaTengah']) || 
         !preg_match("/^[a-zA-Z]*$/",$_POST['namaBelakang']) || 
         !preg_match("/^[a-zA-Z]*$/",$_POST['tempatLahir']) || 
         (!preg_match("/^[0-9]*$/",$_POST['NIK']) || (strlen($_POST['NIK'])) !=  16) ||
         !preg_match("/^[a-zA-Z]*$/",$_POST['wargaNegara']) || 
         !preg_match("/^[a-zA-Z0-9._-]*+[@]+[a-zA-Z0-9]*+[.]+[a-zA-Z]*$/",$_POST['email']) || 
         (!preg_match("/^[0-9+]*$/",$_POST['noHP']) || strlen($_POST['noHP']) <  10) ||
         !preg_match("/^[0-9]*$/",$_POST['kodePos']) 
         ) {
         echo "<script>
                  alert('Mohon isi data sesuai dengan ketentuan');
               </script>" ;
         $status++;               
      }else{
         if(update($_POST) > 0){
            echo "<script>
               alert('Data berhasil di-edit') ;
               document.location.href = 'profile.php' ;
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
   <title>Edit Profile</title>
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

      .errorMsg{
         font-size: smaller;
         color: red;
      }

      a[name="logout"]{
         text-decoration: none;
         color: black;
      }

      .save {
         background-color: #fdd7ac;
         border-radius: 10%;
         padding: 10px 15px;
         text-decoration: none;
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
          width: 40px;
       }

       .space{
          height: 5px;
       }
      
       textarea{
         height: 70px;
         width: auto;
         resize: none;
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
   <form action="" method="post" name="form1" enctype="multipart/form-data">
   <div class="content">
      <table>
         <h3>Profil Pribadi </h1>
      </table>
      <table>
         <tr>  
            <td class="spaceleftright"></td>
            <td ><label for="namaDepan">Nama Depan</label></td>
            <td ><input type="text" name="namaDepan" id="namaDepan" required value="<?php echo $row['namaDepan'] ; ?>"></td>
            <td class="spaceleftright"></td>
            <td ><label for="namaTengah">Nama Tengah</label></td>
            <td ><input type="text" name="namaTengah" id="namaTengah" required value="<?php echo $row['namaTengah'] ; ?>"></td>
            <td class="spaceleftright"></td>
            <td ><label for="namaBelakang">Nama Belakang</label></td>
            <td ><input type="text" name="namaBelakang" id="namaBelakang" required value="<?php echo $row['namaBelakang'] ; ?>"></td>
         </tr>
         <tr>
            <?php if($status != 0) { ?>
               <td></td>
               <td></td>
               <td class="errorMsg">* Only letters allowed !</td>
               <td></td>
               <td></td>
               <td class="errorMsg">* Only letters allowed !</td>
               <td></td>
               <td></td>
               <td class="errorMsg">* Only letters allowed !</td>
            <?php } ?>
         </tr>
         <tr class="space"></tr>
         <tr>
            <td class="spaceleftright"></td>
            <td ><label for="tempatLahir">Tempat Lahir</label></td>
            <td ><input type="text" name="tempatLahir" id="tempatLahir" required value="<?php echo $row['tempatLahir'] ; ?>"></td>
            <td class="spaceleftright"></td>
            <td ><label for="tanggalLahir">Tgl Lahir</label></td>
            <td ><input type="date" name="tanggalLahir" id="tanggalLahir"  placeholder="dd/mm/yyyy" required
            value="<?php echo $row['tglLahir'] ; ?>"></td>
            <td class="spaceleftright"></td>
            <td ><label for="NIK">NIK</label></td>
            <td ><input type="text" name="NIK" id="NIK" required value="<?php echo $row['NIK'] ; ?>"></td>
         </tr>
         <?php if($status != 0) { ?>
            <td></td>
            <td></td>
            <td class="errorMsg">* Only letters allowed !</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="errorMsg">* 16 numbers required !</td>
         <?php } ?>
         <tr class="space"></tr>
         <tr>   
            <td class="spaceleftright"></td>  
            <td ><label for="wargaNegara">Warga Negara</label></td>
            <td ><input type="text" name="wargaNegara" id="wargaNegara" required value="<?php echo $row['wargaNegara'] ; ?>"></td>
            <td class="spaceleftright"></td>
            <td ><label for="email">Email</label></td>
            <td ><input type="text" name="email" id="email" required value="<?php echo $row['email'] ; ?>"></td>
            <td class="spaceleftright"></td>
            <td ><label for="noHP">No HP</label></td>
            <td ><input type="text" name="noHP" id="noHP" required value="<?php echo $row['noHP'] ; ?>"></td>
         </tr>
         <?php if($status != 0) { ?>
            <td></td>
            <td></td>
            <td class="errorMsg">* Only letters allowed !</td>
            <td></td><td></td>
            <td class="errorMsg">* ex. abc@gmail.com ! <br> (harus ada @ dan '.' )</td>
            <td></td>
            <td></td>
            <td class="errorMsg">* minimal 10 numbers required ! <br> (boleh diawali dengan +)</td>
         <?php } ?>
         <tr class="space"></tr>
         <tr>
            <td class="spaceleftright"></td>
            <td ><label for="alamat">Alamat</label></td>
            <td ><textarea type="text" name="alamat" id="alamat" required><?php echo $row['alamat'] ; ?> </textarea></td>
            <td class="spaceleftright"></td>
            <td >
               <label for="kodePos">Kode Pos</label>
            </td>
            <td >
               <input type="text" name="kodePos" id="kodePos" required value="<?php echo $row['kodePos'] ; ?>"><br>
               <?php if($status != 0) { ?>
               <font class="errorMsg">* Only numbers allowed !</font>
               <?php } ?>
            </td>
            <td class="spaceleftright"></td>
            <td >Foto Profil</td>
            <td >
               Silahkan Pilih Foto <br>
               
               <img src="img/<?php echo $row["gambar"] ; ?>" width="50" > <br>
               <input type="file" name="fotoProfil" id="fotoProfil" >
               <?php if($status != 0) { ?>
               <font class="errorMsg"><br>* Only .png, .jpg, .jpeg </font>
               <?php } ?> 
            </td>
         </tr>
         
      </table>
      <table>
         <input type="hidden" name="gambarLama" id="gambarLama" value="<?= $row['gambar'] ; ?>">
      </table>
      <table>
         <button type="submit" name="submit" class="save" style="color: black;" >UPDATE DATA</button>
      </table>
      
   </div>
   </form>
</body>
</html> 