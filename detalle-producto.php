<?php
    include 'bd.php';
    $id = $_POST['id'];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_assoc($resultado);
    $codigo = $row['codigo'];
    $nombre = $row['nombre'];
    $precio = $row['precio'];
    $datos = [
        'id' => $id,
        'codigo' => $codigo,
        'nombre' => $nombre,
        'precio' => $precio,
    ];
    echo json_encode($datos);
?>