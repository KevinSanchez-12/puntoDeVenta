<!DOCTYPE html>
<html lang="es">
<?php 
    include_once 'components/head.php';
    include 'bd.php';
?>
<body>
<?php include_once 'components/menu.php';?>
<section class="max-container">
    <h1>Agregar Nuevos Códigos de Descuento</h1>
    <form>
        <br>
        <div class="box-table" id="box-table" style="">
            <table class="table" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Código</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Validar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody id="productos">
                </tbody>
            </table>
        </div>
        <button onclick="agregarNuevoCodigo()" type="button" class="btn btn-success">Agregar codigo</button>
        <button disabled id="guardarCodigos" style="margin-top:20px" onclick="registrarNuevosCodigos()" type="button" class="btn btn-success btn-opcion">Registrar codigos</button>
    </form>
</section>
    <script src="assets/js/script.js"></script>
</body>
</html>