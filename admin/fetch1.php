<?php
include('db.php');
include('function1.php');
$query = '';
$output = array();
$query .= "SELECT * FROM notice ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE registration_no LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR u_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR cat_id LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR address LIKE "%'.$_POST["search"]["value"].'%" ';
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
		$image = '<a target="new" href="notice/'.$row["image"].'"><img src="notice/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /></a>';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $image;
	$sub_array[] = $row["registration_no"];
	$sub_array[] = "".$row["u_name"];
	$sub_array[] = $row["cat_id"];
	$sub_array[] = $row["address"];
	$sub_array[] = $row["phone_no"];

$sub_array[] = $row['remarks'];
$sub_array[] = $row['created_at'];

	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>