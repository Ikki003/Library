<?php

require "database.php";

$books = $conn->query("Select * from books");
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

    </main>
  </body>
</html>
