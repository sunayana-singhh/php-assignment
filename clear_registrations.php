<?php
// clear_registrations.php
require_once 'session_start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['registrations'] = [];
    echo json_encode(["success" => true]);
}
?>