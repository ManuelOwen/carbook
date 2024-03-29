<?php
session_start();
date_default_timezone_set('Africa/Nairobi');
if(isset($_POST['comment'])){
    
    function comment(){
    
        $website = $_POST['website'];
        $message = $_POST['message'];
        $UserId = $_SESSION['userId'];
        
        include ('./connection.php');
        $error = array();
        $success = '';
        if(!empty($website) AND !empty($message)){        
            $query = "INSERT INTO comments(userId,website,message,time) 
                VALUES($UserId,'$website','$message',Now())
            ";
            $execute = mysqli_query($connection, $query);
            if($execute ){
                $success = 'Comment added successfully';
                header('Location: ../blog-single.php');
                exit();
            }
            else{
                $error['comment'] = 'Unable to comment at the moment';
                header('Location: ../blog-single.php');
                exit();
            }
        }
        else{
            $error['comment'] = 'Ensure no empty fields';
            header('Location: ../blog-single.php');
            exit();
        }
    }
    comment();
}
?>