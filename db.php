<?php
$conn = mysqli_connect("localhost", "root", "", "scholarship_portal");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Session start taake hum student ka data yaad rakh saken
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>