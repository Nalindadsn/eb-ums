<?php 
include '../include/config.php';

 ?>
<?php

session_start();

$name = '';
$email = '';
$message = '';

if (isset($_SESSION['return_data'])) {
    
    $formOK = $_SESSION['return_data']['formOK'];
    $entries = $_SESSION['return_data']['entries'];
    $errors = $_SESSION['return_data']['errors'];
    unset($_SESSION['return_data']);
    
    if (!$formOK) {
        foreach ($entries as $key => $value) {
            ${$key} = $value;
        }
        $submitmessage = 'There were some problems with your submission.';
        $responsetype = 'failure';
    }
    else {
        $submitmessage = 'Thank you! Your email has been submitted.';
        $responsetype = 'success';
    }
}
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>wws</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- google fonts -->

		<!-- Css link -->
		<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/owl.transitions.css">
		<link rel="stylesheet" href="css/animate.min.css">
		<link rel="stylesheet" href="css/lightbox.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/preloader.css">
		<link rel="stylesheet" href="css/image.css">
		<link rel="stylesheet" href="css/icon.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/responsive.css">
<style type="text/css">
	body { padding-top: 50px; }
/*#####################
Additional Styles (required)
######################*/
#myCarousel .thumbnail {
	margin-bottom: 0;
}
.carousel-control.left, .carousel-control.right {
	background-image:none !important;
}
.carousel-control {
	color:#fff;
	top:40%;
	color:#428BCA;
	bottom:auto;
	padding-top:4px;
	width:30px;
	height:30px;
	text-shadow:none;
	opacity:1;
}
.carousel-control:hover {
	color: #d9534f;
}
.carousel-control.left, .carousel-control.right {
	background-image:none !important;
}
.carousel-control.right {
	left:auto;
	right:-32px;
}
.carousel-control.left {
	right:auto;
	left:-32px;
}
.carousel-indicators {
	bottom:-30px;
}
.carousel-indicators li {
	border-radius:0;
	width:10px;
	height:10px;
	background:#ccc;
	border:1px solid #ccc;
}
.carousel-indicators .active {
	width:12px;
	height:12px;
	background:#3276b1;
	border-color:#3276b1;
}


.list-with-icons {
  display: inline-block;
  list-style: none;
  padding: 0;
  margin: 0;
}

.list-with-icons div {
  display: block;
  width: 100%;
  padding: 12px 25px 12px 50px;
  margin: 20px;
  line-height: 1;
  font-family: 'Arial';
  font-size: 20px;
  border-radius: 3px;
  position: relative;
  transition: all .35s ease;
}

.list-with-icons li{
  display: block;
  width: 100%;
  padding: 12px 25px 12px 50px;
  margin: 20px;
  border-radius: 3px;
  position: relative;
  transition: all .35s ease;
}


.list-with-icons li:hover {
  -webkit-transform: translate(5px);
  -moz-transform: translate(5px);
  transform: translate(5px);
}

.list-with-icons li:before {
  content: "";
  display: block;
  width: 54px;
  height: 54px;
  margin-top: -27px;
  border-radius: 100%;
  background-color: #fff;
  border-left: 2px dotted #ccc;
  position: absolute;
  top: 50%;
  left: -15px;
}

.list-with-icons li:after {
  display: block;
  margin-top: -15px;
  font-family: FontAwesome;
  font-style: normal;
  font-weight: normal;
  font-size: 30px;
  position: absolute;
  top: 50%;
  left: -2.5px;
  content: '\f013';
  color: #795548;
}
        .top-nv{
            background-color: #2ea3f2;
            width: 100%;
            z-index: 1000;
        }



        .top-nv ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

.top-nv li {
  float: right;
}

.top-nv li a {
  display: block;
  color: #fff;
  font-weight:400;
  padding: 3px 20px;
}


.top-nv li a:hover {
  color: #2ea3f2;
  background-color: #fff;
}






        .top-nv-right ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

.top-nv-right li {
  float: right;
}

.top-nv-right li a {
  display: block;
  font-weight:400;
  padding: 3px 20px;
}


.top-nv-right li a:hover {
}













.top-nv li .active {
  padding: 3px 20px;
  display: block;
  color: #2ea3f2;
  background-color: #fff;
  font-weight:400;
}
.top-nv li .active:hover {
  color: #111;
}
#bs-example-navbar-collapse-1 a{
    font-weight: 400;
}
.logosec img{
    width: 100%;
}
.fa-star{
    color: #FFFF00  ;
    text-shadow: 2px  2px  2px rgba(0,0,0,.2)
}




