<?php
	//setting header to json
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');
	$host="sql12.freemysqlhosting.net";
$user="sql12251262";
$pass="lRfiJRA2JQ";
$db = "sql12251262";
	$connect=mysqli_connect($host,$user,$pass,$db);
	$pagerow = isset($_POST['pagerow'])? $_POST['pagerow'] : "";
	$page = isset($_POST['page'])? $_POST['page'] : "";
	
	if($page == ''){
	$sql = "SELECT id_outlet,nama_outlet,kota,rs_number,longitude,latitude FROM tb_outlet WHERE flag_show=1 limit 5 offset ".$pagerow;
	}
	else{
	$sql= "select id_outlet,nama_outlet,kota,rs_number,longitude,latitude 
	from tb_outlet 
	where lower(id_outlet) like '%".$page."%' or 
	lower(nama_outlet) like '%".$page."%' or
	lower(kota) like '%".$page."%' 
	limit 10 offset ".$pagerow;
	}
		
	$result = mysqli_query($connect,$sql);
	$row_encode = array();
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$row_encode[] = $row;
		}
	}
	else
	{
		echo "0 result";
	}
	mysqli_close($connect);
	$to_encode = array("isi"=>$row_encode);
	//
	echo json_encode($to_encode);
?>
