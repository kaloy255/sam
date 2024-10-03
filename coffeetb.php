<?php include_once("dbconnect.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COFFEE INVENTORY DISPLAY</title>
</head>
<body>
    <form action="" method="post">
        <h1>COFFEE</h1>
        <p>Ingredient: <input type="text" name="name" required></p>
        <p>Quantity: <input type="text" name="quantity" required></p>
        <p>Acquisition Date: <input type="text" name="acquisition_date" required></p>
        <p>Expiry Date: <input type="password" name="expiry_date" required></p>
        <input type="submit" value="ADD to Stock" name="stock">
    </form>

    <?php
    if(isset($_POST['stock'])){
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $acquisition_date = $_POST['acquisition_date'];
        $expiry_date = $_POST['expiry_date'];


        $query = "INSERT INTO Coffee (name, quantity, acqusition_date, expiry_date) VALUES ('$name','$quantity','$acquisition_date','$expiry_date')";
        mysqli_query($connection, $query);
        echo "Added Succesfully";

    }
    ?>
  <h1>User Database</h1>
    <table>
        <tr>
            <th>NAME</th>
            <th>QUANTITY</th>
            <th>ACQUISITION DATE</th>
            <th>EXPIRY DATE</th>
        </tr>

        <?php
        $query = "SELECT * FROM Coffee";
        $fetch = mysqli_query($connection, $query);

        if (!$fetch) {
            echo "<tr><td colspan='4'>Error fetching data!</td></tr>";
        } else {
            while ($row = $fetch->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
            <td><?php echo htmlspecialchars($row['acquisition_date']); ?></td>
            <td><?php echo htmlspecialchars($row['expiry_date']); ?></td>
        </tr>
        <?php 

            } 
        } 
        ?>
    </table>

</body>
</html>