<?php
include('db.php');
include('function4.php');
if(isset($_POST["operation4"]))
{
	if($_POST["operation4"] == "Add")
	{
		$image = '';
		if($_FILES["user_image4"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $pdo->prepare("
			INSERT INTO accounts (first_name, last_name, nicB) 
			VALUES (:first_name, :last_name, :image)
		");
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name4"],
				':last_name'	=>	$_POST["idno4"],
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation4"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image4"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image4"];
		}
		$statement = $pdo->prepare(
			"UPDATE accounts 
			SET first_name = :first_name, last_name = :last_name, nicB = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name4"],
				':last_name'	=>	$_POST["idno4"],
				':image'		=>	$image,
				':id'			=>	$_POST["user_id4"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>