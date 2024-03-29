<?php
session_start();
if (isset($_POST['send'])){
    function sendMessage(){
        include('./connection.php');
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $userId = $_SESSION['userId'];
        $error = array();
        echo $userId;
        $success = '';   
        if(!empty($subject) AND !empty($message)){
            $query = "INSERT INTO 
                contact(userId,subject,message,time)
                VALUES($userId,'$subject','$message',Now())
            ";
            $execute = mysqli_query($connection, $query);
            
            if($execute ){
                $success = 'Message sent successfully';
                header('Location: ../contact.php');
                exit();
            }
            else{
                $message = 'Unable to send the message at the moment';
                header('Location: ../contact.php');
                exit();
            }
        }
        else{
            $error['message'] = 'Ensure no field is empty';
        }
    }
    sendMessage();
}

?>