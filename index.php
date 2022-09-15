<?php
$contacts = [
  ["name" => "Pepe", "author" => "Pepe"],
  ["name" => "Juan", "author" => "Juan"],
  ["name" => "Marcos", "author" => "Marcos"],
  ["name" => "Marcos", "author" => "Marcos"],
  ["name" => "Marcos", "author" => "Marcos"],
  ["name" => "Marcos", "author" => "Marcos"],
]

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
              <a class="nav-link" href="/library/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/library/add.html">Add Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main>
      

      <div class="container pt-5 p-20">
      <div class="row">
        <?php foreach ($contacts as $contact): ?>
        <div class="mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-capitalize"><?= $contact["name"] ?></h5>
              <p class="m-2"><?= $contact["author"] ?></p>
              <button class="btn btn-secondary btn-sm mb-2" type="button">Edit Book</button>
              <button class="btn btn-danger btn-sm mb-2" type="button">Delete Book</button>
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>
      </div>

    </main>
  </body>
</html>
