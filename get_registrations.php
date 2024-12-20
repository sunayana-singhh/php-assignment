<?php
// get_registrations.php
require_once 'session_start.php';

// Sort registrations by created_at in descending order
$registrations = $_SESSION['registrations'];
usort($registrations, function($a, $b) {
    return strtotime($b['created_at']) - strtotime($a['created_at']);
});

echo json_encode($registrations);
?>