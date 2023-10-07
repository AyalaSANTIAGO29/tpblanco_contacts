<!DOCTYPE html>
<html>
<head>
  <title>Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<?php
$con = mysqli_connect("localhost", "root", "", "ayalatpblanco");
if (!$con) {
  die("Could not connect to the database");
}
if (isset($_POST['email'])) {
  $email = $_POST['email'];
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('No es un email') </script>";

  }

  $contrasenia = $_POST['contrasenia'];
  if (strlen($contrasenia) < 1) {
    echo "<script>alert('no aceptamos un solo caracter') </script>";
  }
}
if (isset($_POST['email'])) {
  $sql = "INSERT INTO usuarios (username, password)
  VALUES ('$email', '$contrasenia');";
  mysqli_query($con, $sql);
  header("Location: login.php");
}

?>
<body>
  <div class="container">
    <h1>Registro</h1>
    <form method="post">
      <input type="text" name="email" placeholder="Correo electrónico">
      <input type="password" name="contrasenia" placeholder="Contraseña">
      <input type="submit" value="Registrar">
    </form>
    <a href="login.php"><h1>Login</h1></a>
  </div>
</body>
</html>
