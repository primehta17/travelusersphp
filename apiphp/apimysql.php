<?php 

include('./db.php');
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $query = mysqli_query($conn, "SELECT * FROM apiusers WHERE id = $id");
            echo json_encode(mysqli_fetch_assoc($query));
        } else {
            $query = mysqli_query($conn, "SELECT * FROM apiusers");
            $data = [];
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
            echo json_encode($data);
        }
        break;

    case 'POST':
        $name = $input['name'];
        $email = $input['email'];
        $query = mysqli_query($conn, "INSERT INTO apiusers (name, email) VALUES ('$name', '$email')");
        echo json_encode(["message" => "Successfully inserted"]);
        break;

    case 'PUT':
        if (!isset($_GET['id'])) {
            echo json_encode(["error" => "ID is required for update"]);
            break;
        }
        $id = intval($_GET['id']);
        $name = $input['name'];
        $email = $input['email'];
        $query = mysqli_query($conn, "UPDATE apiusers SET name='$name', email='$email' WHERE id=$id");
        echo json_encode(["status" => 200, "message" => "Updated successfully"]);
        break;

    case 'DELETE':
        if (!isset($_GET['id'])) {
            echo json_encode(["error" => "ID is required for delete"]);
            break;
        }
        $id = intval($_GET['id']);
        $query = mysqli_query($conn, "DELETE FROM apiusers WHERE id=$id");
        echo json_encode(["message" => "Deleted successfully"]);
        break;

    default:
        echo json_encode(["error" => "No method matched"]);
}
?>
