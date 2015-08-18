<?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Control ONM-INTN
 */
session_start();
$codusuario=  $_SESSION["codigo_usuario"];

    include '../funciones.php';
    conexionlocal();
    
    //Datos del Form Agregar
    if  (empty($_POST['txtNombreA'])){$nombreA='';}else{ $nombreA = $_POST['txtNombreA'];}
    if  (empty($_POST['txtApellidoA'])){$apellidoA='';}else{ $apellidoA= $_POST['txtApellidoA'];}
    if  (empty($_POST['txtRucA'])){$rucA='';}else{ $rucA= $_POST['txtRucA'];}
    if  (empty($_POST['txtMailA'])){$mailA='';}else{ $mailA= $_POST['txtMailA'];}
    if  (empty($_POST['txtNroA'])){$nroA='';}else{ $nroA= $_POST['txtNroA'];}
    if  (empty($_POST['txtDireccionA'])){$direccionA='';}else{ $direccionA= $_POST['txtDireccionA'];}
    if  (empty($_POST['txtCiudadA'])){$ciudadA='';}else{ $ciudadA= $_POST['txtCiudadA'];}
    if  (empty($_POST['txtDepartamentoA'])){$departamentoA=0;}else{ $departamentoA= $_POST['txtDepartamentoA'];}
    if  (empty($_POST['txtEstadoA'])){$estadoA='f';}else{ $estadoA= 't';}
    
    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtNombre'])){$nombreM='';}else{ $nombreM = $_POST['txtNombre'];}
    if  (empty($_POST['txtApellido'])){$apellidoM='';}else{ $apellidoM= $_POST['txtApellido'];}
    if  (empty($_POST['txtRuc'])){$rucM='';}else{ $rucM= $_POST['txtRuc'];}
    if  (empty($_POST['txtMail'])){$mailM='';}else{ $mailM= $_POST['txtMail'];}
    if  (empty($_POST['txtNro'])){$nroM='';}else{ $nroM= $_POST['txtNro'];}
    if  (empty($_POST['txtDireccion'])){$direccionM='';}else{ $direccionM= $_POST['txtDireccion'];}
    if  (empty($_POST['txtCiudad'])){$ciudadM='';}else{ $ciudadM= $_POST['txtCiudad'];}
    if  (empty($_POST['txtDepartamento'])){$departamentoM='';}else{ $departamentoM= $_POST['txtDepartamento'];}
    if  (empty($_POST['txtOpcion'])){$estadoM='f';}else{ $estadoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($rucA, 'clientes', 'cli_ruc')==true){
                echo '<script type="text/javascript">
		alert("El Cliente ya existe. Intente ingresar otro Cliente");
                window.location="http://192.168.0.99/web/phpestaciones/web/clientes/ABMcliente.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO clientes(cli_nom,cli_ape,cli_ruc,cli_mail,cli_nro,fecha,estado,cli_dir,cli_ciu,cli_dpto) "
                        . "VALUES ('$nombreA','$apellidoA','$rucA','$mailA','$nroA',now(),'$estadoA','$direccionA','$ciudadA','$departamentoA');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga');
                $query = '';
                header("Refresh:0; url=http://192.168.0.99/web/phpestaciones/web/clientes/ABMcliente.php");
                }
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
            
            pg_query("update clientes set cli_nom='$nombreM',cli_ape= '$apellidoM',"
                    . "cli_ruc='$rucM',cli_mail='$mailM',cli_nro='$nroM',cli_dir='$direccionM',cli_ciu='$ciudadM'"
                    . ", cli_dpto='$departamentoM',estado='$estadoM' WHERE cli_cod=$codigoModif");
            $query = '';
            header("Refresh:0; url=http://192.168.0.99/web/phpestaciones/web/clientes/ABMcliente.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update clientes set estado='f' WHERE cli_cod=$codigoElim");
            header("Refresh:0; url=http://192.168.0.99/web/phpestaciones/web/clientes/ABMcliente.php");
	}
