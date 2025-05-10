<?php include 'db.php'?>
<table class="table-border">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Button</th>
            </tr>
        </thead>
        <tbody>
        
                <?php 

                $select = mysqli_query($conn,"select * from `travelusers`");
                // echo $select;
                // $result = $conn->query($sql);
                // if ($result->num_rows > 0) {
                // while ($row = $result->fetch_assoc()) {
                    while ($row = mysqli_fetch_assoc($select)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['created_at']}</td>
                        <td>
                     
                  
                    
                        <a href='delete.php?id= {$row['id']}'>Delete</a>
                        </td>
                   </tr> ";
            }
                ?>
               
    
        </tbody>
    </table>