<!DOCTYPE html>
<!--
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Precintos INTN
 */
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        
            <?php
            //recupera los datos del form cabecera y detalle
            //CABECERA DE TABLA PRECINTADO
          if  (empty($_POST['txtNota'])){$nota=0;}else{$nota=$_POST['txtNota'];}
          if  (empty($_POST['txtCodLugar'])){$codlugar=0;}else{$codlugar=$_POST['txtCodLugar'];}
          if  (empty($_POST['txtCodEmblema'])){$codemblema=0;}else{ $codemblema = $_POST['txtCodEmblema'];}
          if  (empty($_POST['txtCodPrecintador'])){$codprecintador=0;}else{ $codprecintador= $_POST['txtCodPrecintador'];}
          if  (empty($_POST['txtCodEncargado'])){$codencargado=0;}else{ $codencargado= $_POST['txtCodEncargado'];}
          if  (empty($_POST['txtNombreTransportista'])){$transportista=0;}else{ $transportista= $_POST['txtNombreTransportista'];}
          if  (empty($_POST['txtCodCamion'])){$codcamion=0;}else{ $codcamion= $_POST['txtCodCamion'];}
          if  (empty($_POST['txtGasoil'])){$gasoil=0;}else{ $gasoil= $_POST['txtGasoil'];}
          if  (empty($_POST['txtAlconafta'])){$alconafta=0;}else{ $alconafta= $_POST['txtAlconafta'];}
          if  (empty($_POST['txtNafta85'])){$nafta85=0;}else{ $nafta85= $_POST['txtNafta85'];}
          if  (empty($_POST['txtNafta90'])){$nafta90=0;}else{ $nafta90= $_POST['txtNafta90'];}
          if  (empty($_POST['txtNafta95'])){$nafta95=0;}else{ $nafta95= $_POST['txtNafta95'];}
          if  (empty($_POST['txtKerosene'])){$kerosene=0;}else{ $kerosene= $_POST['txtKerosene'];}
          if  (empty($_POST['txtTurbo'])){$turbo=0;}else{ $turbo= $_POST['txtTurbo'];}
          if  (empty($_POST['txtaAvigas'])){$avigas=0;}else{ $avigas= $_POST['txtaAvigas'];}
          if  (empty($_POST['txtFueloil'])){$fueloil=0;}else{ $fueloil= $_POST['txtFueloil'];}
          if  (empty($_POST['txtAlcohol'])){$alcohol=0;}else{ $alcohol= $_POST['txtAlcohol'];}
          if  (empty($_POST['txtCantidad'])){$cantPrecinto=0;}else{ $cantPrecinto= $_POST['txtCantidad'];}
          if  (empty($_POST['txtCodUsuario'])){$codusuario=0;}else{ $codusuario= $_POST['txtCodUsuario'];}
           //DETALLE DE CABECERA
          //ESTOS DATOS SE GUARDAN EN LA TABLA PRECINTADO_DETALLE
          if  (empty($_POST['nick'])){$precinto1=0;}else{ $precinto1= $_POST['nick'];}
          if  (empty($_POST['nick1'])){$precinto2=0;}else{ $precinto2= $_POST['nick1'];}
          if  (empty($_POST['nick2'])){$precinto3=0;}else{ $precinto3= $_POST['nick2'];}
          if  (empty($_POST['nick3'])){$precinto4=0;}else{ $precinto4= $_POST['nick3'];}
          if  (empty($_POST['nick4'])){$precinto5=0;}else{ $precinto5= $_POST['nick4'];}
          if  (empty($_POST['nick5'])){$precinto6=0;}else{ $precinto6= $_POST['nick5'];}
          if  (empty($_POST['nick6'])){$precinto7=0;}else{ $precinto7= $_POST['nick6'];}
          if  (empty($_POST['nick7'])){$precinto8=0;}else{ $precinto8= $_POST['nick7'];}
          if  (empty($_POST['nick8'])){$precinto9=0;}else{ $precinto9= $_POST['nick8'];}
          if  (empty($_POST['nick9'])){$precinto10=0;}else{ $precinto10= $_POST['nick9'];}
          if  (empty($_POST['nick10'])){$precinto11=0;}else{ $precinto11= $_POST['nick10'];}
          if  (empty($_POST['nick11'])){$precinto12=0;}else{ $precinto12= $_POST['nick11'];}
          if  (empty($_POST['nick12'])){$precinto13=0;}else{ $precinto13= $_POST['nick12'];}
          if  (empty($_POST['nick13'])){$precinto14=0;}else{ $precinto14= $_POST['nick13'];}
          if  (empty($_POST['nick14'])){$precinto15=0;}else{ $precinto15= $_POST['nick14'];}
          if  (empty($_POST['nick15'])){$precinto16=0;}else{ $precinto16= $_POST['nick15'];}
          if  (empty($_POST['nick16'])){$precinto17=0;}else{ $precinto17= $_POST['nick16'];}
          if  (empty($_POST['nick17'])){$precinto18=0;}else{ $precinto18= $_POST['nick17'];}
          if  (empty($_POST['nick18'])){$precinto19=0;}else{ $precinto19= $_POST['nick18'];}
          if  (empty($_POST['nick19'])){$precinto20=0;}else{ $precinto20= $_POST['nick19'];}
          if  (empty($_POST['nick20'])){$precinto21=0;}else{ $precinto21= $_POST['nick20'];}
          //en esta clase se guardan la cabecera y detalle de precintados
          
           $database = 'PRECINTOS';
            include '../funciones.php';
            conexionlocal();
            $var= $_GET['nuevo'];
            //OBTENEMOS EL PRECIO CON RESPECTO A LA CANTIDAD DE PRECINTO
            $precio = func_ObtenerPrecio($cantPrecinto);
           if ($var==1){
                // REGISTRAMOS LA CABECERA DE PRECINTADO
               $query = "INSERT INTO precintado(prec_nrorem,pues_cod,em_cod,cam_cod,
                prec_gasoil,prec_alconafta,prec_nafta85,prec_nafta90,prec_nafta95,prec_kerosene,
                prec_turbo,prec_avigas,prec_fueloil,prec_alcohol,prec_cantPrecinto,prec_precio,precint_cod,
                enc_cod,prec_transportista,prec_fecha,cod_usuario,pre_estado) 
                VALUES ('$nota',$codlugar,$codemblema,$codcamion,$gasoil,$alconafta,$nafta85,$nafta90,
                $nafta95,$kerosene,$turbo,$avigas,$fueloil,$alcohol,$cantPrecinto,$precio,$codprecintador,
                $codencargado,'$transportista',now(),$codusuario,'t');";
               $ejecucion = pg_query($query)or die('<script type="text/javascript">alert("Error al guardar datos..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //OBTENER EL ULTIMO CODIGO Y CARGAR EL DETALLE
               $query = "select max(prec_cod) as prec_cod from precintado;";
               $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el ultimo codigo!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codigoPrecintado=$row[0];
                //CARGAMOS EL DETALLE
                if ($precinto1<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto1 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto1,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto2<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto2 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto2,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto3<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto3 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto3,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto4<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto4 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto4,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto5<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto5 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto5,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto6<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto6 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto6,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto7<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto7 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto7,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto8<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto8 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto8,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto9<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto9 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto9,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                
                if ($precinto10<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto10 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nr,prec_activoo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto10,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto11<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto11 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto11,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto12<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto12 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto12,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto13<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto13 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto13,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto14<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto14 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto14,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto15<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto15 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto15,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto16<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto16 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto16,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto17<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto17 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto17,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto18<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto18 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto18,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto19<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto19 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto19,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto20<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto20 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto20,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                if ($precinto21<>"0")
                {
                //OBTENEMOS EL CODIGO DE PRECINTO    
                $query = "select pre_cod from precinto where pre_nro=$precinto21 and pre_activo='t'";
                $result = pg_query($query)or die('<script type="text/javascript">alert("Error al obtener el codigo de precinto!!..! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                $row=pg_fetch_row($result);
                $codprecinto=$row[0];
                //INSERTAMOS EL CODIGO DE PRECINTO EN LA TABLA DETALLE
                $query="insert into precintado_detalle(prec_cod,pre_cod,pre_nro,prec_activo) "
                        . "values($codigoPrecintado,$codprecinto,$precinto21,'t')";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al cargar detalle! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                //ANULAMOS EL CODIGO DE PRECINTO DE LA TABLA PRECINTO
                 $query="update precinto set pre_activo='f' where pre_cod=$codprecinto";
                 $result = pg_query($query)or die('<script type="text/javascript">alert("Error al desactivar el Precinto! :( ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                 
                }
                
                
                echo ('<script type="text/javascript">alert("Datos Cargados Exitosamente!! :) ");'
               . ' window.location="http://localhost/app/PhpPrecinto/precintado/index.php";'
               . '</script>');
                header("Refresh:0; url=http://localhost/app/PhpPrecinto/precintado/index.php");
               
         }
        
        ?>
    </body>
</html>
