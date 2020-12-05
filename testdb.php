<?php 
    include("libs/db.php");
    //get user len

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      $sql = "SELECT id, `user_name`, `pass` FROM user";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "id: " . $row["id"]. " - Name: " . $row["user_name"]. " " . $row["pass"]. "<br>";
        }
      } else {
        echo "0 results";
      }
      $conn->close();
?>