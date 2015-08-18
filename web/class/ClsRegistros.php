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
    if  (empty($_POST['txtClienteA'])){$clienteA=0;}else{ $clienteA = $_POST['txtClienteA'];}
    if  (empty($_POST['txtDistribuidorA'])){$distribuidorA=0;}else{ $distribuidorA= $_POST['txtDistribuidorA'];}
    if  (empty($_POST['txtCantidadA'])){$cantidadA=0;}else{ $cantidadA= $_POST['txtCantidadA'];}
    if  (empty($_POST['txtAprobadoA'])){$aprobadoA=0;}else{ $aprobadoA= $_POST['txtAprobadoA'];}
    if  (empty($_POST['txtReprobadoA'])){$reprobadoA=0;}else{ $reprobadoA= $_POST['txtReprobadoA'];}
    if  (empty($_POST['txtClausuradoA'])){$clausuradoA=0;}else{ $clausuradoA= $_POST['txtClausuradoA'];}
    if  (empty($_POST['txtFechaA'])){$fechaA=0;}else{ $fechaA= $_POST['txtFechaA'];}
    
    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtNombre'])){$nombreM=0;}else{ $nombreM = $_POST['txtNombre'];}
    if  (empty($_POST['txtDescripcion'])){$descripcionM=0;}else{ $descripcionM= $_POST['txtDescripcion'];}
    if  (empty($_POST['txtLaboratorio'])){$laboratorioM=0;}else{ $laboratorioM= $_POST['txtLaboratorio'];}
    if  (empty($_POST['txtEstado'])){$estadoM='f';}else{ $estadoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
                      
                //se define el Query   
                $query = "INSERT INTO registros(cli_cod,dis_cod,reg_cant,reg_aprob,reg_reprob,reg_claus,reg_fecha,estado,usu_cod,reg_fechaop) "
                        . "VALUES ('$clienteA','$distribuidorA',$cantidadA,$aprobadoA,$reprobadoA,$clausuradoA,now(),'t',$codusuario,'$fechaA');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga');
                $query = '';
                header("Refresh:0; url=http://localhost/app/phpestaciones/web/estaciones/ABMregistro.php");
                
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
            
            pg_query("update instrumentos set ins_nom='$nombreM',ins_des= '$descripcionM',lab_cod=$laboratorioM,estado='$estadoM' WHERE ins_cod=$codigoModif");
            $query = '';
            header("Refresh:0; url=http://localhost/app/phpestaciones/web/estaciones/ABMregistro.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("delete from registros WHERE reg_cod=$codigoElim");
            header("Refresh:0; url=http://localhost/app/phpestaciones/web/estaciones/ABMregistro.php");
	}
