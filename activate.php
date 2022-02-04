<?php
include 'main.php';
$msg = '';
// First we check if the email and code exists...
if (isset($_GET['email'], $_GET['code']) && !empty($_GET['code'])) {
	$stmt = $pdo->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code = ?');
	$stmt->execute([ $_GET['email'], $_GET['code'] ]);
	// Store the result so we can check if the account exists in the database.
	$account = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($account) {
		// Account exists with the requested email and code.
		$stmt = $pdo->prepare('UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?');
		// Set the new activation code to 'activated', this is how we can check if the user has activated their account.
		$activated = 'activated';
		$stmt->execute([ $activated, $_GET['email'], $_GET['code'] ]);
		$msg = 'Your account is now activated, you can now login!<br><a class="btn btn-success text-white" style="text-decoration:none;" href="index.php">Login</a>';
	} else {
		$msg = 'The account is already activated or doesn\'t exist!<br><a class="btn btn-success text-white" style="text-decoration:none;" href="index.php">Login</a>';
	}
} else {
	$msg = 'No code and/or email was specified!';
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Email Activation </title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container login" style="background-color: rgba(255,255,255,.5);">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <a href="index.php"><img src="images/black logo-01.png" width="100%;"></a>

		<div class="content">
			<h4 style="color: #333;" class="text-center"><?=$msg?></h4>
		</div>
              <p class="mb-0">
                <a href="all_products.php" class="text-center">Buy Products and join</a>
              </p>

          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>



  </body>
</html>