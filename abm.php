<?php
include_once 'conexiondb.php';

session_start();

if (isset($_POST['alta'])) {
    $name = $_POST['Name'];
    $surname = $_POST['Surname'];
    $phonenumber = $_POST['Phonenumber'];
    $address = $_POST['Address'];
    $usuario_id = obtenerIdDeUsuario();
    $sql = "INSERT INTO personas (nombre, apellido, telefono, direccion, usuario_id)
    SELECT nombre, apellido, telefono, direccion, usuario_id FROM ( SELECT '$name' AS nombre, '$surname' AS apellido, '$phonenumber' AS telefono, '$address' AS direccion, '$usuario_id' AS usuario_id
        ) AS subconsulta;
    ";

    if ($conexion->query($sql) === TRUE) {
        $last_inserted_id = $conexion->insert_id;
        mostrarExito("Nuevo registro creado con éxito. ID: $last_inserted_id");
    } else {
        mostrarError("Error al crear el registro: " . $conexion->error);
    }
}
if (isset($_POST['baja'])) {
    $id = $_POST['Id'];
    $sql_persona = "DELETE FROM personas WHERE id = $id";

    if ($conexion->query($sql_persona) === TRUE) {
        mostrarExito("Registro eliminado con éxito.");
    } else {
        mostrarError("Error al eliminar el registro: " . $conexion->error);
    }
}

if (isset($_POST['modificacion'])) {
    $id = $_POST['Id'];
    $name = $_POST['Name'];
    $surname = $_POST['Surname'];
    $phonenumber = $_POST['Phonenumber'];
    $address = $_POST['Address'];
    $sql_persona = "UPDATE personas
                    SET nombre = '$name', apellido = '$surname', telefono = '$phonenumber', direccion = '$address'
                    WHERE id = $id";

    if ($conexion->query($sql_persona) === TRUE) {
        mostrarExito("<script type='text/javascript'>
        alert('Se hizo el registro de la persona en la tabla Personas');
      </script>");
    } else {
        mostrarError("Error al modificar el registro: " . $conexion->error);
    }
}
function mostrarExito($mensaje) {
    echo "<div>$mensaje</div>";
}
function mostrarError($mensaje) {
    echo "<div>$mensaje</div>";
}
function obtenerIdDeUsuario() {
    if (isset($_SESSION['id'])) {
        return $_SESSION['id'];
    } else {
        mostrarError("ID de usuario no válido o no definido.");
    }
}
?>
