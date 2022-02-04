<?php
include('db.php');
include('function1.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $pdo->prepare(
		"SELECT * FROM notice 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["registration_no"] = $row["registration_no"];
		$output["u_name"] = $row["u_name"];
		$output["cat_id"] = $row["cat_id"];
		$output["address"] = $row["address"];
		$output["phone_no"] = $row["phone_no"];
		$output["remarks"] = $row["remarks"];
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="notice/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>