<?php
// save_registration.php
require_once 'session_start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration = [
        'id' => uniqid(),
        'firstName' => htmlspecialchars($_POST['firstName']),
        'lastName' => htmlspecialchars($_POST['lastName']),
        'email' => htmlspecialchars($_POST['email']),
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'country' => htmlspecialchars($_POST['country']),
        'gender' => htmlspecialchars($_POST['gender']),
        'created_at' => date('Y-m-d H:i:s')
    ];

    $_SESSION['registrations'][] = $registration;
    echo json_encode(["success" => true]);
}
?>