.stnav {
    z-index: 1000;
  width: 100%;
  height: 50px;
  background: rgba(255,255,255, .8);
  border-top: 1px solid rgba(0,0,0, .2);
  border-bottom: 1px solid rgba(0,0,0, .2);
  position: sticky;
  top: 0;
}

.stnav ul li a:hover,
.stnav ul li a.active {
  background: #f00;
  
} 
.right-text{
    text-align: right;
}

.navbar{
    background-color: rgba(255,255,255,.8);
}
</style>
<style type="text/css">
  .carousel-caption {
  font-size: 12px;
  font-style: italic;
  font-weight: bold;
  /* display: none;  remove comment to hide captions */
}

</style>    <style type="text/css"> 
        /* Form */
        form ol { list-style: none; padding: 0; }        
        label { display: block; width: 100%; font-weight: 700; margin-top: 1em; }
        #submit-container { overflow: hidden; }
        #send { padding: 0.25em; float: left; }
        #loading { width: 32px; height: 32px; display: none; margin-left: 0.75em; float: left; background: url(img/ajax-loader.gif); }
        .instruction { font-style: italic; }        
        .star { color: red; }
        input.error, textarea.error { -webkit-box-shadow: 0px 0px 2px 0px #fa301e; -moz-box-shadow: 0px 0px 2px 0px #fa301e; box-shadow: 0px 0px 2px 0px #fa301e; }
        label.error { color: red; display: inline; margin-left: 0.5em; }
        
        /* Submit Message */
        .failure { color: red; background: pink }
        .success { color: green; background: lightgreen; }
        .success, .failure { padding: 1em; font-style: italic; }
        #submit-message { margin-top: 2em; clear: both; }        
        
        /* Utility */
        .hidden { display: none !important; visibility: hidden; }
    </style>

	</head>
	<body id="top" style="padding:0">
	
<header style="background-color: #fafafa; padding: 0; overflow: hidden;">
      <div class="top-nv">
            <ul>
            <li><a href="../product.php">
                <i class="fa fa-list"></i> 
            WWS Building Products & Services</a>
            </li>
              <li><a href="roofing.php" class="active">
                <i class="fa fa-table"></i> 
            WWS Roofing</a>
            </li>
              <li><a href="index.php">
                <i class="fa fa-home"></i> WWS Construction</a></li>
              <li><a href="../index.php" >
                <i class="fa fa-globe"></i> WWS </a></li>
            </ul>
        </div>
  <div class="row">
  <div class="col-sm-4">



<?php 


    $sql_logo_small = 'SELECT * FROM   files WHERE file_type="logo2" ORDER BY id ASC LIMIT 1';
    $stmt_logo_small = $db->query($sql_logo_small);

    $result_logo_small = $stmt_logo_small->fetchAll(PDO::FETCH_ASSOC);
    foreach($result_logo_small as $key_logo_small) {
    
?>

<a href="index.php"><img src="../admin/uploadFile/<?php echo $key_logo_small['id']; ?>/<?php echo $key_logo_small['fileName']; ?>" style="width: 80px;margin-left: 20px;"></a>
<?php } ?>

</div>
  <div class="col-sm-8 right-text">

    <div class="top-nv-right">
        <ul>
        <li>
<?php 


    $sql_phone = "SELECT * FROM   infoTbl2 WHERE infoType='phone' ORDER BY id ASC LIMIT 1";
    $stmt_phone = $db->query($sql_phone);

    $result_phone = $stmt_phone->fetchAll(PDO::FETCH_ASSOC);
    foreach($result_phone as $key_phone) {
      ?><a href="tel:<?php echo $key_phone['description']; ?>">
            <i class="fa fa-phone"></i>&nbsp;&nbsp;

      <?php echo $key_phone['description']; ?>
      
</a>
<?php
    }
    
?>

        </li>
        <li><?php 

    $sql_email = "SELECT * FROM   infoTbl2 WHERE infoType='email'";
    $stmt_email = $db->query($sql_email);

    $result_email = $stmt_email->fetchAll(PDO::FETCH_ASSOC);
    foreach($result_email as $key_email) {
      ?>
<a href="mailto:<?php echo $key_email['description']; ?>">
            <i class="fa fa-envelope"></i>&nbsp;&nbsp; 
      <?php echo $key_email['description']; ?>
  </a>    
<?php
    }
    
?>
        </li>
        </ul>
     </div>
  </div>
      
  </div>
</header>
<div class="stnav">
<nav class="navbar navbar-default" style="margin-bottom: 0; box-shadow: 0 10px 5px -5px rgba(0,0,0,.1);">
  <div class="">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button style="background-color: #333;" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li><a href="roofing.php" style="color: #000;">HOME</a></li>
        <li><a href="aboutRoofing.php">ABOUT US</a></li>
        <li><a href="servicesRoofing.php">SERVICES</a></li>
        <li><a href="projectsRoofing.php">PROJECT</a></li>
        <li><a href="contactRoofing.php">CONTACT US</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>

	<div class="wrapper">


<?php 


    $sql_slide = "SELECT * FROM   files WHERE file_type='slider2' ORDER BY id DESC LIMIT 1";
    $stmt_slide = $db->query($sql_slide);

    $result_slide = $stmt_slide->fetchAll(PDO::FETCH_ASSOC);
    foreach($result_slide as $key_slide2) {
    
?>



    <section id="banner" style="background: url('../admin/uploadFile/<?php echo $key_slide2['id']; ?>/<?php echo $key_slide2['fileName']; ?>');">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="block">
              <h1><?php echo $key_slide2['name']; ?></h1>
              <h2><?php echo $key_slide2['description']; ?></h2>
            </div>
          </div>
        </div>
      </div>
      <div class="scrolldown">
              <a id="scroll" href="#features" class="scroll"></a>
          </div>
    </section>

<?php } ?>


    <section id="blog2" style="background-color: #f1f1f1;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title"><br><br>
              <h2>Products
</h2>
            </div>
            <div id="blog-post2" class="owl-carousel">
              
<?php 


    $sql22 = "SELECT * FROM   files WHERE file_type='product2' ORDER BY id ASC";
    $users22 = $db->query($sql22);

    $result22 = $users22->fetchAll(PDO::FETCH_ASSOC);
    foreach($result22 as $key22) {
    
?>




              <div>
                <div class="block" style="
    background: #fff;
    margin: 0 5px;padding: 10px;">
                        <div align="center">
                        <img class="img-responsive" src="../admin/uploadFile/<?php echo $key22['id']; ?>/<?php echo $key22['fileName']; ?>" alt="Image">
                            
                        </div>
                  <div class="content" align="center">
                    <br>
                    <h2><a href="blog.html"><?php echo $key22['name'] ?></a></h2><br>
                    <p align="left">
                      “<?php echo $key22['description'] ?>”
                    </p>
                    
                  </div>
                </div>
              </div>

<?PHP
}
 ?>














              
            </div>    
          </div>
        </div>
      </div>
    </section>



              
<?php 
$var=trim("WHY PEOPLE CHOOSE US");
    $sql222 = 'SELECT * FROM   files WHERE name="'.$var.'" AND file_type="otherFiles2"';
    $users222 = $db->query($sql222);

    $result222 = $users222->fetchAll(PDO::FETCH_ASSOC);
    foreach($result222 as $key222) {
?>




		<section id="features">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title">
							<h2><?php echo $key222['name']; ?></h2>
							<p><?php echo $key222['description']; ?></p>
						</div>
					</div>
				</div>




<div class="row ">
                <div class="col-sm-6 col-xs-12 g-hor-centered-row__col g-margin-b-60--xs g-margin-b-0--md">
                    <div class="wow fadeInLeft  animated" data-wow-duration=".3" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                        <img class="img-responsive" src="../admin/uploadFile/<?php echo $key222['id']; ?>/<?php echo $key222['fileName']; ?>" alt="Image">
                    </div>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-5 g-hor-centered-row__col">



<ul class="list-with-icons">
<?php 
    $sql_buildingFeatures = "SELECT * FROM   infoTbl2 WHERE infoType='buildingFeatures'";
    $stmt_buildingFeatures = $db->query($sql_buildingFeatures);

    $result_buildingFeatures = $stmt_buildingFeatures->fetchAll(PDO::FETCH_ASSOC);
    foreach($result_buildingFeatures as $key_buildingFeatures) {
      ?>


  <li>
    <a href="#"><?php echo $key_buildingFeatures['name']; ?></a>
    <p><?php echo $key_buildingFeatures['description']; ?></p>
  </li>
<?php
    }
?>
 
<!-- 
 <ul class="list-with-icons">
  <li>
    <a href="#">Energy Efficiency</a>
    <p>Nowadays, pre-engineered buildings are the green solution for the environment with CO2 reduction, energy efficiency and recyclability.</p>
  </li>
  <li>
    <a href="#">Flexibility</a>
    <p>Flexible in any requirement of design, easy to expand in the future and also economically with low transportation cost.</p>
  </li>
  <li>
    <a href="#">Quick Erection</a>
    <p>All steel components are fabricated at factory and are linked by bolts at site. So the erection process is fast, step by step, easy to install .</p>
  </li>
  <li>
    <a href="#">Cost Savings</a>
    <p>Site erection cost is low because of faster erection times and easier erection process</p>
  </li>
</ul> -->
</ul>
            
        </div>

</div>








			</div>
		</section>

<?php } ?>
              
<?php 
$var22=trim("WE ARE THE MOST TRUSTED ROOFING COMPANY");
    $sql2222 = 'SELECT * FROM   files WHERE name="'.$var22.'" AND file_type="otherFiles2" LIMIT 1';
    $users2222 = $db->query($sql2222);

    $result2222 = $users2222->fetchAll(PDO::FETCH_ASSOC);
    foreach($result2222 as $key2222) {

?>


		<section id="counter" style="background:url('../admin/uploadFile/<?php echo $key2222['id']; ?>/<?php echo $key2222['fileName']; ?>');">
			<div class="container">



				<div class="row">
					<div class="title">
						<h2><?php echo $key2222['name']; ?></h2>
						<p><?php echo $key2222['description']; ?></p>
					</div>



					<div class="col-md-4 col-xs-6 col-sm-6">
						<div class="feature-block text-center">
							<div class="icon-box">
								<i class="ion-easel"></i>
							</div>
							<h4 class="wow fadeInUp" data-wow-delay=".3s" style="color:#fff;">Residential</h4>
							<p class="wow fadeInUp" data-wow-delay=".5s" style="color:#fff;">The WWS Roofing is dedicated to serving your needs in a timely manner, emphasising on quality and service
excellence.</p>
						</div>
					</div>
					<div class="col-md-4 col-xs-6 col-sm-6">
						<div class="feature-block text-center">
							<div class="icon-box">
								<i class="ion-paintbucket"></i>
							</div>
							<h4 class="wow fadeInUp" data-wow-delay=".3s" style="color:#fff;">Commercial</h4>
							<p class="wow fadeInUp" data-wow-delay=".5s" style="color:#fff;">A building’s roof is its first barrier against adverse weather. Keeping your roof in excellent shape protects your building from water intrusion.</p>
						</div>
					</div>
					<div class="col-md-4 col-xs-6 col-sm-6">
						<div class="feature-block text-center">
							<div class="icon-box">
								<i class="ion-paintbrush"></i>
							</div>
							<h4 class="wow fadeInUp" data-wow-delay=".3s" style="color:#fff;">Repairs</h4>
							<p class="wow fadeInUp" data-wow-delay=".5s" style="color:#fff;">With every residential and commercial roofing job, we focus on the details to ensure that your roofing problems are solved immediately.</p>
						</div>
					</div>




<div class="col-md-12"><br><br>
	<a href="about.php" class="btn btn-primary">About Us</a>
</div>



				</div>
			</div>
		</section>

  <?php } ?>
		<section id="portfolio">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title">
							<h2>View Our Recent Projects</h2>
						</div>
						<div class="block">
							<div class="recent-work-mixMenu">
								<ul>
									<li><button class="filter" data-filter="all">All</button></li>
								</ul>
							</div>
							<div class="recent-work-pic">
								<ul id="mixed-items">


      
<?php 


    $sql_gallery = "SELECT * FROM   files WHERE file_type='gallery2' ORDER BY id ASC LIMIT 9";
    $stmt_gallery = $db->query($sql_gallery);

    $result_gallery = $stmt_gallery->fetchAll(PDO::FETCH_ASSOC);

    foreach($result_gallery as $key_gallery) {
    
?>



									<li class="mix category-1 col-md-4 col-xs-6" data-my-order="1">
										<a class="example-image-link" href="../admin/uploadFile/<?php echo $key_gallery['id']; ?>/<?php echo $key_gallery['fileName']; ?>" data-lightbox="example-set">
											<img class="img-responsive" src="../admin/uploadFile/<?php echo $key_gallery['id']; ?>/<?php echo $key_gallery['fileName']; ?>" alt="">
											<div class="overlay">
													<h3><?php echo $key_gallery['name']; ?></h3>
													<i class="ion-ios-plus-empty"></i>
											</div>
										</a>
									</li>

<?php } ?>


								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


    <section id="blog">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title">
              <h2>What our customers say about us
</h2>
            </div>
            <div id="blog-post" class="owl-carousel">
              
<?php 


    $sql = "SELECT * FROM   clientTestimonials WHERE clientType=2 ORDER BY id ASC";
    $users = $db->query($sql);

    $result = $users->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $key) {
    
?>




              <div>
                <div class="block">
                        <div align="center">
                        <img class="img-responsive" src="../img/user.png" alt="Image" width="100px" style="margin-top: 50px;">
                            
                        </div>
                  <div class="content">
                    
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    <h4><a href="blog.html"><?php echo $key['name'] ?></a></h4>
                    <small><?php echo $key['designation'] ?></small>
                    <p>
                      “<?php echo $key['description'] ?>”
                    </p>
                    
                  </div>
                </div>
              </div>

<?PHP
}
 ?>














              
            </div>    
          </div>
        </div>
      </div>
    </section>


		<section id="client-logo">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="block">
							<div id="Client_Logo" class="owl-carousel">


