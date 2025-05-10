<?php
   $insert= false;
   $server="localhost";
$username="root";
$password="";
$database ="Users";

$conn=mysqli_connect($server,$username,$password,$database);
  if(!$conn){
    die("Connection FAILED Due to". mysqli_connect_error());
  }
 if(isset($_POST['name'])){



    // echo "Success connected to db";
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);

  if(empty($name) || empty($email)){
    echo "Name and email are required";
  }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "Valid email format";
  }else{
    $sql = "Insert into `travelusers` (`name`,`email`) values('$name','$email')";
    // echo $sql;
    if($conn->query($sql)==true){
        // echo "Succesfully Submitted";
        $insert = true;
    }else{
        echo "ERROR: $sql <br> $conn->err";
    }
  }
   
  }
?>