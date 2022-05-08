<?php 
include "./users/init.php";
$db = DB::getInstance();
if(isset($_POST['id'])){
	$db->update('delivery.Deliverys',$_POST['id'], ['driver'=>$_POST['user']]);
	$db->update('delivery.Deliverys',$_POST['id'], ['status'=>'0']);
	if($db->error){
		$db->errorInfo();
	}else{
	echo "database updated";
	}
}else{
	echo "an error happend";
}
?>
