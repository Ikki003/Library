<?php

require "database.php";

session_start();

$id = $_GET["id"];

$statement = $conn->prepare("Select * from books where id = :id limit 1");
$statement->execute([":id" => $id]);

if ($statement->rowCount() == 0) {
  http_response_code(404);
  echo("HTTP 404 NOT FOUND");
  return;
}

$books = $statement->fetch(PDO::FETCH_ASSOC);

if ($books["user_id"] !== $_SESSION["user"]["id"]) {
  http_response_code(403);
  echo("HTTP 403 UNAUTHORIZED");
  return;
}


$conn->prepare("Delete from books where id = :id")->execute([":id" => $id]);

// $statement = $conn->prepare("Delete from books where id = :id");
// $statement->execute([":id" => $id]);

// $statement->bindParam(":id", $id);
// $statement->execute();

$_SESSION["flash"] = ["message" => "Book {$books['name']} deleted."];

header("Location: home.php");

?>
