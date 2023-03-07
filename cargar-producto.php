<!DOCTYPE html>
<html lang="es">
<?php 
    include_once 'components/head.php';
    include 'bd.php';
?>
<body>
<?php include_once 'components/menu.php';?>
<section class="max-container">
    <h1>Agregar Nuevos Productos</h1>
    <form>
        <br>
        <div class="box-table" id="box-table" style="">
            <table class="table" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Validar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody id="productos">
                </tbody>
            </table>
        </div>
        <button onclick="agregarNuevoProducto()" type="button" class="btn btn-success">Agregar producto</button>
        <button disabled id="guardarProductos" style="margin-top:20px" onclick="registrarNuevosProductos()" type="button" class="btn btn-success btn-opcion">Registrar productos</button>
    </form>
</section>
    <script src="assets/js/script.js"></script>
</body>
</html>