<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
<main class="col-md-14 col-lg-10 px-md-10">  
  <div class="container">
    <h1>Login</h1>
    <?php
    !session_start();
    include_once 'login.php';
    $con = mysqli_connect("localhost", "root", "", "ayalatpblanco");
    if (!$con) {
      die("Could not connect to the database");
    }
    if (isset($_SESSION['username'], $_SESSION['id'])) {
        header("Location: index.php");
        exit();
    }
    if (isset($_POST['email']) && isset($_POST['contrasenia'])) {
      $email = $_POST['email'];
      $password = $_POST['contrasenia'];
      $sql = "SELECT * FROM usuarios WHERE username='$email' AND password='$password'";
      $result = mysqli_query($con, $sql);
      $user = mysqli_fetch_assoc($result);

      if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['id'] = $user['id'];  // Corrección aquí
        header("Location: index.php");
        exit();
    } else {
        echo "Credenciales incorrectas. Por favor, inténtelo de nuevo.";
    }
  }
    ?>
    <form method="post">
      <input type="text" name="email" placeholder="Username">
      <input type="password" name="contrasenia" placeholder="Password">
      <input type="submit" value="Login">
    </form>
    <a href="register.php"><h1>Registrate</h1></a>
  </div>
</main>  
</body>
</html>
