<?php
include 'main.php';
// If the user is logged-in redirect them to the home page
if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}
// Also check if the user is remembered, if so redirect them to the home page
if (isset($_COOKIE['rememberme']) && !empty($_COOKIE['rememberme'])) {
  // If the remember me cookie matches one in the database then we can update the session variables and the user will be logged-in.
  $stmt = $pdo->prepare('SELECT * FROM accounts WHERE rememberme = ?');
  $stmt->execute([ $_COOKIE['rememberme'] ]);
  $account = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($account) {
    // Found a match, user is "remembered" log them in automatically
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $account['username'];
    $_SESSION['id'] = $account['id'];
        $_SESSION['role'] = $account['role'];
        header('Location: index.php');
    exit;
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

    <title>Login Gemmind</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container login" style="background-color: rgba(255,255,255,.5);">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <a href="index.php"><img src="dist/img/logoceb.png" width="100%;"></a>


        <?php 
        if (isset($_GET['id'])) {
        ?>

<div style="padding: 20px;" class="bg-success text-white">
        Hello <?php echo $_GET['id'] ?>, You have successfully registed to the system.
</div>
          <?php
        }
         ?>

         <br><br>
  

            <form  action="authenticate.php" method="post">
              <div class="form-group first">
                <label for="username">Username</label>
        <?php 
        if (isset($_GET['id'])) {
        ?>
                  <input  type="text" name="username" placeholder="Username" id="username" required class="form-control" value="<?php echo $_GET['id'] ?>">
        <?php
        }else{
          ?>
                  <input  type="text" name="username" placeholder="Username" id="username" required class="form-control">
          <?php
        }
         ?>


              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>

                  <input type="password" name="password" placeholder="Your Password" id="password" required class="form-control">


              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me <a href="#" style="text-decoration: none;" class="text-primary">terms and conditions</a></span>
                  <input type="checkbox" required="" />
                  <div class="control__indicator"></div>
                </label>
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">

                <div class="msg text-danger" style="padding: 10px;"></div>
            </form>


          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>




    <script>
        document.querySelector(".login form").onsubmit = function(event) {
      event.preventDefault();
      var form_data = new FormData(document.querySelector(".login form"));
      var xhr = new XMLHttpRequest();
      xhr.open("POST", document.querySelector(".login form").action, true);
      xhr.onload = function () {
        if (this.responseText.toLowerCase().indexOf("success") !== -1) {

          <?php
        if (isset($_GET['id'])) {
          ?>
          window.location.href = "admin/verify.php";
          <?php
        }else{
          ?>
          window.location.href = "index.php";
        <?php } ?>
        } else {
          document.querySelector(".msg").innerHTML = this.responseText;
        }
      };
      xhr.send(form_data);
    };
    </script>

  </body>
</html>