<?php
// Attempt to connect to the database
$conn = mysqli_connect("localhost:3307", "root", "mysql", "dragon_stone");

// Check the connection:
if (!$conn) {
    die("Couldn't connect to database: " . mysqli_connect_error());
}

echo "Connected successfully!";

// Close the connection (optional but recommended)
mysqli_close($conn);
?>

