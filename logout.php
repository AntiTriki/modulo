<?php
// En esta linea defines el nombre de la sesi�n.
session_name('nilds');
session_start();
// if session is not set redirect the user
$tipo_user = $_SESSION["tipo_usuario"];
/*if(empty($_SESSION['usuario']))
	{*/
		//if ($tipo_user == 'user')
//			{
//			//header("Location:http://www.livees.es/perfil.php"); PUBLICO
//			header("Location:perfil.php");
//			}
//		else
//			{
//			header("Location:http://www.livees.es/livees_empresas_index.php");
//			}
	/*}*/


//if logout then destroy the session and redirect the user
if(isset($_GET['logout']))
{
	$_SESSION = array();
	session_unset();
	session_destroy();
	header("Location:index.php");
}
//echo $_SESSION['usuario'];
//echo "<a href='secure.php?logout'><b>Logout<b></a>";
//echo "<div align='center'>estas dentro</a>";

?>
