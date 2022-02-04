<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM payments ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE user_id LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR amount LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR note LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR created_at LIKE "%'.$_POST["search"]["value"].'%" ';
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

	$sub_array = array();




	$sub_array[] = $row["user_id"];




$sub_array[] ="Rs. ".$row['amount'];
	$sub_array[] = $row["created_at"];
	$sub_array[] = $row["note"];

	$sub_array[] = "";


	
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records_payments(),
	"data"				=>	$data
);
echo json_encode($output);
?>