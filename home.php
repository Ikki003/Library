<?php

require "database.php";

session_start();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}
//En varoables simples no necesitamos las llaves pero como tenemos un diccionario(array) en el que queremos sacar las claves necesitamos las llaves para que php lo lea bien xd
$books = $conn->query("Select * from books where user_id = {$_SESSION['user']['id']}");
// var_dump($books);
// die();
?>
     
<?php require "partials/header.php" ?>

<div class="container pt-5 p-20">
<div class="row">
  <?php if ($books->rowCount() == 0): ?>
    <div class="col-md-4 mx-auto">
      <div class="card card-body text-center">
        <p>No contacts saved yet</p>
        <a href="./add.php">Add One!</a>
      </div>
    </div>
  <?php endif ?>
  <?php foreach ($books as $book): ?>
  <div class="mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?= $book["name"] ?></h5>
        <p class="m-2"><?= $book["author"] ?></p>
        <div class="d-grid gap-2 float-end ">
          <a href="edit.php?id=<?= $book["id"] ?>" class="btn btn-secondary mb-2 btn-sm">Edit Contact</a>
          <a href="delete.php?id=<?= $book["id"] ?>" class="btn btn-danger mb-2 btn-sm">Delete Contact</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach ?>
</div>
</div>

<?php require "partials/footer.php" ?>
