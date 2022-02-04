<?php
include('db.php');
include('function4.php');
if(isset($_POST["user_id4"]))
{
	$output = array();
	$statement = $pdo->prepare(
		"SELECT * FROM accounts 
		WHERE id = '".$_POST["user_id4"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["first_name4"] = $row["first_name"];
		$output["last_name4"] = $row["last_name"];
		if($row["nicB"] != '')
		{
			$output['user_image4'] = '<img src="nicB/'.$row["nicB"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image4" value="'.$row["nicB"].'" />';
		}
		else
		{
			$output['user_image4'] = '<input type="hidden" name="hidden_user_image4" value="" />';
		}
	}
	echo json_encode($output);
}
?>