<?php
// Step 1: Database connection (phpMyAdmin should be running with MySQL server)
$servername = "localhost"; // Default local server
$username = "root"; // Default username for XAMPP/WAMP
$password = ""; // Default password (blank for XAMPP/WAMP)
$dbname = "waste_management"; // Your database name
// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check the connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// Step 2: Create database if not exists (You only need to run this once)
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);
// Step 3: Create the table if not exists
$sql_create_table = "CREATE TABLE IF NOT EXISTS waste_details (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
address VARCHAR(255) NOT NULL,
waste_type VARCHAR(50) NOT NULL,
quantity DECIMAL(10, 2) NOT NULL,
date DATE NOT NULL
)";
$conn->query($sql_create_table);
// Step 4: Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = $_POST['name'];
$address = $_POST['address'];
$waste_type = $_POST['waste_type'];
$quantity = $_POST['quantity'];
$date = $_POST['date'];
// SQL query to insert the data into the database
$sql_insert = "INSERT INTO waste_details (name, address, waste_type, quantity, date)
VALUES ('$name', '$address', '$waste_type', '$quantity', '$date')";
if ($conn->query($sql_insert) === TRUE) {
echo "<script>alert('Data submitted successfully!');</script>";
} else {
echo "<script>alert('Error: " . $conn->error . "');</script>";
}
}
// Step 5: Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Waste Management Form</title>
<style>
/* Basic reset */
* {
margin: 0;
padding: 0;
box-sizing: border-box;
}
body {
font-family: Arial, sans-serif;
background-color: #f4f4f4;
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
margin: 0;
}
.container {
width: 80%;
max-width: 700px;
background-color: #fff;
padding: 20px;
border-radius: 8px;
box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}
h2 {
text-align: center;
color: #2e8b57;
margin-bottom: 20px;
}
form label {
font-size: 1rem;
margin-bottom: 8px;
display: block;
}
input, select, button {
width: 100%;
padding: 10px;
margin: 10px 0 20px;
border: 1px solid #ccc;
border-radius: 5px;
font-size: 1rem;
}
button {
background-color: #4CAF50;
color: white;
border: none;
cursor: pointer;
font-size: 1rem;
}
button:hover {
background-color: #45a049;
}
.alert {
color: red;
font-size: 0.9rem;
margin-bottom: 10px;
}
</style>
</head>
<body>
<div class="container">
<h2>Waste Management Form</h2>
<form action="" method="POST" id="wasteForm">
<!-- Name Input -->
<label for="name">Full Name:</label>
<input type="text" id="name" name="name" required>
<!-- Address Input -->
<label for="address">Address:</label>
<input type="text" id="address" name="address" required>
<!-- Waste Type Dropdown -->
<label for="waste_type">Waste Type:</label>
<select name="waste_type" id="waste_type" required>
<option value="Plastic">Plastic</option>
<option value="Organic">Organic</option>
<option value="E-Waste">E-Waste</option>
<option value="Paper">Paper</option>
</select>
<!-- Quantity Input -->
<label for="quantity">Quantity (in kg):</label>
<input type="number" id="quantity" name="quantity" min="0.1" step="0.1" required>
<!-- Date Input -->
<label for="date">Date:</label>
<input type="date" id="date" name="date" required>
<!-- Submit Button -->
<button type="submit">Submit</button>
</form>
</div>
<script>
// JavaScript for form validation
document.getElementById('wasteForm').addEventListener('submit', function(event) {
let name = document.getElementById('name').value;
let address = document.getElementById('address').value;
let quantity = document.getElementById('quantity').value;
// Simple validation to ensure quantity is a positive number
if (parseFloat(quantity) <= 0) {
event.preventDefault();
alert('Please enter a valid quantity greater than 0.');
}
if (name === '' || address === '') {
event.preventDefault();
alert('Please fill in all required fields.');
}
});
</script>
</body>
</html>