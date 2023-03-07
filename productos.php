<!DOCTYPE html>
<html lang="es">
<?php 
    include_once 'components/head.php';
    include 'bd.php';
    $iniciar = ($_GET['pagina']-1)*10;
    $productos = 'SELECT * FROM productos LIMIT '.$iniciar.',10';
    $totalproductos = 'SELECT * FROM productos';
    if(!$_GET){
        header('Location: productos?pagina=1');
    }
?>
<body>
<?php include_once 'components/menu.php';?>
<section class="max-container">
    <h1>Mis productos</h1>
    <form>
        <br>
        <div class="box-table" id="box-table">
            <table class="table" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                    </tr>
                </thead>
                <tbody id="productos">
                    <?php
                        $resultado = mysqli_query($conexion, $productos);
                        $resultadob = mysqli_query($conexion, $totalproductos);
                        $articulosxpagina = 10;
                        $articulodb = mysqli_num_rows($resultadob);
                        $paginas = ceil($articulodb/$articulosxpagina);
                        while ($row = mysqli_fetch_array($resultado)) { ?>
                            <tr>
                                <td scope="row"><?php echo $row['id']?></td>
                                <td><?php echo $row['codigo']?></td>
                                <td><?php echo $row['nombre']?></td>
                                <td>S/<?php echo $row['precio']?></td>
                            </tr>
                        <?php }
                    ?>
                </tbody>
            </table>
            <nav id="navegador" style="display:none" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled' : ''?>"><a class="page-link" href="productos?pagina=<?php echo $_GET['pagina']-1?>">Anterior</a></li>
                    <?php
                        for ($i = 1; $i<=$paginas; $i++) { ?>
                            <li class="page-item <?php echo $_GET['pagina']==$i ? 'active' : '' ?>"><a class="page-link" href="productos?pagina=<?php echo $i?>"><?php echo $i?></a></li>
                        <?php }
                    ?>
                    <li class="page-item <?php echo $_GET['pagina']>=$paginas ? 'disabled' : ''?>"><a class="page-link" href="productos?pagina=<?php echo $_GET['pagina']+1?>">Siguiente</a></li>
                </ul>
            </nav>
        </div>
        <div style="margin-bottom:-3px" id="mensaje" class="alert alert-danger" role="alert">
            No tiene productos
        </div>
        <?php if (mysqli_num_rows($resultado) == 0) {
            echo '<script>document.getElementById("mensaje").style.display = "block";</script>';
            echo '<script>document.getElementById("navegador").style.display = "none";</script>';
        } else {
            echo '<script>document.getElementById("mensaje").style.display = "none";</script>';
            echo '<script>document.getElementById("navegador").style.display = "block";</script>';
        } ?>
    </form>
</section>
    <script src="assets/js/script.js"></script>
</body>
</html>