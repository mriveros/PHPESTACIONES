<?php
session_start();
if(!isset($_SESSION['codigo_usuario']))
header("Location:http://localhost/app/PHPESTACIONES/login/acceso.html");
$catego=  $_SESSION["categoria_usuario"];
$codusuario=  $_SESSION["codigo_usuario"];

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ONM- Estaciones</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
	<!-- DataTables CSS -->
    <link href="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
	
    <!-- DataTables JavaScript -->
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
	    
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
			responsive: true
        });
    });
    </script>
	<script type="text/javascript">
		function modificar(codinstrumento){
			$('tr').click(function() {
			indi = $(this).index();
                        //var codusuario=document.getElementById("dataTables-example").rows[indi+1].cells[0].innerText;
			var nombre=document.getElementById("dataTables-example").rows[indi+1].cells[1].innerText;
			var descripcion=document.getElementById("dataTables-example").rows[indi+1].cells[2].innerText;
                        var laboratorio=document.getElementById("dataTables-example").rows[indi+1].cells[2].innerText;
			//var estado=document.getElementById("dataTables-example").rows[indi+1].cells[5].innerText;
                        document.getElementById("txtCodigo").value = codinstrumento;
                        document.getElementById("txtNombre").value = nombre;
			document.getElementById("txtDescripcion").value = descripcion;
                        document.getElementById("txtLaboratorio").value = laboratorio;
			});
		};
		function eliminar(codinstrumento){
			document.getElementById("txtCodigoE").value = codinstrumento;
		};
	</script>
</head>

