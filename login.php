<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_auth');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "Login successful! Welcome,. $username  <a href='index.html'>Home</a>";
        } else {
            echo "Invalid password! <a href='index.html'>Login again</a>";
        }
    } else {
        echo "User not found!";
    }
}

$conn->close();
?>