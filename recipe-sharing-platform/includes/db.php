<?php
$host = 'localhost';
$user = 'root';
$pass = 'Anshu@2024';
$db_name = 'recipes';

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
else {
    // echo "Connection successful";
}
?>
