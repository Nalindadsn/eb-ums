<?php
include('db.php');
include('function5.php');
if(isset($_POST["user_id5"]))
{
	$output = array();
	$statement = $pdo->prepare(
		"SELECT * FROM accounts 
		WHERE id = '".$_POST["user_id5"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["bank_name"] = $row["bank_name"];
		$output["acc_no"] = $row["acc_no"];
		$output["branch_name"] = $row["branch_name"];
		if($row["bank"] != '')
		{
			$output['user_image5'] = '<img src="bank/'.$row["bank"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image5" value="'.$row["bank"].'" />';
		}
		else
		{
			$output['user_image5'] = '<input type="hidden" name="hidden_user_image5" value="" />';
		}
	}
	echo json_encode($output);
}
?>