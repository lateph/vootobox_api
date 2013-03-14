<?php
$server = "127.0.0.1";
$user = "root";
$password = "";
$data = $_GET;
header('Content-type: application/json');
try {
    $con = mysql_connect($server,$user ,$password);
	if(!$con){
		throw new Exception('Gagal Konek Database Server.');
	}
	$db = mysql_select_db("track");
	if(!$db){
		throw new Exception('Gagal Konek Database.');
	}
	$from 				= @$data['from'];
	$profile_image_url 	= @$data['profile_image_url'];
	$date_twit 			= @$data['date_twit'];
	$content 			= @$data['content'];
	
	if($from=='' or $profile_image_url=='' or $date_twit=='' or $content==''){
		throw new Exception('Parameter Tidak Lengkap.');
	}
	
	$ft 				= "INSERT INTO facebook_track
			VALUES
			(null,'$from','$profile_image_url','$date_twit','$content')";

	$result = mysql_query($ft);
	if($result){
		echo json_encode(array('status'=>1));
	} else{
		throw new Exception('Gagal Menyimpan Didatabase.');
	}
} catch (Exception $e) {
	echo json_encode(array('status'=>0,'msg'=>$e->getMessage()));
}

//inserting data order

?>