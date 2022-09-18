<?php

require "database.php";

$id = $_GET["id"];

$statement = $conn->prepare("Select * from books where id = :id");
$statement->execute([":id" => $id]);

if ($statement->rowCount() == 0) {
  http_response_code(404);
  echo("HTTP 404 NOT FOUND");
  return;
}

$conn->prepare("Delete from books where id = :id")->execute([":id" => $id]);

// $statement = $conn->prepare("Delete from books where id = :id");
// $statement->execute([":id" => $id]);

// $statement->bindParam(":id", $id);
// $statement->execute();

header("Location: index.php");

?>
