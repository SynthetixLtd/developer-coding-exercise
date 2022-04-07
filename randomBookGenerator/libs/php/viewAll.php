<?php

include_once './config.php';
                                         
    $conn = new mysqli($cd_host, $cd_user, $cd_password, $cd_dbname, $cd_port, $cd_socket);
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result-> fetch_assoc()) {
    ?>

        <tr> 
                <td><?=$row['book_id'];?></td>                                   
                <td><?=$row['title'];?></td>
                <td><?=$row['author'];?></td>
                <td><?=$row['category'];?></td>
                <td><?=$row['publisher'];?></td>
        </tr>

  <?php                                                      
          }
       }
        else {
            echo " 0 results";
        }
        mysqli_close($conn);
  ?>   
