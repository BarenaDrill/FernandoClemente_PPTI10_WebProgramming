<?php
    session_start();
    
    $db = mysqli_connect("localhost","root","","selfLearning2");
   
   // var_dump($_POST['submit']) ;
    if( isset($_POST['submit']) ){
        $username = $_POST['username'] ;
        $password = $_POST['password'] ;
        
        $result = mysqli_query($db,"SELECT * FROM user WHERE username = '$username' ") ;

        if(mysqli_num_rows($result) === 1 ){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password,$row['password'])){
                $_SESSION['id'] = $row['id'] ;
                header("Location: home.php");
                exit;
            }else{
                echo "<script>
                  alert('Maaf anda gagal login pastikan username dan password sesuai');
                  document.location.href = 'login.php' ;
               </script>" ;
            }
        }else{
            echo "<script>
                  alert('Username anda belum terdaftar');
                  document.location.href = 'login.php' ;
               </script>" ;
        }

    }
?>