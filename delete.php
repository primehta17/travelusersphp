<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = mysqli_query($conn, 'DELETE FROM travelusers WHERE id=`$id`');

    if ($sql) {
        header("Location: index.php?deleted=1");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
