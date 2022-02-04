<?php
include 'main.php';
// Output message
$msg = '';
// Now we check if the email from the resend activation form was submitted, isset() will check if the email exists.
if (isset($_POST['email'])) {
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code != "" AND activation_code != "activated"');
    $stmt->execute([ $_POST['email'] ]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    // If the account exists with the email
    if ($account) {
        // Account exist, the $msg variable will be used to show the output message (on the HTML form)
        send_activation_email($_POST['email'], $account['activation_code']);
        $msg = 'Activaton link has been sent to your email!';
    } else {
        $msg = 'We do not have an account with that email!';
    }
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

<h3 class="text-center">Send Activation Email</h3>
			<form action="resendactivation.php" method="post">
                <label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" class="form-control" placeholder="Your Email" id="email" required style="border-bottom: 1px dotted #ccc">
				<br>
				<div class="msg text-white bg-success" style="padding: 20px;"><?=$msg?></div>
				<br>
				<input type="submit" value="Submit" class="btn btn-danger">
			</form>

<br><br><br>
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