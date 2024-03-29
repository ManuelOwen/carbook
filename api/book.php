<?php
session_start();
if(isset($_POST['book'])){

   function book(){
    include('./connection.php');
    
    $carId = $_POST['bookId'];
    $userId = $_SESSION['userId'];
    $page = $_POST['page'];
    $query = "SELECT * FROM cars WHERE id = $carId";
    $execute = mysqli_query($connection,$query);
     
    if($execute){
        
        $row = mysqli_fetch_array($execute);
        $amount = $row['day'];

        $query = "SELECT * FROM `order` WHERE userId = $userId AND carId = $carId";
        $execute = mysqli_query($connection,$query);
        if(mysqli_num_rows($execute) <= 0 ){
            $query = "INSERT INTO `order`(userid, amount,duration, date, carId,status) VALUES($userId,$amount,'month',NOW(), $carId,'booked')";
            $execute = mysqli_query($connection,$query);
            if($execute){
                if($page === 'home'){
                    header("Location: ../home.php");
                }
                else if ($page === 'cars'){
                    header("Location: ../car.php");
                }
                else{
                    header("Location: ../car-single.php?carId=$carId");
                }
            }
            else{
                if($page === 'home'){
                    header("Location: ../home.php");
                }
                else if ($page === 'cars'){
                    header("Location: ../car.php");
                }
                else{
                    header("Location: ../car-single.php?carId=$carId");
                }
            }
        }
    }
   }
   book();
}

if(isset($_POST['remove'])){
    function remove_booked(){
        include('./connection.php');
        $carId = $_POST['bookId'];
        $page = $_POST['page'];
        $query = "DELETE  FROM `order` WHERE carId = $carId";
        $execute = mysqli_query($connection, $query);
        if ($execute){
            if($page === 'home'){
                header("Location: ../home.php");
            }
            else if ($page === 'cars'){
                header("Location: ../car.php");
            }
            else{
                header("Location: ../car-single.php?carId=$carId");
            }            
        }
        else{
            if($page === 'home'){
                header("Location: ../home.php");
            }
            else if ($page === 'cars'){
                header("Location: ../car.php");
            }
            else{
                header("Location: ../car-single.php?carId=$carId");
            }            
        }

    }
    remove_booked();
}

?>