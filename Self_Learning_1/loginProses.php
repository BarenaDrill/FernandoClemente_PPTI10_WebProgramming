<?php
    session_start();
   // var_dump($_POST['submit']) ;
    if( isset($_POST['submit']) ){
        if(($_POST['username'] ==  $_SESSION['usernameSession']) && ($_POST['password'] == $_SESSION['passwordSession'])) {
            header("location:home.php");
        }else{
            echo "<script>
                  alert('maaf anda gagal login pastikan username dan password sesuai');
                  document.location.href = 'login.php' ;
               </script>" ;
        }
    }
?>