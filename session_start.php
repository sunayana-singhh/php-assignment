<?php
// session_start.php
session_start();
if (!isset($_SESSION['registrations'])) {
    $_SESSION['registrations'] = [];
}
?>