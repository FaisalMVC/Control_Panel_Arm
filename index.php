<?php

  $host = "localhost";
  $userName = "root";
  $password = "";
  $dbName = "control";

      if(isset($_POST["Save"])) {

        $connection = new mysqli($host, $userName, $password, $dbName);

          $_motor1 =  $_POST["Motor1"];
          $_motor2 =  $_POST["Motor2"];
          $_motor3 =  $_POST["Motor3"];
          $_motor4 =  $_POST["Motor4"];
          $_motor5 =  $_POST["Motor5"];
          $_motor6 =  $_POST["Motor6"];

          $sql_1 = "INSERT INTO arm_angle (m1, m2, m3, m4, m5, m6)
                  values ('$_motor1', '$_motor2', '$_motor3', '$_motor4', '$_motor5', '$_motor6') ";
          $sql_2 = "INSERT INTO run_arm (isWorking)
                  values('false')";

              if($connection->query($sql_1) && $connection->query($sql_2)){
                echo "<h2>Done the record have been saved!</h2> <h3>just wait 5 seconds then you will get back to control page</h3>";
                header("Refresh: 5; URL=http://127.0.0.1/Arm/Arm_angle_controal.html");
              }else{
                echo "There is a problem ". $connection->error;
              }

          $connection->close();

        } else if(isset($_POST["Run"])) {

            $connection = new mysqli($host, $userName, $password, $dbName);
            $query = "SELECT * FROM arm_angle";
            $result = mysqli_query($connection,$query);

            if ($result) { // this command check if there any record in the data base or not if not then it can't run the arm.
              if (mysqli_num_rows($result) > 0) {
                $query_2 = "INSERT INTO run_arm (isWorking)
                            values(true)";
                if($connection->query($query_2)){
                echo '<h2>Done now it\'s working</h2>';
                echo "<h3>Just wait 5 seconds then you will get back to control page</h3>";
                header("Refresh: 5; URL=http://127.0.0.1/Arm/Arm_angle_controal.html");
              }
              } else {
                echo '<h2>You need to save the motors angle first then you can run it.</h2>';
                echo "<h3>Just wait 5 seconds then you will get back to control page</h3>";
                header("Refresh: 5; URL=http://127.0.0.1/Arm/Arm_angle_controal.html");
              }
            } else {
              echo 'Error: '.mysql_error();
            }

            $connection->close();

        }
?>
