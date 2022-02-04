<?php
include('db.php');
include('function3.php');
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
			INSERT INTO accounts (first_name, idno, image) 
			VALUES (:first_name, :idno, :image)
		");
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':idno'	=>	$_POST["idno"],
				':image'		=>	$image
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
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $pdo->prepare(
			"UPDATE accounts 
			SET first_name = :first_name, idno = :idno, nicF = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':idno'	=>	$_POST["idno"],
				':image'		=>	$image,
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>