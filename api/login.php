<?php 
session_start(); 
if (isset($_POST['login']))
{

    function login(){
        $error =array();

        include('./connection.php');
        $username = $_POST['email'];
        $password = $_POST['password'];
        if($username != "" AND $password === "")
        {
            $error['login'] = 'Please Enter password';
            return $error;
        }
        if($password != "" AND $username === "")
        {
            $error['login'] = 'Please Enter username';
            return $error;
        } 
        if(count($error) === 0)
        {
            
            $query = "SELECT * FROM users
                WHERE username = '$username'
                AND password = '$password'
            ";
            $execute = mysqli_query($connection,$query);
            if (mysqli_num_rows($execute) === 1){
                $row = mysqli_fetch_array($execute);
                $_SESSION['user'] = $row['name'];
                $_SESSION['email'] = $username;
                $_SESSION['userId'] = $row['id'];
                header('Location: ../home.php');
                 exit();
            }
            else{
                header('Location: ../index.html');
                exit();

            }
        }
        else{
            header('Location: ../index.html');
            exit();
        }
    }
    login();
}
?>