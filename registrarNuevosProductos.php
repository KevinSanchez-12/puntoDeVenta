<?php
    include 'bd.php';
    $nuevosProductos = $_POST['nuevosProductos'];
    foreach ($nuevosProductos as $nuevoProducto) {
        $codigo = $nuevoProducto['codigo'];
        $nombre = $nuevoProducto['nombre'];
        $precio = $nuevoProducto['precio'];
        $sql = "INSERT INTO productos (codigo, nombre, precio) VALUES ('$codigo', '$nombre', '$precio')";
        $resultado = mysqli_query($conexion, $sql);
    }
?>