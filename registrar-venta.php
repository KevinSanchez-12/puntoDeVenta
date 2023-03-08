<!DOCTYPE html>
<html lang="es">
<?php
    include_once 'components/head.php';
    include 'bd.php';
    $cajeros = "SELECT * FROM cajeros";
    $mozos = "SELECT * FROM mozos";
    $sedes = "SELECT * FROM sedes";
    $productos = "SELECT * FROM productos";
    $resultado = mysqli_query($conexion, $productos);
    while ($row = mysqli_fetch_object($resultado)) {
        $arreglo[] = $row;
    }
    if(isset($arreglo)){
        $json = json_encode($arreglo);
    }
    $codigos = "SELECT * FROM codigosdescuento";
    $resultadob = mysqli_query($conexion, $codigos);
    while ($row = mysqli_fetch_object($resultadob)) {
        $arreglob[] = $row;
    }
    $jsonb = json_encode($arreglob);
    $ventas = "SELECT COUNT(*) FROM ventas";
    $resultadoc = mysqli_query($conexion, $ventas);
    $row = mysqli_fetch_array($resultadoc);
    $nComprobante = $row[0]+1;
?>
<body>
<?php include_once 'components/menu.php';?>
<section class="max-container">
    <h1>Registrar Venta</h1>
    <form autocomplete="off">
        <div class="controles">
            <div class="input-group">
                <span class="input-group-text">DNI</span>
                <input id="dni" onkeypress="return soloNumeros(event), validarCampos()" type="text" class="form-control" placeholder="Escriba aquí">
                <button style="align-items:center" class="btn btn btn-success" type="button" id="buscar">Buscar</button>
            </div>
            <div class="input-group">
                <span class="input-group-text">Nombres</span>
                <input id="nombres" onkeypress="return soloLetras(event)" type="text" class="form-control" placeholder="Escriba aquí">
            </div>
            <div class="input-group">
                <span class="input-group-text">Apellidos</span>
                <input id="apellidos" onkeypress="return soloLetras(event)" type="text" class="form-control" placeholder="Escriba aquí">
            </div>
            <div class="input-group">
                <span class="input-group-text">Correo</span>
                <input id="correo" type="text" class="form-control" placeholder="Escriba aquí">
            </div>
            <div class="input-group">
                <span class="input-group-text">Celular</span>
                <input id="celular" onkeypress="return soloNumeros(event)" type="text" class="form-control" placeholder="Escriba aquí">
            </div>
            <div class="input-group">
                <span class="input-group-text">N° de comprobante</span>
                <input disabled value="<?php echo $nComprobante?>" id="nComprobante" onkeypress="return soloNumeros(event)" type="text" class="form-control" placeholder="Escriba aquí">
            </div>
            <div class="input-group">
                <span class="input-group-text">Fecha de emisión</span>
                <input onchange="validarCampos()" id="fechaEmision" type="date" class="form-control" placeholder="Escriba aquí">
            </div>
            <div class="input-group">
                <span class="input-group-text">Hora de emisión</span>
                <input onchange="validarCampos()" id="horaEmision" type="time" class="form-control" placeholder="Escriba aquí">
            </div>
            <div class="input-group">
                <span class="input-group-text">Cajero(a)</span>
                <select onchange="validarCampos()" id="vendedor" class="form-control">
                    <option selected disabled value="">Seleccione</option>
                <?php $resultado= mysqli_query($conexion, $cajeros);
                    while($row=mysqli_fetch_assoc($resultado)){ ?>
                    <option value="<?php echo $row["nombre"];?>"><?php echo $row["nombre"];?></option>
                <?php }?>
                </select>
            </div>
            <div class="input-group">
                <span class="input-group-text">Mozo(a)</span>
                <select onchange="validarCampos()" id="mozo" class="form-control">
                    <option selected disabled value="">Seleccione</option>
                <?php $resultado= mysqli_query($conexion, $mozos);
                    while($row=mysqli_fetch_assoc($resultado)){ ?>
                    <option value="<?php echo $row["nombre"];?>"><?php echo $row["nombre"];?></option>
                <?php }?>
                </select>
            </div>
            <div class="input-group">
                <span class="input-group-text">Sede</span>
                <select onchange="validarCampos()" id="sede" class="form-control">
                    <option selected disabled value="">Seleccione</option>
                <?php $resultado= mysqli_query($conexion, $sedes);
                    while($row=mysqli_fetch_assoc($resultado)){ ?>
                    <option value="<?php echo $row["nombre"];?>"><?php echo $row["nombre"];?></option>
                <?php }?>
                </select>
            </div>
        </div>
        <hr>
        <div class="box-table">
            <table class="table" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody id="productos">
                </tbody>
            </table>
        </div>
        <button onclick="agregarProducto()" type="button" class="btn btn-success">Agregar producto</button>
        <hr>
        <div class="detalles-comprobante">
            <div class="input-group">
                <span class="input-group-text">Bolsas</span>
                <input disabled id="bolsas" type="text" class="form-control">
                <button onclick="aumentarBolsa()" class="btn btn-success" type="button">+</button>
                <button onclick="disminuirBolsa()" class="btn btn-danger" type="button">-</button>
            </div>
            <div class="input-group">
                <span class="input-group-text">Tipo de comprobante</span>
                <select onchange="validarComprobante(), validarCampos()" class="form-control" id="tipoComprobante">
                    <option disabled selected value="">Seleccione</option>
                    <option value="Boleta">Boleta</option>
                    <option value="Factura">Factura</option>
                </select>
            </div>
            <div class="input-group ruc">
                <span class="input-group-text">RUC</span>
                <input id="ruc" onkeypress="return soloNumeros(event);" type="text" class="form-control" placeholder="Escriba aquí">
                <button style="align-items:center" class="btn btn btn-success" type="button" id="buscarRUC">Buscar</button>
            </div>
            <div class="input-group ruc">
                <span class="input-group-text">Razón social</span>
                <input id="razonSocial" type="text" class="form-control" placeholder="Escriba aquí">
            </div>
            <div class="input-group ruc">
                <span class="input-group-text">Dirección fiscal</span>
                <input id="direccionFiscal" type="text" class="form-control" placeholder="Escriba aquí">
            </div>
            <div class="input-group">
                <span class="input-group-text">Medio de pago</span>
                <select onchange="validarMedioPago(), validarCampos()" class="form-control" id="medioPago">
                    <option disabled selected value="">Seleccione</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                </select>
            </div>
            <div style="display:none" class="input-group efectivo">
                <span class="input-group-text">Pago con</span>
                <input onkeyup="return calcularVuelto()" id="pagocon" value="S/0.00" type="text" class="form-control">
            </div>
            <div style="display:none" class="input-group efectivo">
                <span class="input-group-text">Vuelto</span>
                <input disabled id="vuelto" value="S/0.00" type="text" class="form-control">
            </div>
            <div class="input-group">
                <span class="input-group-text">Subtotal</span>
                <input disabled id="subtotal" type="text" class="form-control" value="S/0.00">
            </div>
            <div class="input-group">
                <span class="input-group-text">Código de descuento</span>
                <input id="codigo" type="text" class="form-control" placeholder="Escriba aquí">
                <button onclick="validarCodigoDescuento()" style="align-items:center" class="btn btn btn-success" type="button">Validar</button>
            </div>
            <div class="input-group">
                <span class="input-group-text">I.G.V</span>
                <input disabled id="igv" type="text" class="form-control" value="S/0.00">
            </div>
            <div class="input-group">
                <span class="input-group-text">Total a pagar</span>
                <input disabled id="total" type="text" class="form-control" value="S/0.00">
            </div>
        </div>
        <br>
        <button disabled onclick="registrarVenta()" id="boton" type="button" class="btn btn-success btn-opcion">Registrar venta</button>
    </form>
