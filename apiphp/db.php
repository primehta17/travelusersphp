<?php 

$localhost='localhost';
$username='root';
$password="priyanka";
$database="apitravel";

$conn= new mysqli($localhost,$username,$password,$database);

if(!$conn){
    die ("Error is ". $conn->connect_error());
}else{
    echo "Connected";
}

?>
