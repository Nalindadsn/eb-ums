<?php
include 'main.php';
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['cpassword'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}
// Check to see if the email is valid.
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}
// Username must contain only characters and numbers.

// Password must be between 5 and 20 characters long.
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}
// Check if both the password and confirm password fields match
if ($_POST['cpassword'] != $_POST['password']) {
	exit('Passwords do not match!');
}
// Check if the account with that username already exists
$stmt = $pdo->prepare('SELECT id, password FROM accounts WHERE username = ? OR email = ?');
$stmt->execute([ $_POST['username'], $_POST['email'] ]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);



// Check if the account with that username already exists
$stmt = $pdo->prepare('SELECT * FROM accounts WHERE user_id = ? AND leftORright="l" ');
$stmt->execute([ $_POST['user_id']]);
$refCountl=$stmt->rowCount();
// Check if the account with that username already exists
$stmt = $pdo->prepare('SELECT * FROM accounts WHERE user_id = ? AND leftORright="r" ');
$stmt->execute([ $_POST['user_id']]);
$refCountr=$stmt->rowCount();

// Check if the account with that username already exists
$stmt = $pdo->prepare('SELECT * FROM accounts WHERE username = ?');
$stmt->execute([ $_POST['user_id'] ]);
$accountRef = $stmt->fetch(PDO::FETCH_ASSOC);

// Store the result so we can check if the account exists in the database.
if ($account) {
	// Username already exists
	// print_r($account);
	echo '<span style="color:red">Username and/or email exists!</span>';
}else if(!$accountRef){
	echo '<span style="color:red">invalid referral number !</span>';

}else if($refCountl>0 && $_POST['leftORright']=="l"){
	echo '<span style="color:red">You cant add to left side !</span>';

}else if($refCountr>0 && $_POST['leftORright']=="r"){
	echo '<span style="color:red">You cant add to right side !</span>';

} else {
	// Username doesnt exists, insert new account
	$stmt = $pdo->prepare('INSERT INTO accounts (username, password, email, activation_code,leftORright,user_id,product_id,product_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$uniqid = account_activation ? uniqid() : 'activated';
	$user_id=$_POST['user_id'];
	$product_id=$_POST['product_id'];
	$product_price=$_POST['product_price'];
	$leftORright=$_POST['leftORright'];
	$stmt->execute([ $_POST['username'], $password, $_POST['email'], $uniqid,$leftORright, $user_id,$product_id,$product_price ]);
	if (account_activation) {
		// Account activation required, send the user the activation email with the "send_activation_email" function from the "main.php" file
		send_activation_email($_POST['email'], $uniqid);
		echo 'Please check your email to activate your account!';
	} else {
		echo '<span style="color:green">You have successfully registered, you can now login!</span>';
	}
}
?>
