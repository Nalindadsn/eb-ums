<?php

function upload_image()
{
	if(isset($_FILES["user_image4"]))
	{
		$extension = explode('.', $_FILES['user_image4']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './nicB/' . $new_name;
		move_uploaded_file($_FILES['user_image4']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($user_id4)
{
	include('db.php');
	$statement = $pdo->prepare("SELECT nicB FROM accounts WHERE id = '$user_id4'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["nicB"];
	}
}

function get_total_all_records()
{
	include('db.php');
	$statement = $pdo->prepare("SELECT * FROM accounts");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>