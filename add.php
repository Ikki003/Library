
<?php

require "database.php";

session_start();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}

$error = null;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["author"])) {
      $error = "Please fill all the fields.";
    } else if (strlen($_POST["name"]) < 2) {
      $error = "Name must be at least 2 characters.";
    } else {
      $name = $_POST["name"];
      $author = $_POST["author"];

      $statement = $conn->prepare("Insert into books (user_id, name, author) values ({$_SESSION['user']['id']}, :name, :author)");
      $statement->bindParam(":name", $_POST["name"]);
      $statement->bindParam(":author", $_POST["author"]); //se puede meter dirctamente variable $name y $author ?????
      $statement->execute();

      $_SESSION["flash"] = ["message" => "Book {$_POST['name']} added."];

      header("Location: home.php");
      return;
    }
}
?>

<?php require "partials/header.php" ?>
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
                  for="author"
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
<?php require "partials/footer.php" ?>
