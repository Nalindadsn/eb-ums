<?php include 'main.php';


$stmt = $pdo->prepare("SELECT * FROM accounts WHERE username='".$_SESSION['name']."'");
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);


$im=$_SESSION['name'];

if (isset($_POST['submit'])) {

  header('location:treeWithinactive.php#'.$_POST['search']);
}

$stmt = $pdo->prepare("select username as id, email as email, user_id as parent_id,created_at from accounts WHERE status=1");
$stmt->execute();
// fetching rows into array
$tree_data = $stmt->fetchAll();


$currentid=$im;

function fetch_recursive($tree_data, $currentid, $parentfound = false, $cats = array())
{
    foreach($tree_data as $row)
    {
        if((!$parentfound && $row['id'] == $currentid) || $row['parent_id'] == $currentid)
        {
            $rowdata = array();
            foreach($row as $k => $v)
                $rowdata[$k] = $v;
            $cats[] = $rowdata;
            if($row['parent_id'] == $currentid)
                $cats = array_merge($cats, fetch_recursive($tree_data, $row['id'], true));
        }
    }
    return $cats;
}

$allRef=sizeof(fetch_recursive($tree_data,$im));

//-1



 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Tree Structure </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<link rel="stylesheet" href="treeflex.css">

<style type="text/css">
  /* make the nodes round and change their background-color */
