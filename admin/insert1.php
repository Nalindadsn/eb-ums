<?php
include('db.php');
include('function1.php');
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
			INSERT INTO notice (registration_no, u_name, cat_id, address,phone_no,remarks, image) 
			VALUES (:registration_no, :u_name, :cat_id, :address,:phone_no,:remarks, :image)
		");
		$result = $statement->execute(
			array(
				':registration_no'	=>	$_POST["registration_no"],
				':u_name'	=>	$_POST["u_name"],
				':cat_id'	=>	$_POST["cat_id"],
				':address'	=>	$_POST["address"],
				':phone_no'	=>	$_POST["phone_no"],
				':remarks'	=>	$_POST["remarks"],
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
			"UPDATE notice 
			SET registration_no = :registration_no, u_name = :u_name, cat_id = :cat_id, address = :address, phone_no = :phone_no,remarks = :remarks, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':registration_no'	=>	$_POST["registration_no"],
				':u_name'	=>	$_POST["u_name"],
				':cat_id'	=>	$_POST["cat_id"],
				':address'	=>	$_POST["address"],
				':phone_no'	=>	$_POST["phone_no"],
				':remarks'	=>	$_POST["remarks"],
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