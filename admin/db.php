<?php
$host="localhost";
$username="root";
$password="Iqr-5420607";
$db_name="movie_ticket_booking";
// Create connection
$conn = new \mysqli($host, $username, $password,$db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
