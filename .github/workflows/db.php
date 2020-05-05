<?php
$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "root");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>