.un{
  font-weight: bold;
}
.em{
  text-decoration: underline;
  font-size: 13px;
}
  .tree .tf-nc {
    padding: 0;
    border: 1px solid #fff;
    text-align: center;
  }

  .tree ul li{
    border:1px solid #fff;
  }

  /* make the horizontal and vertical connectors thick and change their color */

  .tf-custom .tf-nc:before,
  .tf-custom .tf-nc:after {
    border-left-color: dodgerblue;
    border-left-width: 2px;
  }

  .tf-custom li li:before {
    border-top-color: dodgerblue;
    border-top-width: 2px;
  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="





<?php 
foreach ($accounts as $keySes) { ?>


<?php if($keySes['role']=="Admin"){ ?>

main-header navbar navbar-expand navbar-dark navbar-danger
  <?php
}else{


 ?>
main-header navbar navbar-expand navbar-white navbar-light

  <?php
}}
 ?>


  ">    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="http://gemmind.lk/" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="all_products.php" class="nav-link">Products</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link navbar-navy">
      <span class="brand-text font-weight-light"><img src="dist/img/AdminLTELogo3.png" style="width: 80%;"></span>
    </a>
<br>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">



<?php 
foreach ($accounts as $keySes) {
if($keySes['image']==""){

 ?>
          <img src="img/user-profile.png" class="img-circle elevation-2" alt="User Image" style="background-color: #fff;">

  <?php
}else{

?>

          <img src="admin/upload/<?php echo $keySes['image'] ?>" class="img-circle elevation-2" alt="User Image">

<?php

}
}
?>

        </div>
        <div class="info" style="width: 100%;">


<?php 
foreach ($accounts as $keySes) { ?>
   <span class="badge rounded-pill 

   

<?php if($keySes['role']=="Admin"){
  echo "bg-success";
}else if($keySes['role']=="Member"){

  echo "bg-danger";

} ?>



   " style="float: right;"> <?php echo $keySes['username']; ?></span>
  <?php
}
 ?>


          <a href="profile.php" class="d-block">


<?php 
foreach ($accounts as $keySes) {
  

echo $keySes['first_name']." ".$keySes['last_name'];


}
 ?>


          </a>
        </div>
      </div>


      <!-- Sidebar Menu -->

     
      <!-- Sidebar Menu -->      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="tree.php" class="nav-link">
   
              <i class="fas fa-network-wired"></i>         
              <p>
                Network
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="treeWithinactive.php" class="nav-link   active ">

              <i class="fas fa-network-wired"></i>               
              <p>
                Tree With Inaactive's
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="compose.php" class="nav-link ">

              <i class="nav-icon fas fa-envelope"></i>              
              <p>
                Contact
                
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="admin/verify.php" class="nav-link ">

              <i class="nav-icon fas fa-user"></i>              
              <p>
                Verify Account




<?php 
foreach ($accounts as $keySes) { ?>

   

<?php if($keySes['status']=="1"){
  echo '<i class="fa fa-check" aria-hidden="true"></i>';
}else if($keySes['status']=="0"){

  echo '<i class="fas fa-times-circle"></i>';

}

 

 } ?>


                
              </p>
            </a>
          </li>

<?php 
foreach ($accounts as $keySes) { ?>
<?php if($keySes['role']=="Admin"){ ?>
          <li class="nav-item">
            <a href="admin/products.php" class="nav-link ">

              <i class="nav-icon fab fa-product-hunt"></i>               
              <p>
                Products
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin/users.php" class="nav-link ">

              <i class="nav-icon fas fa-users"></i>              
              <p>
                Users
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin_sp.php" class="nav-link ">

              <i class="nav-icon fas fa-users"></i>              
              <p>
                Add separate users
                
              </p>
            </a>
          </li>
  <?php
}
 ?>


  <?php
}
 ?>






          <li><hr></li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link " style="background-color: #d81b60;color: #fff;">
<i class="nav-icon fas fa-sign-out-alt"></i>
              <i class="nav-icon fas fa-sign-out"></i>              
              <p>
                Sign Out
                
              </p>
            </a>
          </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tree Structure</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tree Structure</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
                <!-- Info boxes -->
                   <!-- Info boxes -->
  


                <!-- Info boxes -->
        <div class="row">
          <!-- /.col -->
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">



<?php 
foreach ($accounts as $keySes) { ?>

   

<?php if($keySes['role']=="Admin"){

  echo  "New Members";


}else if($keySes['role']=="Member"){

  echo  "All Referral Members";

} ?>



  <?php
}
 ?>



















                </span>
                <span class="info-box-number">


                <?php

                if ($allRef==0) {
                   echo $allRef;
                }else{
                   echo $allRef-1;

                }

                ?>
                  


              </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                  

<?php 
$numC=0;
foreach (fetch_recursive($tree_data,$im) as $key) {
$current = strtotime(date("Y-m-d"));
 $date    = strtotime($key['created_at']);

 $datediff = $date - $current;
 $difference = floor($datediff/(60*60*24));
 if($difference==0)
 {
    //echo 'today';
if ($key['id']!=$_SESSION['name']) {
    $numC++;
$keyv[]= $key['id'];
}
 }
 else if($difference > 1)
 {
    //echo 'Future Date';
 }
 else if($difference > 0)
 {
    //echo 'tomorrow';
 }
 else if($difference < -1)
 {
    //echo 'Long Back';
 }
 else
 {
    //echo 'yesterday';
 }  






}
?>




                <span class="info-box-text">

<?php 
  echo  "New Members";
?>               
<?php if ($numC==0) {
?>
<span class="badge badge-pill badge-danger">TODAY</span>
<?php

} ?>
<?php if ($numC>0) {
?>
<span class="badge badge-pill badge-success">TODAY</span>
<?php
} ?>

                </span>


                <span class="info-box-number">

<?php
//echo sizeof($key)
  echo $numC;
if($numC==1){
foreach ($keyv as $keyIt) {
  if ($keyIt!=$_SESSION['name']) {
    # code...
 
  echo "&nbsp;&nbsp;&nbsp;<span class='badge badge-pill badge-danger'> <a class='text-white' href='userProfile.php?id=".$keyIt."'> ".$keyIt." </a></span>"; 

}

}
}

  //echo $numC;
  

 ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                  



<?php 


$stmt1 = $pdo->prepare("select username as id,image as image,first_name,email as email,last_name, username as name, user_id as parent_id ,created_at from accounts WHERE status='1'");
$stmt1->execute();
// fetching rows into array
$tree_data1 = $stmt1->fetchAll();

function fetch_recursive2x($tree_data1, $currentid, $parentfound = false, $cats = array())
{
    foreach($tree_data1 as $row)
    {
        if((!$parentfound && $row['id'] == $currentid) || $row['parent_id'] == $currentid)
        {
            $rowdata = array();
            foreach($row as $k => $v)
                $rowdata[$k] = $v;
            $cats[] = $rowdata;
            if($row['parent_id'] == $currentid)
                $cats = array_merge($cats, fetch_recursive2x($tree_data1, $row['id'], true));
        }
    }
    return $cats;
}
// echo "<pre>";
// print_r(fetch_recursive2x($tree_data1,$im)) ;
// echo "</pre>"; 

foreach (fetch_recursive2x($tree_data1,$im) as $key11) {
  //echo $key11['created_at']."<br>";
}

?>
<?php 


// $startDate = new DateTime('2021-01-24');
// $endDate = new DateTime('2021-02-22');




$day22 = date('w');
$week_start22 = date('Y/m/d', strtotime('-'.$day22.' days'));
$week_end22 = date('Y/m/d', strtotime('+'.(6-$day22).' days'));



$date11=date_create($week_start22);
$date22=date_create($week_end22);



$startDate = new DateTime(date_format($date11,"Y/m/d"));
$endDate = new DateTime(date_format($date22,"Y/m/d"));



$sundays = array();

while ($startDate <= $endDate) {
    if ($startDate->format('w') == 0) {
        $sundays[] = $startDate->format('Y-m-d');
 


/////////////////////////////////////////////

$n=0;
foreach (fetch_recursive2x($tree_data1,$im) as $key11) {
 // echo $key11['created_at']."<br>";

if ($key11['id']!=$_SESSION['name']) {

$tm=$key11['created_at'];

$time = $startDate->format('Y-m-d');

$date_one = $time; 
$date_one = strtotime($date_one);
$date_one = strtotime("+60 minutes", $date_one);
$date_one =  date('Y-m-d h:i A', $date_one);

$date_ten = strtotime($time); 
$date_ten = strtotime("-12 minutes", $date_ten); 
$date_ten = date('Y-m-d h:i A', $date_ten);

$paymentDate= date('Y-m-d', strtotime($tm) );

$contractDateBegin = date('Y-m-d h:i A', strtotime($date_ten)); 
$contractDateEnd = date('Y-m-d h:i A', strtotime($date_one));



$contractDateEnd=date('Y-m-d', strtotime($startDate->format('Y-m-d'). ' + 7 days'));



if($paymentDate > $contractDateBegin && $paymentDate < $contractDateEnd)  
{  
  $n++;

?>

<?php
} 


}


}



?>


                <span class="info-box-text">New Members


<?php if ($n==0) {
?>

<span class="badge badge-pill badge-danger">THIS WEEK</span>
<?php

} ?>

<?php if ($n>0) {
?>

<span class="badge badge-pill badge-success">THIS WEEK</span>
<?php

} ?>

                </span>
                <span class="info-box-number">
<?php

echo $n;



//////////////////////////////////////


    }
    
    $startDate->modify('+1 day');
}



 ?>













                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
  
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Tree View


<span class="badge rounded-pill
bg-success" >

                 <?php echo $_SESSION['name']; ?>
                 <span style="background: #333;color: #fff;margin: 2px ;border-radius: 50px;">&nbsp;&nbsp; you &nbsp;&nbsp; </span>
</span>
               </h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-sm-8"></div>
                      <div class="col-sm-4">
                        
<form accept="treeWithinactive.php" method="POST">
<div class="row">
  <div class="col-sm-6"><input type="search" name="search" class="form-control"></div>
  <div class="col-sm-6"><input type="submit" name="submit" class="btn btn-primary"></div>
</div>

  
  
</form>
                      </div>
                      
                    </div>

<div class="tf-tree">
<?php


$stmt = $pdo->prepare("SELECT * FROM accounts ");
$stmt->execute();
// fetching rows into array
$dataa = $stmt->fetchAll();


$arr=[];
foreach($dataa AS $row){
  $arr[$row['username']]['username']=$row['username'];
  $arr[$row['username']]['user_id']=$row['user_id'];
  $arr[$row['username']]['email']=$row['email'];
  $arr[$row['username']]['image']=$row['image'];
  $arr[$row['username']]['status']=$row['status'];

  $arr[$row['username']]['created_at']=$row['created_at'];
}
buildTreeView($arr,$im);
function buildTreeView($arr,$parent,$level = 0,$prelevel = -1){
  foreach($arr as $username=>$data){
    if($parent==$data['user_id']){
      if($level>$prelevel){
        echo "<ul class='tree vertical'>";
      }
      
      if($level==$prelevel){
        echo "</li>";
      }
      echo "<li ><span class='tf-nc'>";


?>
<center>
  <?php 
if ($data['image']=='') {
  echo "<div id='".$data['username']."' style='color:#fff;'>text</div>";
?>

<div style="width: 75px;height: 75px;background: url('img/user-profile.png');background-size: cover; border-radius: 50%;box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
<?php 
if ($data['status']==1) {
  echo "border: 5px solid #fff;";
}else{
  echo "border: 5px solid #dc3540;";
}

 ?>

"></div>
  
<?php 
//echo $data['status'];

 ?>
<?php
}else{
  echo "<div id='".$data['username']."' style='color:#fff;'>text</div>";
  ?>
<div style="width: 75px;height: 75px;background: url('admin/upload/<?php echo $data['image']; ?>');background-size: cover; border-radius: 50%;box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
<?php 
if ($data['status']==1) {
  echo "border: 5px solid #fff;";
}else{
  echo "border: 5px solid #dc3540;";
}

 ?>

"></div>
  
  <?php
}

   ?>
</center>
<?php 
      echo "<span class='un'><a href='userProfile.php?id=".$data['username']."'>".$data['username']."</a> <br></span><a href='view_user.php?id=".$data['username']."'>view Details </a><br><span class='em'>".$data['email']."</span><br><small>".$data['created_at']."</small> <br><a href='view_tree.php?id=".$data['username']."'>view tree</a>
";



 if($_SESSION['role']=="Admin"){

echo "<br><a href='admin_newUser.php?id=".$data['username']."'>add new + </a>";
}



echo"      </span>";
      if($level>$prelevel){
        $prelevel=$level;
      }
      $level++;
      buildTreeView($arr,$username,$level,$prelevel);
      $level--; 
    }
  }
  if($level==$prelevel){
    echo "</li></ul>";
  }
}
//echo "<pre>";
//print_r($arr);
?>  
</div>



                  </div>
                </div>





                <div class="row">
                  <!-- /.col -->
                  
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">

  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>
