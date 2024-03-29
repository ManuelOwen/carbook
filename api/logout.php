<?php
session_start();
    if(isset($_POST['logout'])){   
        function logout(){
            if(isset($_SESSION['user'])){
                unset($_SESSION['user']);
                unset($_SESSION['email']);
                unset($_SESSION['userId']);
                header("Location:../index.html");
                exit();
            }
        }
        logout();
    }
?>