<?php

$host = "localhost";
$database = "library";
$user = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
  // foreach ($conn->query("SHOW DATABASES") as $row) {
  //   print_r($row);
  // }
  // die();
} catch (PDOException $e) {
  die("PDO COnnection Error: " . $e->getMessage());
}
