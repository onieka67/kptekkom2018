<?php
header('Access-Control-Allow-Origin: *');
$id_outlet=isset($_POST['id_outlet']) ? $_POST['id_outlet'] : "";

header('Content-Type: application/json');
$host="localhost";
$user="root";
$pass="";
$db = "dbtelkomsel";
$connect=mysqli_connect($host,$user,$pass,$db);

$sql = "SELECT id_outlet,nama_outlet,kota,rs_number,longitude,latitude,image_path FROM tb_outlet WHERE id_outlet='$id_outlet'";
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
