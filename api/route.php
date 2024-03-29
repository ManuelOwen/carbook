<?php
session_start();
//check if the user is loged in
if(!isset($_SESSION['user'])){
    //redirect back to login page
    header('Location: index.html');
    exit();
}
?>