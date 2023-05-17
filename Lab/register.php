<?php
// Retrieve form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$gender = $_POST['gender'];

// Validate form data
$errors = [];
if (empty($full_name)) {
    $errors[] = "Full Name is required.";
}

if (empty($email)) {
    $errors[] = "Email Address is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid Email Address.";
}

if (empty($gender)) {
    $errors[] = "Gender is required.";
}

// If there are errors, display them and stop further processing
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    exit;
}

// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "uygulama";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the students table
$sql = "INSERT INTO students (full_name, email, gender) VALUES ('$full_name', '$email', '$gender')";
if ($conn->query($sql) === true) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
