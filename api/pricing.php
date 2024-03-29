<?php 
session_start();

if(isset($_POST['price'])){
   function pricing(){
    
    include('./connection.php');
    $carId = $_POST['carId'];
    $userId = $_SESSION['userId'];
    $duration = $_POST['duration'];
    
    
    //check if the user has booked the car
    $query = "SELECT * FROM `order` WHERE userId =$userId AND carId = $carId";
    $execute = mysqli_query($connection, $query);

    if(mysqli_num_rows($execute) >= 1){
        //get the amount
        $query = "SELECT * FROM cars WHERE id = $carId";
        $execute = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($execute);
        $amount = $row[$duration];
       
        //confirm the booking status
        $query = "UPDATE `order` SET status = 'booked', duration = '$duration',amount = $amount WHERE carId = $carId AND userId = $userId";
        $execute = mysqli_query($connection, $query);
        if($execute){
            header('Location: ../pricing.php');
            exit();
        }
        else{
            header('Location: ../pricing.php');
            exit();
        }

    }
    else{
        
        //get payment amount from
        $query = "SELECT * FROM cars WHERE id = $carId";
        $execute = mysqli_query($connection, $query);
        if(mysqli_num_rows($execute) >=1){
            
            $row = mysqli_fetch_array($execute);
            $amount = $row[$duration];
 
            //make a book and confirm it
            $query = "INSERT INTO `order`(userid, amount,duration, date, carId,status) VALUES($userId,$amount,'$duration',NOW(), $carId,'booked')";
            $execute = mysqli_query($connection,$query);

            if($execute){
                header('Location: ../pricing.php');
                exit();
            }
            else{
                header('Location: ../pricing.php');
                exit();
            }
        }

    }
   }
   pricing();
}
?>