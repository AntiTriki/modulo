<?php
session_name('nilds');
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "n";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if(isset($_GET['operation'])) {
	try {
		$result = null;
		switch($_GET['operation']) {
			case 'get_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				$sql = "SELECT * FROM categoria where id_empresa=".$_SESSION['id_emp']." or id_empresa = 0 ";
				$res = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
				if($res->num_rows <=0){
				 //add condition when result is zero
				 echo 'nada';
				} else {
					//iterate on results row and create new index array of data

					while( $row = mysqli_fetch_assoc($res) ) {

						$data[] = $row;

					}
					$itemsByReference = array();

				// Build array of item references:
				foreach($data as $key => &$item) {
				   $itemsByReference[$item['id']] = &$item;
				   // Children array:
				   $itemsByReference[$item['id']]['children'] = array();
				   // Empty data class (so that json_encode adds "data: {}" )
				   $itemsByReference[$item['id']]['data'] = new StdClass();
				}

				// Set items as children of the relevant parent item.
				foreach($data as $key => &$item)
				   if($item['id_tipocategoria'] && isset($itemsByReference[$item['id_tipocategoria']]))
					  $itemsByReference [$item['id_tipocategoria']]['children'][] = &$item;

				// Remove items that were added to parents elsewhere:
				foreach($data as $key => &$item) {
				   if($item['id_tipocategoria'] && isset($itemsByReference[$item['id_tipocategoria']]))
					  unset($data[$key]);
				}
				}
				$result = $data;
				break;
			case 'create_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;

				$nodeText = isset($_GET['text']) && $_GET['text'] !== '' ? $_GET['text'] : '';
				$sql ="INSERT INTO `categoria` (`text`, `id_tipocategoria`,`id_empresa`) VALUES( '".$nodeText."', ".$node.",".$_SESSION['id_emp'].")";
				mysqli_query($conn, $sql);

				$result = array('id' => mysqli_insert_id($conn));
				print_r($result);die;
				break;




			case 'rename_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				//print_R($_GET);
				$nodeText = isset($_GET['text']) && $_GET['text'] !== '' ? $_GET['text'] : '';
				if($node!=1){
				$sql ="UPDATE `categoria` SET `text`='".$nodeText."' WHERE `id`= '".$node."'";
				mysqli_query($conn, $sql);}
				break;
			case 'delete_node':
                if($node!=1){
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				$sql ="DELETE FROM `categoria` WHERE `id`= '".$node."'";
				mysqli_query($conn, $sql);}
				break;
			default:
				throw new Exception('Unsupported operation: ' . $_GET['operation']);
				break;
		}
		header('Content-Type: application/json; charset=utf-8');

		echo json_encode($result);
	}
	catch (Exception $e) {
		header($_SERVER["SERVER_PROTOCOL"] . ' 500 Server Error');
		header('Status:  500 Server Error');
		echo $e->getMessage();
	}
	die();
}


?>
