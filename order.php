<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_order_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $order_count = $_POST['order_count'];
    $food_order = $_POST['food_order'];
    $address = $_POST['address'];

    // Prepare and bind statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO orders (name, email, phone, order_count, food_order, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $order_count, $food_order, $address);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $stmt->error; // Return error message
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
