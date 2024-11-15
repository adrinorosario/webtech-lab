<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "mozilla_users";

$con = mysqli_connect($host, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

function displayResults($result) {
    if (mysqli_num_rows($result) == 0) {
        echo "0 results";
        return;
    }

    echo "<table border='1'><tr><th>User ID</th><th>Username</th><th>Email</th><th>Preferred Product</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

if(isset($_POST['insert'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $product = $_POST['product'];

    $sql = "INSERT INTO mozilla_users (user_id, username, email, product) VALUES ('$user_id', '$username', '$email', '$product')";

    if (mysqli_query($con, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

if(isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $product = $_POST['product'];

    $sql = "UPDATE mozilla_users SET username='$username', email='$email', product='$product' WHERE user_id='$user_id'";

    if (mysqli_query($con, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

if(isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];

    $sql = "DELETE FROM mozilla_users WHERE user_id='$user_id'";

    if (mysqli_query($con, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}

if(isset($_POST['select'])) {
    $sql = "SELECT * FROM mozilla_users";
    $result = mysqli_query($con, $sql);

    displayResults($result);
}

mysqli_close($con);

?>