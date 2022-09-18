
<?php

require "database.php";

$error = null;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["author"])) {
      $error = "Please fill all the fields.";
    } else if (strlen($_POST["name"]) < 2) {
      $error = "Name must be at least 2 characters.";
    } else {
      $name = $_POST["name"];
      $author = $_POST["author"];

      $statement = $conn->prepare("Insert into books (name, author) values (:name, :author)");
      $statement->bindParam(":name", $_POST["name"]);
      $statement->bindParam(":author", $_POST["author"]);
      $statement->execute();

      header("Location: index.php");
    }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.0/darkly/bootstrap.min.css"
      integrity="sha512-gUckM9ucxSOwqWuP2kRpTZjtzXfgyKGUlMbXcOq9SAXY+qubqqJTht1XHZvK8rUjFKylKb+gtTK2IiOK3jk4TA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
      crossorigin="anonymous"
    ></script>

    <!-- Static Content -->
    <link rel="stylesheet" href="./static/css/index.css" />

    <title>Library</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand font-weight-bold" href="#">
          <img class="mr-2" src="./static/img/logo.png" />
          Library
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./add.php">Add Book</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main>
      <div class="container pt-5">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">Add New Book</div>
              <div class="card-body">
                <?php if ($error): ?>
                  <p class="text-danger">
                    <?= $error ?>
                  </p>
                <?php endif ?>
                <form method="POST" action="add.php">
                  <div class="mb-3 row">
                    <label
                      for="name"
                      class="col-md-4 col-form-label text-md-end"
                      >Name</label
                    >

                    <div class="col-md-6">
                      <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        
                        autocomplete="name"
                        autofocus
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="phone_number"
                      class="col-md-4 col-form-label text-md-end"
                      >Author</label
                    >

                    <div class="col-md-6">
                      <input
                        id="author"
                        type="text"
                        class="form-control"
                        name="author"
                        
                        autocomplete="author"
                        autofocus
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                        Submit
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
