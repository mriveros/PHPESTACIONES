
<!--
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Control ONM-INTN
 */
-->

        <?php
        
        //conecta al 192.168.56.100
        function conexionlocal()
        {
            return $dbconn = pg_connect("host=localhost port=5434 dbname=ESTACIONES user=postgres password=postgres "
                    . "")or die ('no se pudo conectar a la base de datos');
        } 
        //funcion que selecciona a la base de Datos
       function selectConexion($database){
   
                return $conexion = conexionlocal();
           
          
        }
        //funcion para comprobar si existe el mismo dato en la tabla
       function func_existeDato($dato, $tabla, $columna){
            selectConexion('onmworkflow');
            $query = "select * from $tabla where $columna = '$dato' ;";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            if (pg_num_rows($result)>0)
            {
               return true;
            } else {
               return false;
            }
        }
        
       function func_existeDatoDetalle($dato1,$dato2 ,$tabla, $columna1,$columna2, $database){
            selectConexion($database);
            $query = "select * from $tabla where $columna1 = '$dato1' and $columna2 = '$dato2' ;";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            if (pg_num_rows($result)>0)
            {
               return true;
            } else {
               return false;
            }
        }
       //Funcion para obtener el mes en Letras
       function genMonth_Text($m) { 
        switch ($m) { 
         case '01': $month_text = "Enero"; break; 
         case '02': $month_text = "Febrero"; break; 
         case '03': $month_text = "Marzo"; break; 
         case '04': $month_text = "Abril"; break; 
         case '05': $month_text = "Mayo"; break; 
         case '06': $month_text = "Junio"; break; 
         case '07': $month_text = "Julio"; break; 
         case '08': $month_text = "Agosto"; break; 
         case '09': $month_text = "Septiembre"; break; 
         case '10': $month_text = "Octubre"; break; 
         case '11': $month_text = "Noviembre"; break; 
         case '12': $month_text = "Diciembre"; break; 
        } 
        return ($month_text); 
       }
      

