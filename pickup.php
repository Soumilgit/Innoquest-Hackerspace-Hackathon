<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = 'Rootroot';
$db_name = 'wms';

// Create a connection to the database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $pickup_date = $_POST["pickup_date"];
    $pickup_time = $_POST["pickup_time"];
    $address = $_POST["address"];
    $specific_details = $_POST["specific_details"];
    $waste_type = $_POST["waste_type"];
    $waste_quantity = $_POST["waste_quantity"];

    // Insert data into the database
    $sql = "INSERT INTO waste_pickup_requests (name, email, phone, pickup_date, pickup_time, address, specific_details, waste_type, waste_quantity) VALUES ('$name', '$email', '$phone', '$pickup_date', '$pickup_time', '$address', '$specific_details', '$waste_type', '$waste_quantity')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>