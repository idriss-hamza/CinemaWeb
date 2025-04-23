<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['number'];

    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists!";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (username, email, password, phone) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $password, $phone);
        
        if ($stmt->execute()) {
            header("Location: signin.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $stmt->close();
}
$conn->close();
?> 