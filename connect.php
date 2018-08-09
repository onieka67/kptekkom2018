<?php
header("Access-Control-Allow-Origin: *");
/*$host="localhost";
$user="root";
$pass="";
$db = "db_telkomsel";
$connect=mysqli_connect($host,$user,$pass,$db);

$id_outlet2=isset($_GET['id_outlet']) ? $_GET['id_outlet'] : "";
$nama_outlet2=isset($_GET['nama_outlet']) ? $_GET['nama_outlet'] : "";
$kota2=isset($_GET['kota']) ? $_GET['kota'] : "";
$rs_number2=isset($_GET['rs_number']) ? $_GET['rs_number'] : 0;
$kd_anggota2=isset($_GET['kd_anggota']) ? $_GET['kd_anggota'] : "";
$nama_anggota2=isset($_GET['nama_anggota']) ? $_GET['nama_anggota'] : "";
$alamat_anggota2=isset($_GET['alamat_anggota']) ? $_GET['alamat_anggota'] : "";

$sql="insert into tb_anggota(kd_anggota,nama_anggota,alamat_anggota) values ('$kd_anggota2','$nama_anggota2','$alamat_anggota2');insert into tb_outlet(id_outlet,nama_outlet,kota,rs_number,kd_anggota) values ('$id_outlet2','$nama_outlet2','$kota2','$rs_number2','$kd_anggota2')";

mysqli_multi_query($connect,$sql);
header('Content-type: application/json');
header("Access-Control-Allow-Origin *");
/*if(!$connect){echo 'fail';}
else{echo 'success';}
*/
$host="https://kptekkom2018.herokuapp.com";
$user="sql12251262";
$pass="lRfiJRA2JQ";
$db = "sql12251262";
$connect=mysqli_connect($host,$user,$pass,$db);

/*$id_outlet=isset($_GET['id_outlet']) ? $_GET['id_outlet'] : "";
$nama_outlet=isset($_GET['nama_outlet']) ? $_GET['nama_outlet'] : "";
$kota=isset($_GET['kota']) ? $_GET['kota'] : "";
$rs_number=isset($_GET['rs_number']) ? $_GET['rs_number'] : "";
$longitude=isset($_GET['longitude']) ? $_GET['longitude'] : "";
$latitude=isset($_GET['latitude']) ? $_GET['latitude'] : "";
$fungsi=isset($_GET['fungsi']) ? $_GET['fungsi'] : "0";*/

$id_outlet=isset($_POST['id_outlet']) ? $_POST['id_outlet'] : "";
$nama_outlet=isset($_POST['nama_outlet']) ? $_POST['nama_outlet'] : "";
$kota=isset($_POST['kota']) ? $_POST['kota'] : "";
$rs_number=isset($_POST['rs_number']) ? $_POST['rs_number'] : "";
$longitude=isset($_POST['longitude']) ? $_POST['longitude'] : "";
$latitude=isset($_POST['latitude']) ? $_POST['latitude'] : "";
$fungsi=isset($_POST['fungsi']) ? $_POST['fungsi'] : "0";

$image_path;

if($_FILES["file"]["name"] != '')
{
 $arrayname = explode('.', $_FILES["file"]["name"]);
 $ext = end($arrayname);
 $fixname = $id_outlet . '-' . rand(100, 999) . '.' . $ext;
 $locationinserver = './foto_outlet/' . $fixname;
 move_uploaded_file($_FILES["file"]["tmp_name"], $locationinserver);
 $locationindb = '/foto_outlet/' . $fixname;
 $image_path = $locationindb;
}

$flag_show="1";
/*
		$id=$_POST['image'];//nama foto
		if(isset($_FILES['foto'])){//iklan1=nama variabel file foto
			$foto=explode('.',$_FILES["foto1"]["name"]);
			$ext= count($foto)-1;
			$target_dir = "upload/";//folder = upload
			$nama_file="foto$id.".$foto[$ext];//iklan1=namafilenya + id
			$target_file = "http://127.0.0.1/kptelkomsel/".$target_dir .$nama_file;//
			$uploadOk = 1;//status upload
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {//value nya button = submit
				$check = getimagesize($_FILES['foto']["tmp_name"]);//nama file sekaligus nama ekstensi
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
			}

			// Check file size
			if ($_FILES['foto']["size"] > 500000) {//500000 maks 500kb
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES['foto']["tmp_name"], $target_file)) {
					$queri="insert into tb_outlet SET image='$nama_file'";
					$proses=mysqli_query($connect,$queri);
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
*/
/*$sql="insert into tb_anggota(kd_anggota,nama_anggota,alamat_anggota) values ('$kd_anggota','$nama_anggota','$alamat_anggota');insert into tb_outlet(id_outlet,nama_outlet,kota,rs_number) values ('$id_outlet','$nama_outlet','$kota','$rs_number');insert into tb_flag(id_flag,id_outlet,kd_anggota) values (1,'$id_outlet','$kd_anggota');";
mysqli_multi_query($connect,$sql);*/

if ($fungsi=="1") //untuk insert data outlet baru
{
	$flag_show = 1;
	$sql="insert into tb_outlet(id_outlet,nama_outlet,kota,rs_number,longitude,latitude,image_path,flag_show) values ('$id_outlet','$nama_outlet','$kota','$rs_number','$longitude','$latitude','$image_path','$flag_show')";
  mysqli_query($connect,$sql);
}

else if ($fungsi=="2") //untuk delete outlet
{
	$sql="update tb_outlet set flag_show = 0 where id_outlet='$id_outlet'";
	mysqli_query($connect,$sql);
}

else if ($fungsi=="3") //untuk update data tanpa gambar outlet
{
	$sql="update tb_outlet set nama_outlet='$nama_outlet', kota='$kota', rs_number='$rs_number', longitude='$longitude', latitude='$latitude' where id_outlet='$id_outlet'";
	mysqli_query($connect,$sql);
}

else if ($fungsi=="4") //untuk update gambar outlet saja
{
	$sql="update tb_outlet set image_path='$image_path' where id_outlet='$id_outlet'";
	mysqli_query($connect,$sql);
}

//untuk delete anggota
/*$kd_anggota="KP002";
$sql="delete from tb_anggota where kd_anggota='$kd_anggota' or nama_anggota='$nama_anggota' or alamat_anggota='$alamat_anggota'";
mysqli_query($connect,$sql);*/

//untuk update anggota
/*$kd_anggota="KP003";
$sql="update tb_anggota set nama_anggota='Tetangga Sebelah' where kd_anggota='$kd_anggota'";
mysqli_query($connect,$sql);*/

//untuk update outlet
/*$id_outlet="OUT002";
$sql="update tb_outlet set nama_outlet='Telkomsel ITS' where id_outlet='$id_outlet'";
mysqli_query($connect,$sql);*/
?>
