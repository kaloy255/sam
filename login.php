<?php include_once("dbconnect.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
</head>
<body>
    <form action="" method="post">
        <p>EMPLOYEE_ID: <input type="text" name="employee-id" required></p>
        <p>PASSWORD: <input type="password" name="password" required></p>
        <input type="submit" value="Login" name="login">
        <a href="register.php">Register</a>
    </form>

    <?php
    if(isset($_POST['login'])) {
      $employee_id = $_POST['employee-id'];
      $password = $_POST['password'];

        $query = "SELECT * FROM employee_table WHERE employee_id = '$employee_id' AND `password` = '$password'";
        $statement = mysqli_query($connection, $query);
        $result = mysqli_num_rows($statement);

        if($result == 1) {
            echo "<script>window.alert('Login Successfully'); window.location.href='index.php';</script>";
        } else {
            echo "<script>window.alert('Incorrect Username or Password');</script>";
        }
    }
    ?>
</body>