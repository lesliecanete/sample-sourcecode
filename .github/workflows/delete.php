<?php
	include('db.php');
	$info = json_decode(file_get_contents("php://input"));
	if (count($info) > 0) {
	    $id = $info->Id;
	    if ($connect->query("DELETE from tbl_customer where Id='$id'")) {
	        echo 'Member Deleted Successfully';
	    } else {
	        echo 'Failed';
	    }
	}
?>