<?php 


    $sql_client = "SELECT * FROM files WHERE file_type='client2'";
    $stmt_client = $db->query($sql_client);

    $result_client = $stmt_client->fetchAll(PDO::FETCH_ASSOC);
    foreach($result_client as $key_client) { 
      ?>



                <div>
                  <a href="#"><img class="img-responsive" src="../admin/uploadFile/<?php echo $key_client['id']; ?>/<?php echo $key_client['fileName']; ?>" alt=""></a>
                </div>

<?php
    }  
?>




							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="contact-formm">
			<div class="container">
				<div class="row">
					<div class="title">
						<h2>CONTACT US</h2>
						<p>Want to get in touch? We'd love to hear from you. Here's how you can reach us...</p>
					</div>
					<div class="col-md-6 col">
						<!-- map -->
						<div class="map">
<iframe src="<?php 
    $sql_map = "SELECT * FROM   infoTbl2 WHERE infoType='map' ORDER BY id ASC LIMIT 1";
    $stmt_map = $db->query($sql_map);

    $result_map = $stmt_map->fetchAll(PDO::FETCH_ASSOC);
    foreach($result_map as $key_map) { 

$str = $key_map['description'];
$new_str = str_replace(' ', '', $str);
echo $new_str; 
    }
?>" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	                   </div><!--/map-->

					</div>
					<div class="col-md-6">




                <form method="post" id="contact-form" action="process.php" novalidate="novalidate" style="padding: 0;">


                <input placeholder="Name *" type="text" name="name" class="form-control s-form-v2__input g-radius--50" id="name" <?php if (isset($errors['name'])) { echo 'class="error form-control s-form-v2__input g-radius--50"';}?> value="<?php echo $name; ?>" required="required"/>
                <?php if (isset($errors['name'])): ?><label class="error"><?php echo $errors['name']; ?></label><?php endif; ?>

                <input placeholder="Your Mail *" type="email" class="form-control s-form-v2__input g-radius--50"  name="email" id="email" <?php if (isset($errors['email'])) { echo 'class="error form-control s-form-v2__input g-radius--50"';}?> value="<?php echo $email; ?>" required="required"/>
                <?php if (isset($errors['email'])): ?><label class="error"><?php echo $errors['email']; ?></label><?php endif; ?>

               <textarea placeholder="Message" rows="6"  class="form-control s-form-v2__input g-radius--10 g-padding-y-20--xs" name="message" id="message" <?php if (isset($errors['message'])) { echo 'class="error form-control s-form-v2__input g-radius--10 g-padding-y-20--xs"' ;}?> required="required"/><?php echo $message; ?></textarea>
                <?php if (isset($errors['message'])): ?><label class="error"><?php echo $errors['message']; ?></label><?php endif; ?>


                        <button style="padding: 10px 20px;" type="submit"  name="send" id="send" class="">Submit</button>
                        <span id="loading2"></span> 

        <div id="submit-message"><br><br>
            <span class="<?php echo (isset($formOK) ? $responsetype : 'hidden'); ?>"><?php if(isset($formOK)) { echo $submitmessage; } ?></span>
        </div>

               </form>


					</div>
				</div>
			</div>
		</section>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="block">
							<a href="#"><img src="../img/logo.png" alt=""></a>
							<p>All rights reserved © 2020</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>

		<!-- load Js -->

    <script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/waypoints.min.js"></script>
		<script src="js/lightbox.js"></script>
		<script src="js/jquery.counterup.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/html5lightbox.js"></script>
		<script src="js/jquery.mixitup.js"></script>
		<script src="js/wow.min.js"></script>
		<script src="js/jquery.scrollUp.js"></script>
		<script src="js/jquery.sticky.js"></script>
		<script src="js/jquery.nav.js"></script>
		<script src="js/main.js"></script>
		<script type="text/javascript">
			$('#myCarousel').carousel({
		interval:   4000
	});
		</script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
	</body>
</html>