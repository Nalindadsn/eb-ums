<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= 'SELECT * FROM accounts WHERE role="Admin"';
if(isset($_POST["search"]["value"]))
{
	$query .= 'AND 
	(first_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR username LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR status LIKE "%'.$_POST["search"]["value"].'%") ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{



	$image = '';
	if($row["image"] != '')
	{

		$image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '<img src="../img/user-profile.png" class="img-thumbnail" width="50" height="35" />';
	}
	$sub_array = array();
	$sub_array[] = $image;



	if ($row["nicF"]=='') {
	$sub_array[] =" <a class=' btn btn-warning btn-xs'><i class='fas fa-exclamation-triangle'></i> NIC Front</a>";
	}else{

	$sub_array[] =" <a class='btn btn-primary btn-xs ' href='nicF/".$row["nicF"]."'><i class='fa fa-check' aria-hidden='true'></i> NIC Front</a>";
	}


	if ($row["nicB"]=='') {
	$sub_array[] =" <a class=' btn btn-warning btn-xs'><i class='fas fa-exclamation-triangle'></i> NIC Back</a>";
	}else{

	$sub_array[] =" <a class='btn btn-primary btn-xs ' href='nicB/".$row["nicB"]."'><i class='fa fa-check' aria-hidden='true'></i> NIC Back</a>";
	}


	if ($row["bank"]=='') {
	$sub_array[] =" <a class=' btn btn-warning btn-xs'><i class='fas fa-exclamation-triangle'></i>  Pass Book</a>";
	}else{

	$sub_array[] =" <a class='btn btn-primary btn-xs ' href='bank/".$row["bank"]."'><i class='fa fa-check' aria-hidden='true'></i> Pass Book</a>";
	}




$sub_array[] =$row['username'];


	$sub_array[] = $row["user_id"]. "<br> <a href='../view_tree.php?id=".$row["user_id"]."'>view tree</a>" ;
	$sub_array[] = $row["first_name"];
	$sub_array[] = $row["last_name"];
	//$sub_array[] = $row["status"];
	if ($row['status']==1) {
		# code...
		$sub_array[] = '<span class="badge badge-pill badge-success">Activated</span>';
	}
	else if ($row['status']=='0') {
		# code...
		$sub_array[] = '<span class="badge badge-pill badge-danger">  Not Activated</span>';
	}else{
	$sub_array[] = $row["status"];

	}

	
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Activate</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records_admin(),
	"data"				=>	$data
);
echo json_encode($output);
?>