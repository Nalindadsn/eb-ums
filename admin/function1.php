<?php

function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './notice/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($user_id)
{
	include('db.php');
	$statement = $pdo->prepare("SELECT image FROM notice WHERE id = '$user_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["image"];
	}
}

function get_total_all_records()
{
	include('db.php');
	$statement = $pdo->prepare("SELECT * FROM notice");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_records_LS()
{
	include('db.php');
	$statement = $pdo->prepare("SELECT * FROM notice WHERE cat_id='LS'");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_records_PS()
{
	include('db.php');
	$statement = $pdo->prepare("SELECT * FROM notice WHERE cat_id='PS'");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_records_PB()
{
	include('db.php');
	$statement = $pdo->prepare("SELECT * FROM notice WHERE cat_id='PB'");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_records_SW()
{
	include('db.php');
	$statement = $pdo->prepare("SELECT * FROM notice WHERE cat_id='SW'");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_records_CU()
{
	include('db.php');
	$statement = $pdo->prepare("SELECT * FROM notice WHERE cat_id='CU'");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_records_MB()
{
	include('db.php');
	$statement = $pdo->prepare("SELECT * FROM notice WHERE cat_id='MB'");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_records_OT()
{
	include('db.php');
	$statement = $pdo->prepare("SELECT * FROM notice WHERE cat_id='OT'");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>