
<?php

require "database.php";

$error = null;

if($_SERVER["REQUEST_METHOD"] == "POST") {
      //Comprobar que nos estén vacíos los campos
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
      $error = "Please fill all the fields.";
      // Comprobar que el correo tenga @ porque el campo tipo email ya lo comprueba pero tb nos lo pueden mandar por curl u otros y no lo comprobaria
    } else if (!str_contains($_POST["email"], "@")) {
      $error = "Email format is incorrect.";
    } else {
      $statement = $conn->prepare("Select * from users where email = :email");
      $statement->bindParam(":email", $_POST["email"]);
      $statement->execute();

      if ($statement->rowCount() > 0) {
        $error = "This email is taken.";
      } else {
        $statement = $conn->prepare("Insert into users (name, email, password) values (:name, :email, :password)");
        $statement->execute([
          ":name" => $_POST["name"],
          ":email" => $_POST["email"],
          ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
        ]);

        $statement = $conn->prepare("Select * from users where email = :email limit 1");
        $statement->bindParam(":email", $_POST["email"]);
        $statement->execute();
        //Tenemos un usuario como array y podemos acceder a su id, email...
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION["user"] = $user;

        header("Location: home.php");
      }
    }
}
?>

<?php require "partials/header.php" ?>
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Register</div>
          <div class="card-body">
            <?php if ($error): ?>
              <p class="text-danger">
                <?= $error ?>
              </p>
            <?php endif ?>
            <form method="POST" action="register.php">
              <div class="mb-3 row">
                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" autocomplete="name" autofocus/>
                </div>
              </div>

              <div class="mb-3 row">
                <label
                  for="email"
                  class="col-md-4 col-form-label text-md-end">Email</label>

                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    name="email"
                    
                    autocomplete="email"
                    autofocus
                  />
                </div>
                </div>

                <div class="mb-3 row">
                <label
                  for="phone_number"
                  class="col-md-4 col-form-label text-md-end"
                  >Password</label
                >

                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    class="form-control"
                    name="password"
                    
                    autocomplete="password"
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
