<?php 

include('./db');
header("Content-Type","application/json");

$method = $_SERVER['REQUEST_METHOD'];

$input = json_decode(file_get_contents("php://input"),true);

switch($method){
    case 'GET':
        if(isset($id)){
            $id = $_GET['id'];
            $query = mysqli_query($conn,'select * from apiusers');

            json_encode(fetch_assoc($query));
        }else{
            $query = mysqli_query($conn,'select * from apiusers');
            $data=[];
            while($row= mysqli_fetch_assoc($query)){
                $data[] = $row;
            }
            json_encode($data);
        }
        break;
    case 'POST':
        $name = $input['name'];
        $email =$input['email'];
        $query= mysqli_query($conn,"Insert into apiusers (name,email) values ($name,$email)");
        json_encode("message:Succefully inserted");
        break;

    case "PUT":
        if(isset($id)){
           echo "enter valid id";
            
        }else{
            $id= $_GET['id'];
            $name = $input['name'];
            $email =$input['email'];
            $query= mysqli_query($conn,"update apiusers set name='$name' , email='$email' where id='$id");
           echo json_encode(["status"=>200,"message"=>"Updateed succesfully"]);
           
        }; break;
        case "DELETE":
            $id= $_GET['id'];
            $query =mysqli_query($conn,"Delete from apiusers where id='$id'");
            echo json_encode(["message"=>"Delete succedful"]);
            break;
      case "DEFAULT":
        echo "no method matched";



}



?>
