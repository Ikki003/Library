
<?php

require "database.php";

session_start();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}

$id = $_GET["id"];

$statement = $conn->prepare("Select * from books where id = :id LIMIT 1");
$statement->execute([":id" => $id]);

if ($statement->rowCount() == 0) {
  http_response_code(404);
  echo("HTTP 404 NOT FOUND");
  return;
}

$contact = $statement->fetch(PDO::FETCH_ASSOC);

if ($contact["user_id"] !== $_SESSION["user"]["id"]) {
  http_response_code(403);
  echo("HTTP 403 UNAUTHORIZED");
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

      $statement = $conn->prepare("Update books set name = :name, author = :author where id = :id");
      $statement->execute([
        ":id" => $id,
        ":name" => $_POST["name"],
        ":author" => $_POST["author"],
      ]);

      header("Location: home.php");
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
            <form method="POST" action="edit.php?id=<?= $contact["id"] ?>">
              <div class="mb-3 row">
                <label
                  for="name"
                  class="col-md-4 col-form-label text-md-end"
                  >Name</label
                >

                <div class="col-md-6">
                  <input
                    value="<?= $contact["name"] ?>"
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
                    value="<?= $contact["author"] ?>"
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
