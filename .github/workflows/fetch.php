<?php

include('db.php');

$info = json_decode(file_get_contents("php://input"));

$query = '';
$data = array();
if (isset($info->id)){ //for fetching single data
	$query = "SELECT * FROM tbl_customer where ID='$info->id'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetch(PDO::FETCH_ASSOC);
	echo json_encode($result);
}else{
	if(isset($info->search_query))
	{
	 	$search_query = $info->search_query;
	 	$query = "
		 SELECT * FROM tbl_customer 
		 WHERE (Firstname LIKE '%$search_query%' 
		 OR Address LIKE '%$search_query%' 
		 OR City LIKE '%$search_query%' 
		 OR PostalCode LIKE '%$search_query%' 
		 OR Country LIKE '%$search_query%') 
		 OR Gender = '$search_query'
		 ";
		}
	else
	{
	 	$query = "SELECT * FROM tbl_customer ORDER BY ID DESC";
	}

	$statement = $connect->prepare($query);

	if($statement->execute())
	{
	 	while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
		  	$data[] = $row;
		}
		 	echo json_encode($data);
	}
}
?>