<body>

    <div id="wrapper">

        <?php 
        include("../funciones.php");
        if ($catego==1){
             include("../menu.php");
        }elseif($catego==2){
             include("../menu_usuario.php");
        }elseif($catego==3){
             include("../menu_supervisor.php");
        }
        conexionlocal();
        ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                      <h1 class="page-header">Estaciones - <small>ONM ESTACIONES</small></h1>
                </div>	
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Listado de Registro de Estaciones
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    
                                    <thead>
                                        
                                        <tr class="success">
                                            <th>Codigo</th>
                                            <th>Cliente</th>
                                            <th>Direccion</th>
                                            <th>Ciudad</th>
                                            <th>Departamento</th>
                                            <th>Distribuidor</th>
                                            <th>Cantidad</th>
                                            <th>Aprob.</th>
                                            <th>Reprob.</th>
                                            <th>Claus.</th>
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                    <?php
                     if ($catego==1){
                         $query = "select  reg.reg_cod,cli.cli_nom||' '||cli.cli_ape as cliente,cli.cli_dir,cli.cli_ciu,cli.cli_dpto,dis.dis_nom,reg.reg_cant,
                            reg.reg_aprob,reg.reg_reprob,reg.reg_claus,to_char(reg.reg_fecha,'DD/MM/YYYY') as fecha,
                            usu.usu_nom ||' '||usu.usu_ape as usuario
                            from registros reg, clientes cli, distribuidor dis,usuarios usu
                            where reg.cli_cod=cli.cli_cod
                            and usu.usu_cod=reg.usu_cod
                            and reg.dis_cod=dis.dis_cod";
                    }else{
                            $query = "select  reg.reg_cod,cli.cli_nom||' '||cli.cli_ape as cliente,cli.cli_dir,cli.cli_ciu,cli.cli_dpto,dis.dis_nom,reg.reg_cant,
                            reg.reg_aprob,reg.reg_reprob,reg.reg_claus,to_char(reg.reg_fecha,'DD/MM/YYYY') as fecha,
                            usu.usu_nom ||' '||usu.usu_ape as usuario
                            from registros reg, clientes cli, distribuidor dis,usuarios usu
                            where reg.cli_cod=cli.cli_cod
                            and usu.usu_cod=reg.usu_cod
                            and reg.dis_cod=dis.dis_cod and reg.usu_cod=$codusuario";

                    }
                    $result = pg_query($query) or die ("Error al realizar la consulta");
                    while($row1 = pg_fetch_array($result))
                    {
                        echo "<tr><td>".$row1["reg_cod"]."</td>";
                        echo "<td>".$row1["cliente"]."</td>";
                        echo "<td>".$row1["cli_dir"]."</td>";
                        echo "<td>".$row1["cli_ciu"]."</td>";
                        echo "<td>".$row1["cli_dpto"]."</td>";
                        echo "<td>".$row1["dis_nom"]."</td>";
                        echo "<td>".$row1["reg_cant"]."</td>";
                        echo "<td>".$row1["reg_aprob"]."</td>";
                        echo "<td>".$row1["reg_reprob"]."</td>";
                        echo "<td>".$row1["reg_claus"]."</td>";
                        echo "<td>".$row1["usuario"]."</td>";
                        echo "<td>".$row1["fecha"]."</td>";
                        echo "<td>";?>
                        <a onclick='eliminar(<?php echo $row1["reg_cod"];?>)' class="btn btn-danger btn-xs active" data-toggle="modal" data-target="#modalbor" role="button">Borrar</a>
                        <?php
                        echo "</td></tr>";
                    }
                    pg_free_result($result);
                    ?>
                                    </tbody>
                                </table>
                            </div>		
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <a  class="btn btn-primary" data-toggle="modal" data-target="#modalagr" role="button">Nuevo</a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<!-- /#MODAL AGREGACIONES -->
	<div class="modal fade" id="modalagr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-floppy-disk"></i> Agregar Registro</h3>
				</div>
            
				<!-- Modal Body -->
				<div class="modal-body">
                                    <form  autocomplete="off" class="form-horizontal" name="agregarform" action="../class/ClsRegistros.php" method="post" role="form">
						
                                       
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Cliente</label>
                                            <div class="col-sm-10">
                                           <select name="txtClienteA" class="form-control" id="txtClienteA" required>
                                                <?php
                                                //esto es para mostrar un select que trae datos de la BDD
                                                conexionlocal();
                                                $query = "Select cli_cod,cli_nom||' '||cli_ape  from clientes where estado='t' ";
                                                $resultadoSelect = pg_query($query);
                                                while ($row = pg_fetch_row($resultadoSelect)) {
                                                echo "<option value=".$row[0].">";
                                                echo $row[1];
                                                echo "</option>";
                                                }
                                                ?>
                                             </select>
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Distribuidor</label>
                                            <div class="col-sm-10">
                                           <select name="txtDistribuidorA" class="form-control" id="txtDistribuidorA" required>
                                                <?php
                                                //esto es para mostrar un select que trae datos de la BDD
                                                conexionlocal();
                                                $query = "Select dis_cod,dis_nom  from distribuidor where estado='t' ";
                                                $resultadoSelect = pg_query($query);
                                                while ($row = pg_fetch_row($resultadoSelect)) {
                                                echo "<option value=".$row[0].">";
                                                echo $row[1];
                                                echo "</option>";
                                                }
                                                ?>
                                             </select>
                                            </div>
					</div>
                                         <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Cantidad</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtCantidadA" class="form-control" id="txtCantidadA" required />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Aprobados</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtAprobadoA" class="form-control" id="txtAprobadoA"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Reprobados</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtReprobadoA" class="form-control" id="txtReprobadoA"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Clausurados</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtClausuradoA" class="form-control" id="txtClausuradoA"  />
                                            </div>
					</div>	
				</div>
				
				<!-- Modal Footer -->
				<div class="modal-footer">
					<button type="reset" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="agregar" class="btn btn-primary">Guardar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- /#MODAL MODIFICACIONES -->
	<div class="modal fade" id="modalmod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-pencil"></i> Modificar Registro</h3>
				</div>
				<!-- Modal Body -->
				<div class="modal-body">
                                    <form  autocomplete="off" class="form-horizontal" name="modificarform" action="../class/ClsRegistros.php"  method="post" role="form">
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                            <input type="hidden" name="txtCodigo" class="form-control" id="txtCodigo"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Nombre Instrumento</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtNombre" class="form-control" id="txtNombre" placeholder="ingrese nombre de instrumento" required />
                                            </div>
					</div>
					<div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Descripcion</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtDescripcion" class="form-control" id="txtDescripcion" placeholder="ingrese una descripcion" required />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Laboratorio</label>
                                            <div class="col-sm-10">
                                           <select name="txtLaboratorio" class="form-control" id="txtLaboratorio" required>
                                                <?php
                                                //esto es para mostrar un select que trae datos de la BDD
                                                conexionlocal();
                                                $query = "Select lab_cod,lab_nom from laboratorios where estado='t' ";
                                                $resultadoSelect = pg_query($query);
                                                while ($row = pg_fetch_row($resultadoSelect)) {
                                                echo "<option value=".$row[0].">";
                                                echo $row[1];
                                                echo "</option>";
                                                }
                                                ?>
                                             </select>
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input03">Estado</label>
                                            <div class="col-sm-10">
                                            <div class="radio">
                                            <label><input type="radio" name="txtEstado" value="1" checked /> Activo</label>
                                            <label><input type="radio" name="txtEstado" value="0" /> Inactivo</label>
                                            </div>
                                            </div>
					</div>		
				</div>
				
				<!-- Modal Footer -->
				<div class="modal-footer">
					<button type="reset" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="modificar" class="btn btn-primary">Guardar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- /#MODAL ELIMINACIONES -->
	<div class="modal fade" id="modalbor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-trash"></i> Borrar Registro</h3>
				</div>
            
				<!-- Modal Body -->
				<div class="modal-body">
                                    <form class="form-horizontal" name="borrarform" action="../class/ClsRegistros.php" onsubmit="return submitForm();" method="post" role="form">
						<div class="form-group">
							<input type="numeric" name="txtCodigoE" class="hide" id="txtCodigoE" />
							<div class="alert alert-danger alert-dismissable col-sm-10 col-sm-offset-1">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								¡¡¡ATENCION!!! ...Se borrara el siguiente registro..
							</div>
						</div>
				</div>
				
				<!-- Modal Footer -->
				<div class="modal-footer">
					<button type="" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="borrar" class="btn btn-danger">Borrar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
    
</html>