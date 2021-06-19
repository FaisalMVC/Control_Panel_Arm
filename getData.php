<?php
  $host = "localhost";
  $userName = "root";
  $password = "";
  $dbName = "control";

  $connection = new mysqli($host ,$userName ,$password ,$dbName);

  if($connection->connect_error){
      die('Error'. $connection->connect_error);
  }

  $statment1 = "SELECT m1,m2,m3,m4,m5,m6 FROM arm_angle
               WHERE id = (SELECT MAX(id) from arm_angle)";
  $statment2 = "SELECT isWorking FROM run_arm
               WHERE id = (SELECT MAX(id) from run_arm)";

  $result1 = $connection->query($statment1);
  $result2 = $connection->query($statment2);

  $result2 = $result2->fetch_assoc();

  if($result2["isWorking"] == 1){
    $result2 = "on";
  }else{
    $result2 = "off";
  }

  if($result1->num_rows > 0){
    while ($row = $result1->fetch_assoc()) {
      echo $row["m1"] ." ". $row["m2"]." ".
           $row["m3"] ." ". $row["m4"]." ".
           $row["m5"] ." ". $row["m6"]." ".$result2;
    }
  }
  
  $connection->close();

  ?>
