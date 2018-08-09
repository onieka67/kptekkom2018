<?php
	header('Access-Control-Allow-Origin: *');
	$pagerow = isset($_POST['pagerow'])? $_POST['pagerow'] : "";
	$page = isset($_POST['page'])? $_POST['page'] : "";

	header('Content-Type: application/json');
	$host="https://kptekkom2018.herokuapp.com";
$user="sql12251262";
$pass="lRfiJRA2JQ";
$db = "sql12251262";
	$connect=mysqli_connect($host,$user,$pass,$db);

	if($page == '')
	{
		$sql = "SELECT id_outlet,nama_outlet,kota,rs_number,longitude,latitude FROM tb_outlet WHERE flag_show=1 limit 5 offset ".$pagerow;
	}
	else
	{
		$sql= "SELECT id_outlet,nama_outlet,kota,rs_number,longitude,latitude FROM tb_outlet WHERE flag_show=1 AND
		lower(id_outlet) like '%".$page."%' or
		lower(nama_outlet) like '%".$page."%' or
		lower(kota) like '%".$page."%'
		limit 5 offset ".$pagerow;
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
	echo json_encode($to_encode);
?>
