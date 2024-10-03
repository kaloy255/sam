<?php 
    include_once("dbconnect.php");


   
    global $errorMessage ,$successfullRegister;

    if (isset($_POST['register'])) {
        $employee_id = $_POST['employee-id'];

        $errorMessage = "";
        $successfullRegister = "";
        
        // Check if the employee ID already exists
        $queryCheck = "SELECT * FROM employee_table WHERE employee_id = $employee_id";
        $stmt = $connection->prepare($queryCheck);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Employee ID already exists
            $errorMessage ="Employee ID already exists. Please use a different ID.";
        } else {
            // Proceed with registration if employee ID is not duplicate
            $surname = $_POST['surname']; 
            $fullname = $_POST['fullname']; 
            $password = $_POST['password']; 
            
            $sql = "INSERT INTO employee_table (employee_id, username, fullname, `password`) VALUES (?, ?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("isss", $employee_id, $surname, $fullname, $password);
            
            if ($stmt->execute()) {
                $successfullRegister =  "Employee registered successfully!";
            } else {
                echo "Error: " . $connection->error;
            }
        }

        $stmt->close();
    }

    $connection->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER AN ACCOUNT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center items-center h-screen">
    <form action="" method="post" class="flex flex-col gap-5 bg-blue-200 p-5 rounded-lg">
        <span><?=$successfullRegister?></span>
        <p>Enter your Employee-ID: <input class="border-[1px] border-black rounded-lg px-2" type="number" name="employee-id" required>
        <br>
        <span class="text-red-500"><?= $errorMessage?></span></p>

        <p>Enter your Username: <input class="border-[1px] border-black rounded-lg px-2" type="text" name="surname" required></p>

        <p>Enter your FullName: <input class="border-[1px] border-black rounded-lg px-2" type="text" name="fullname" required></p>

        <p>Enter your Password: <input class="border-[1px] border-black rounded-lg px-2" type="password" name="password" required></p>

        <div class="flex items-center gap-5">
            <input class="bg-blue-500 p-2 rounded-xl" type="submit" value="Register" name="register">
            <a class="text-blue-500" href="login.php">Login</a>
        </div>
    </form>

    



</body>
</html>