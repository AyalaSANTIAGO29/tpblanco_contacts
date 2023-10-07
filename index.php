<?php
include_once 'abm.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Lista de Contactos</title>
</head>
<body>
<main class="col-md-14 col-lg-10 px-md-10">
<?php
include_once 'abm.php';

if (isset($_SESSION['username'], $_SESSION['id'])) {
    $email = $_SESSION['username'];
    $usuario_id = $_SESSION['id'];
    echo '<br><a href="logout.php">Cerrar sesión</a>';
} else {
    echo "Por favor, inicie sesión";
}
?>
<div>
    <h1 class="d-flex justify-content-center">Formularios</h1>
    <h5 class="d-flex gap-2 justify-content-center">Alta de Usuario</h2>
    <form method="post">
        <div class="d-flex gap-2 justify-content-center py-5">
            <br></br>
            <input type="text" name="Name" placeholder="Nombre" required>
            <input type="text" name="Surname" placeholder="Apellido" required>
            <input type="text" name="Phonenumber" placeholder="Número de teléfono" required>
            <input type="text" name="Company" placeholder="Empresa" required>
            <input type="text" name="Address" placeholder="Dirección" required>
            <input type="submit" class="btn btn-success px-3" name="alta" value="Alta">
        </div>
    </form>
</div>
<div class="b-example-divider"></div>
    <h5 class="d-flex justify-content-center">Baja de Usuario</h2>
    <div class="d-flex gap-2 justify-content-center">
        <form method="post">
            <input type="number" name="Id" placeholder="ID del usuario a eliminar" required>
            <input type="submit" class="btn btn-danger px-3" name="baja" value="Baja">
        </form>
    </div>
<div class="b-example-divider"></div>
    <h5 class="d-flex justify-content-center">Modificación de Usuario</h2>
    <div class="d-flex gap-2 justify-content-center">
        <form method="post">
            <input type="number"  name="Id" placeholder="ID del usuario a modificar" required>
            <input type="text"  name="Name" placeholder="Nombre" required>
            <input type="text"  name="Surname" placeholder="Apellido" required>
            <input type="text"  name="Phonenumber" placeholder="Número de teléfono" required>
            <input type="text"  name="Company" placeholder="Empresa" required>
            <input type="text"  name="Address" placeholder="Dirección" required>
            <input type="submit"  class="btn btn-warning px-3" name="modificacion" value="Modificar">
        </form>
    </div>
</div>
<div class="b-example-divider"></div>
<div class="d-flex gap-2 justify-content-center ">
    <table class="table table-striped table-sm"  border="1">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Dirección</th>
        </tr>
        <?php
        if (isset($usuario_id) && !empty($usuario_id)) {
            $sql = "SELECT p.id AS alta_id, p.nombre, p.apellido, p.telefono, p.direccion, u.id AS usuario_id 
            FROM personas AS p
            INNER JOIN
            usuarios AS u ON p.usuario_id = u.id;";

            $resultado = mysqli_query($conexion, $sql);
        
            if (is_null($resultado)) {
                mostrarError("Error al ejecutar la consulta SQL: " . mysqli_error($conexion));
            } else if ($resultado->num_rows > 0) {
                echo "<th scope='col'>ID del contacto</th>";
                echo "</tr>";
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["alta_id"] . "</td>";
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["apellido"] . "</td>";
                    echo "<td>" . $fila["telefono"] . "</td>";
                    echo "<td>" . $fila["direccion"] . "</td>";
                    echo "<td>" . $fila["usuario_id"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "<div class='container-sm position-relative py-2 px-2'>";
                echo "<h2>Registros de Personas Asociados al Usuario</h2>";
                echo "<table>";
                echo "<tr><td colspan='5'>No se encontraron registros.</td></tr>";
                echo "</table>";
                echo "</div>";
            }
        } else {
            mostrarError("ID de usuario no válido o no definido.");
        }
        ?>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</main>
</body>
</html>
