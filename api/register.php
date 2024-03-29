<?php
 if(isset($_POST['register']))
 {
     
   

    function register(){
         $error = array();
        include('./connection.php');
        $email = $_POST['email'];
        $passwordmain = $_POST['passwordmain'];
        $passwordcon = $_POST['passwordcon'];
        $phone = $_POST['phone'];
        $name = $_POST['name'];

        if( empty($passwordcon) OR empty($passwordmain) OR empty($email) OR empty($phone) OR empty($name))
        {
            $error['register'] = 'Ensure all fields are not empty';
                
        }
        if(!is_numeric($phone))
        {
            $error['register'] = 'Enter a valid mobile number';
            
        }
        if($passwordcon != $passwordmain){
            $error['register'] = 'Password does not match';
            
        }
        if(count($error <= 0)){
            $query ="SELECT * 
                FROM users WHERE
                username = '$email' 
                AND password = '$passwordmain'
            ";
            $execute = mysqli_query($connection,$query);
            if(mysqli_num_rows($execute) >= 1){
                    $error['register'] = 'user already registered';
            }
            else{
                    $query = "INSERT INTO 
                        users(username,password,phone,name)
                        VALUES('$email','$passwordmain',$phone,'$name')
                    ";
                
                    $execute = mysqli_query($connection,$query);
                    if($execute)
                    {
                        $_SESSION['user'] = $row['name'];
                        $_SESSION['email'] = $username;
                        $_SESSION['userId'] = $row['id'];
                        header('Location:../home.php');
                    }
                }
        }
        if($error ){
            header('Location:../Signup.html');
            exit();
        }
    }
    register();
 }
?>