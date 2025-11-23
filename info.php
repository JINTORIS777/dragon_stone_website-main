<?php
$conn = mysqli_connect("localhost:3307", "root", "mysql", "dragon_stone");

// Check the connection
if (!$conn) {
    die("Couldn't connect to database: " . mysqli_connect_error());
}
echo "Connected successfully!<br><br>";

// Categories Table
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
echo "Categories: " . $result->num_rows . "<br>";

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
              </tr>";
    }
    echo "</table><br>";
}

// Products Table
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
echo "Products: " . $result->num_rows . "<br>";

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['description']}</td>
                <td>{$row['price']}</td>
                <td>{$row['image']}</td>
                <td>{$row['category']}</td>
              </tr>";
    }
    echo "</table><br>";
}

// Cart Table
$sql = "SELECT * FROM cart";
$result = $conn->query($sql);
echo "Cart: " . $result->num_rows . "<br>";

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Added At</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['product_id']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['added_at']}</td>
              </tr>";
    }
    echo "</table><br>";
}

// Orders Table
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
echo "Orders: " . $result->num_rows . "<br>";

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Added At</th>
                <th>Created At</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['added_at']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
    echo "</table><br>";
}

// Users Table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
echo "Users: " . $result->num_rows . "<br>";

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Created At</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['password']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
    echo "</table><br>";
}

// Close connection
$conn->close();
?>
