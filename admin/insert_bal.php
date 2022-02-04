<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{


		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $pdo->prepare("
			INSERT INTO payments (user_id, amount) 
			VALUES (:first_name, :last_name)
		");
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':last_name'	=>	$_POST["last_name"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}




	}
	if($_POST["operation"] == "Edit")
	{


		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $pdo->prepare("
			INSERT INTO payments (user_id, amount) 
			VALUES (:first_name, :last_name)
		");
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':last_name'	=>	$_POST["last_name"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';

		}


















	}
}

?>