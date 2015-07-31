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
    if  (empty($_POST['txtDescripcionA'])){$descripcionA='';}else{ $descripcionA= $_POST['txtDescripcionA'];}
    if  (empty($_POST['txtEstadoA'])){$estadoA='f';}else{ $estadoA= 't';}
    
    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtNombre'])){$nombreM='';}else{ $nombreM = $_POST['txtNombre'];}
    if  (empty($_POST['txtDescripcion'])){$descripcionM='';}else{ $descripcionM= $_POST['txtDescripcion'];}
    if  (empty($_POST['txtEstado'])){$estadoM='f';}else{ $estadoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($nombreA, 'distribuidor', 'dis_nom')==true){
                echo '<script type="text/javascript">
		alert("El Distribuidor ya existe. Intente ingresar otro Distribuidor");
                window.location="http://localhost/app/phpestaciones/web/distribuidores/ABMdistribuidor.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO distribuidor(dis_nom,dis_obs,fecha,estado) "
                        . "VALUES ('$nombreA','$descripcionA',now(),'$estadoA');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga');
                $query = '';
                header("Refresh:0; url=http://localhost/app/phpestaciones/web/distribuidores/ABMdistribuidor.php");
                }
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
            
            pg_query("update distribuidor set dis_nom='$nombreM',dis_obs= '$descripcionM',estado='$estadoM' WHERE dis_cod=$codigoModif");
            $query = '';
            header("Refresh:0; url=http://localhost/app/phpestaciones/web/distribuidores/ABMdistribuidor.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update distribuidor set estado='f' WHERE dis_cod=$codigoElim");
            header("Refresh:0; url=http://localhost/app/phpestaciones/web/distribuidores/ABMdistribuidor.php");
	}
