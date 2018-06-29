<?php
session_name('nilds');
session_start();
include_once('conexion.php');


$serie=$_POST['serie'];
$glosa=$_POST['glosa'];
$tipo_comprobante=$_POST['tipo'];

$tipo_cambio=$_POST['tipo_cambio'];
$moneda=$_POST['moneda'];
$estado=$_POST['estado'];
$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);
$date = date('Y-m-d');
$fecha = str_replace('-', '-', $_POST["fecha"]);
$fecha = date('Y-m-d', strtotime($fecha));
$result = mysql_query("select * from periodo where id_empresa=".$_SESSION['id_emp']." and estado =1  ");
while ($row = mysql_fetch_array($result)) {

    if( $fecha >= $row['fecha_inicio'] and $fecha <= $row['fecha_fin']  ) {
        $result = mysql_query("INSERT INTO comprobante (serie,glosa,id_tipocomprobante,fecha,id_tipocambio,id_moneda,id_estado,id_empresa,id_periodo) 
VALUES 
(" . $serie . ",'" . $glosa . "'," . $tipo_comprobante . ",'" . $fecha . "'," . $tipo_cambio . "," . $moneda . "," . $estado . "," . $_SESSION['id_emp'] . ",".$row['id'].")");

        $result = mysql_query("SELECT 
c.id,c.serie , ti.tipocom, c.fecha,c.glosa, t.cambio,e.estado,m.moneda 
FROM `comprobante` c,
 (select c.descripcion as estado,com.id as id from concepto c, comprobante com where com.id_estado=c.id) e,
  (select c.descripcion as tipocom,com.id as id from concepto c, comprobante com where com.id_tipocomprobante=c.id) ti,
   (select c.descripcion as moneda,com.id as id from concepto c, comprobante com where com.id_moneda=c.id) m,
    tipo_cambio t where c.id=e.id and ti.id = c.id and m.id = c.id and t.id = c.id_tipocambio ORDER by id DESC LIMIT 1");

        $i = 1;
        while ($row = mysql_fetch_assoc($result)) {
            $array['id'] = $row['id'];
            $id_comprobante = $row['id'];
            $array['serie'] = $row['serie'];
            $array['tipocom'] = $row['tipocom'];
            $row['fecha'] = date("d-m-Y", strtotime($row['fecha']));
            $array['fecha'] = $row['fecha'];
            $array['glosa'] = $row['glosa'];
            $array['cambio'] = $row['cambio'];
            $array['estado'] = $row['estado'];
            $array['moneda'] = $row['moneda'];
            $array['valido']=1;
            $i++;
        }
        for ($i = 1; $i < $_POST['conteo'] + 1; $i++) {
            $result = mysql_query("INSERT INTO detalle_comprobante (glosa,id_cuenta,id_comprobante,debe,haber) 
VALUES 
('" . $_POST['glosa' . $i] . "'," . $_POST['id_detalle' . $i] . "," . $id_comprobante . ",'" . $_POST['debe' . $i] . "','" . $_POST['haber' . $i] . "')");

        }


        }else{

        $array['valido']=0;

        }

    }






print json_encode($array);

?>