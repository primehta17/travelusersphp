<?php

header('Content-Type: application/json');

$dataFile = 'data.json';

//Ensure the data file exists

if(!file_exists($dataFile)){
    file_put_contents($dataFile, json_encode([]));
}

//Load existinf data
$data = json_decode(file_get_contents($dataFile),true);

//Determine the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

//Parse the input
$input = json_decode(file_get_contents('php://input'),true);

//Handle different HTTP mrthods
switch ($method){
    case 'GET':
        echo json_encode($data);
        break;
    case 'POST':
        $input['id'] = time(); //Simple unique ID
        $data[] = $input;
        file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode(['message'=> 'Record succefully submitted!']);
        break;
    case 'PUT':
        if(!isset($_GET['id'])){
            echo json_encode(['error'=>'ID is required']);
            break;
        }
        $id = $_GET['id'];
        $found=false;
        foreach($data as &$record){
            if($record['id'] == $id){
                $record = array_merge($record, $input);
                $found = true;
                break;
            }
        }
        if($found){
            file_put_contents($dataFile, json_encode($data,  JSON_PRETTY_PRINT));
            echo json_encode(['message'=> 'Record updated successfully']);
        }else{
            echo json_encode(['error' => 'Record not found']);
        }
        break;

        case 'DELETE':
        if(!isset($_GET['id'])){
            echo json_encode(['error' => 'ID id required']);
            break;
        }
        $id = $_GET['id'];
        $data =array_filter($data, function ($record) use ($id){
            return $record['id'] != $id;
        });
        file_put_contents($dataFile, json_encode(array_values($data), JSON_PRETTY_PRINT));
        echo json_encode(['message'=>'Record deleted']);
        break;

        default:
        echo json_encode(['error'=>"Unsupported request method"]);
        break;
}
?>