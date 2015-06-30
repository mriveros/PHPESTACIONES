<?php
session_start();
if(!isset($_SESSION['codigo_usuario']))
header("Location:http://localhost/app/PHPESTACIONES/login/acceso.html");
$catego=  $_SESSION["categoria_usuario"];

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ONM-Clientes</title>
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
		function modificar(codcliente){
			$('tr').click(function() {
			indi = $(this).index();
                        //var codusuario=document.getElementById("dataTables-example").rows[indi+1].cells[0].innerText;
			var nombre=document.getElementById("dataTables-example").rows[indi+1].cells[1].innerText;
			var apellido=document.getElementById("dataTables-example").rows[indi+1].cells[2].innerText;
                        var ruc=document.getElementById("dataTables-example").rows[indi+1].cells[3].innerText;
                        var mail=document.getElementById("dataTables-example").rows[indi+1].cells[4].innerText;
                        var numero=document.getElementById("dataTables-example").rows[indi+1].cells[5].innerText;
                        var direccion=document.getElementById("dataTables-example").rows[indi+1].cells[6].innerText;
                        var ciudad=document.getElementById("dataTables-example").rows[indi+1].cells[7].innerText;
                        var departamento=document.getElementById("dataTables-example").rows[indi+1].cells[8].innerText;
                        
                        //var estado=document.getElementById("dataTables-example").rows[indi+1].cells[5].innerText;
                        document.getElementById("txtCodigo").value = codcliente;
                        document.getElementById("txtNombre").value = nombre;
			document.getElementById("txtApellido").value = apellido;
			document.getElementById("txtRuc").value = ruc;
                        document.getElementById("txtMail").value = mail;
                        document.getElementById("txtNro").value = numero;
                        document.getElementById("txtDireccion").value = direccion;
                        document.getElementById("txtCiudad").value = ciudad;
                        document.getElementById("txtdepartamento").value = departamento;
			});
		};
		function eliminar(codcliente){
			document.getElementById("txtCodigoE").value = codcliente;
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
                      <h1 class="page-header">Clientes - <small>ONM ESTACIONES</small></h1>
                </div>	
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Listado de Clientes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr class="success">
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Ruc</th>
                                            <th>Numero</th>
                                            <th>Direccion</th>
                                            <th>Ciudad</th>
                                            <th>Dpto.</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php
                    $query = "select * from clientes;";
                    $result = pg_query($query) or die ("Error al realizar la consulta");
                    while($row1 = pg_fetch_array($result))
                    {
                        $estado=$row1["estado"];
                        if($estado=='t'){$estado='Activo';}else{$estado='Inactivo';}
                        echo "<tr><td>".$row1["cli_cod"]."</td>";
                        echo "<td>".$row1["cli_nom"]."</td>";
                        echo "<td>".$row1["cli_ape"]."</td>";
                        echo "<td>".$row1["cli_ruc"]."</td>";
                        echo "<td>".$row1["cli_nro"]."</td>";
                        echo "<td>".$row1["cli_dir"]."</td>";
                        echo "<td>".$row1["cli_ciu"]."</td>";
                        echo "<td>".$row1["cli_dpto"]."</td>";
                        echo "<td>".$estado."</td>";
                        echo "<td>";?>
                        
                        <a onclick='modificar(<?php echo $row1["cli_cod"];?>)' class="btn btn-success btn-xs active" data-toggle="modal" data-target="#modalmod" role="button">Modificar</a>
                        <a onclick='eliminar(<?php echo $row1["cli_cod"];?>)' class="btn btn-danger btn-xs active" data-toggle="modal" data-target="#modalbor" role="button">Borrar</a>
                        <?php
                        echo "</td></tr>";
                    }
                    pg_free_result($result);
                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <a  class="btn btn-primary" data-toggle="modal" data-target="#modalagr" role="button">Nuevo</a>
                        </div>
                        <!-- /.panel-body -->
                        
                    </div>
                    <!-- /.panel -->
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
                                    <form  autocomplete="off" class="form-horizontal" name="agregarform" action="../class/ClsClientes.php" method="post" role="form">
						
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Nombre</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtNombreA" class="form-control" id="txtNombreA" placeholder="ingrese nombre" required />
                                            </div>
					</div>
					<div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Apellido</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtApellidoA" class="form-control" id="txtApellidoA" placeholder="ingrese apellido" />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Ruc</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtRucA" class="form-control" id="txtRucA" placeholder="ingrese RUC o CI"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">E-Mail</label>
                                            <div class="col-sm-10">
                                            <input type="mail" name="txtMailA" class="form-control" id="txtMailA" placeholder="ingrese e-mail"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Numero</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtNroA" class="form-control" id="txtNroA" placeholder="ingrese numero telefono"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Direccion</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtDireccionA" class="form-control" id="txtDireccionA" placeholder="ingrese direccion"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Ciudad</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtCiudadA" class="form-control" id="txtCiudadA" placeholder="ingrese ciudad"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Departamento</label>
                                            <div class="col-sm-10">
                                           <select name="txtDepartamentoA" class="form-control" id="txtDepartamentoA" required>
                                               <option>Concepcion</option>
                                               <option>San Pedro</option>
                                               <option>Cordillera</option>
                                               <option>Guairá</option>
                                               <option>Caaguazú</option>
                                               <option>Caazapá</option>
                                               <option>Itapúa</option>
                                               <option>Misiones</option>
                                               <option>Paraguarí</option>
                                               <option>Alto Paraná</option>
                                               <option>Central</option>
                                               <option>Ñeembucú</option>
                                               <option>Amambay</option>
                                               <option>Canindeyú</option>
                                               <option>Presidente Hayes</option>
                                               <option>Alto Paraguay</option>
                                               <option>Boquerón</option>
                                             </select>
                                            </div>
					</div>
					<div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input03">Estado</label>
                                            <div class="col-sm-10">
                                            <div class="radio">
                                            <label><input type="radio" name="opcionA" value="1" checked /> Activo</label>
                                            <label><input type="radio" name="opcionA" value="0" /> Inactivo</label>
                                            </div>
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
                                    <form  autocomplete="off" class="form-horizontal" name="modificarform" action="../class/ClsClientes.php"  method="post" role="form">
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                            <input type="hidden" name="txtCodigo" class="form-control" id="txtCodigo"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <input type="numeric" name="codigo1" class="hide" id="input000" />
                                            <label  class="col-sm-2 control-label" for="input01">Nombre</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtNombre" class="form-control" id="txtNombre"  required />
                                            </div>
					</div>
					<div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Apellido</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtApellido" class="form-control" id="txtApellido" placeholder="ingrese apellido"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Ruc</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtRuc" class="form-control" id="txtRuc" placeholder="ingrese RUC o CI"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">E-mail</label>
                                            <div class="col-sm-10">
                                            <input type="mail" name="txtMail" class="form-control" id="txtMail" placeholder="ingrese un e-mail"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Numero</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtNro" class="form-control" id="txtNro" placeholder="ingrese un numero de telefono"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Direccion</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtDireccion" class="form-control" id="txtDireccion" placeholder="ingrese direccion"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Ciudad</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtCiudad" class="form-control" id="txtCiudad" placeholder="ingrese ciudad"  />
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Departamento</label>
                                            <div class="col-sm-10">
                                           <select name="txtDepartamento" class="form-control" id="txtDepartamento" required>
                                               <option>Concepcion</option>
                                               <option>San Pedro</option>
                                               <option>Cordillera</option>
                                               <option>Guairá</option>
                                               <option>Caaguazú</option>
                                               <option>Caazapá</option>
                                               <option>Itapúa</option>
                                               <option>Misiones</option>
                                               <option>Paraguarí</option>
                                               <option>Alto Paraná</option>
                                               <option>Central</option>
                                               <option>Ñeembucú</option>
                                               <option>Amambay</option>
                                               <option>Canindeyú</option>
                                               <option>Presidente Hayes</option>
                                               <option>Alto Paraguay</option>
                                               <option>Boquerón</option>
                                             </select>
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input03">Estado</label>
                                            <div class="col-sm-10">
                                            <div class="radio">
                                            <label><input type="radio" name="txtOpcion" value="1" checked /> Activo</label>
                                            <label><input type="radio" name="txtOpcion" value="0" /> Inactivo</label>
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
                                    <form class="form-horizontal" name="borrarform" action="../class/ClsClientes.php" onsubmit="return submitForm();" method="post" role="form">
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