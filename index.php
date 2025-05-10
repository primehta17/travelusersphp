<?php include 'db.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h2>TRAVEL FORM ✈️</h2>
        <?php

        if($insert == true){
            echo "<p>Thanks for submitting the form</p>";
        }
      
        ?>
        <form action="" method="POST">

            <div class="row">
                <label>FullName</label>
                <div>
                    <input type="text" name="name" placeholder="Name">   
                </div>
                   </div>
            <div class="row">
                <label>Email</label>
                <div>
                    <input type="text" name="email" placeholder="Email">
                </div>
                     </div>
            <button type="submit">Submit</button>
          </form>
    </div>
    <div>
        <?php include 'table.php' ?>
 
        <?php
        $conn->close();    
        ?>
    </div>
</body>
</html>