</section>
    <script>
        $("#buscar").click(function(){
        var dni=$("#dni").val();
        $.ajax({           
        type:"POST",
        url: "consulta-dni.php",
        data: 'dni='+dni,
        dataType: 'json',
        success: function(data) {
            if(data.error != null){
                alertify.error("DNI no encontrado");
            }
            else{
                $("#nombres").val(data.nombres.toLowerCase().replace(/\b[a-z]/g, c => c.toUpperCase()));
                $("#apellidos").val(data.apellidoPaterno.toLowerCase().replace(/\b[a-z]/g, c => c.toUpperCase()) + " " + data.apellidoMaterno.toLowerCase().replace(/\b[a-z]/g, c => c.toUpperCase()));
            }
        }, error: function(data) {
        }
        });
        })
        $("#buscarRUC").click(function(){
        var ruc=$("#ruc").val();
        $.ajax({           
        type:"POST",
        url: "consulta-RUC.php",
        data: 'ruc='+ruc,
        dataType: 'json',
        success: function(data) {
            if(data.error != null){
                alertify.error("RUC no encontrado");
            }
            else{
                $("#razonSocial").val(data.nombre.toLowerCase().replace(/\b[a-z]/g, c => c.toUpperCase()));
                $("#direccionFiscal").val(data.direccion.toLowerCase().replace(/\b[a-z]/g, c => c.toUpperCase()) + " - " + data.distrito.toLowerCase().replace(/\b[a-z]/g, c => c.toUpperCase()));
            }
        }, error: function(data) {
        }
        });
        })
    </script>
    <script>
        var productosLista = '<?php echo $json;?>';
        var codigosLista = '<?php echo $jsonb;?>';
    </script>
    <script src="assets/js/script.js?1.8"></script>
</body>
</html>