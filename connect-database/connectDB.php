<?php 
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
mysqli_set_charset($conn, 'utf8');
if ($conn->connect_error) {
    die('Connect Error, ' . $conn->connect_error);
}
?>