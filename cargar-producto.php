<?php
    include 'bd.php';
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $sql = "INSERT INTO productos (codigo, nombre, precio) VALUES ('$codigo', '$nombre', '$precio')";
    $resultado = mysqli_query($conexion, $sql);
    $datos = [
        'success' => true,
        'message' => 'Producto agregado con éxito',
    ];
    echo json_encode($datos);
?>