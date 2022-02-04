<?php include 'main.php';

include 'user_balance.php';

if (!isset($_GET['id'])) {
  header('Location:all_products.php');
}
$stmt = $pdo->prepare("SELECT * FROM accounts WHERE username='".$_GET['id']."'");
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total=0;

function leftArN($ud,$tree_data1,$startDate){

$nOne=0;
foreach (fetch_recursive2($tree_data1,$ud) as $key11) {
 // echo $key11['created_at']."<br>";
if ($key11['id']!=$ud) {
  //echo $key11['id'];

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
  $nOne++;
} 

}

}

return $nOne;
}

function formatMoney($money) {
    if($money<1) {
        $money='P. '.$money*100;
    }
    else {
        $dollars=intval($money);
        $cents=$money-$dollars;
        $cents=$cents*100;
        if ($cents>0) {
        $cents=$cents*100;
        }else{

        $cents="0".$cents*100;
        }
        $money='P. '.$dollars.'.'.$cents;
    }
    return $money;
}



$im=$_GET['id'];



$stmt = $pdo->prepare("select username as id, email as email,status as status, user_id as parent_id,created_at from accounts WHERE status=1");
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

$stmt22 = $pdo->prepare("SELECT * FROM pointvalue");
$stmt22->execute();
$accounts22 = $stmt22->fetchAll(PDO::FETCH_ASSOC);

foreach ($accounts22 as $keyRow) {
  if ($keyRow['timeDuration']=="" && $keyRow['endDuration']=="") {
    $pV=$keyRow['pointVal'];
  }
}








       //echo sizeof(fetch_recursivePro($tree_data,$_GET['id']));
        $stmt3zzleft = $pdo->prepare("SELECT * FROM accounts WHERE user_id='".$_GET['id']."' AND leftORright='l' AND status='1' LIMIT 1");
        $stmt3zzleft->execute();
        $dataArr3ZZleft = $stmt3zzleft->fetch();
        $rcleft=$stmt3zzleft->rowCount();

       //echo sizeof(fetch_recursivePro($tree_data,$_GET['id']));
        $stmt3zzright = $pdo->prepare("SELECT * FROM accounts WHERE user_id='".$_GET['id']."' AND leftORright='r' AND status='1' LIMIT 1");
        $stmt3zzright->execute();
        $dataArr3ZZright = $stmt3zzright->fetch();
        $rcright=$stmt3zzright->rowCount();



        $stmt3zzb = $pdo->prepare("SELECT sum(amount) AS sumV FROM payments WHERE user_id='".$_GET['id']."'");
        $stmt3zzb->execute();
        $dataArr3ZZb = $stmt3zzb->fetch();
        $rcb=$stmt3zzb->rowCount();



if (!isset($dataArr3ZZleft['username'])) {
  $dataArr3ZZleft['username']="";
}
if (!isset($dataArr3ZZright['username'])) {
  $dataArr3ZZright['username']="";
}










 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Dashboard </title>






  <!-- Google Font: Source Sans Pro -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">



  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="icon"  href="img/icon.png" />

  <style type="text/css">
    body > div > aside.main-sidebar.sidebar-dark-danger.elevation-4 > div > div.os-padding > div > div > nav > ul > li:nth-child(1) > a:hover
    {
background-color: #000;
    }
    th{
      font-size: 12px;
/*      color: #fff;
      background-color: #500;*/
      padding: 0;
      text-align: center;
    }
    td{
      margin-top: auto;
margin-bottom: auto;
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


  ">
    <!-- Left navbar links -->
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
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link"><span class="badge badge-pill badge-dark">Role : <?php echo $_SESSION['role']; ?></span></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

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
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">



<?php 
foreach ($accounts as $keySes) {
if($keySes['image']==""){

 ?><br>
          <img src="img/user-profile.png" class="img-circle elevation-2" alt="User Image" style="background-color: #fff;">

  <?php
}else{

?><br>

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



   " style="float: right;"> <?php echo $keySes['username']; ?></span><br>
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
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="index.php" class="nav-link  active ">
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
                 &nbsp;&nbsp;Genealogy
                
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
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>   
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="admin/users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin/admin_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin/member_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Member List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="adminNew.php?" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register Member</p>
                </a>
              </li>


              


            </ul>
          </li>



  <?php
}
 ?>


  <?php
}
 ?>





<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-money-bill"></i> &nbsp;&nbsp;   
              <p>
                Payment Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">



<?php 
foreach ($accounts as $keySes) { ?>
<?php if($keySes['role']=="Admin"){ ?>

  <?php
}
 ?>
              <li class="nav-item">
                <a href="userBalance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paymens</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="transactions.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Transactions</p>
                </a>
              </li>
  <?php
}
 ?>

              <li class="nav-item">
                <a href="transactions.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Transactions</p>
                </a>
              </li>

              


            </ul>
          </li>

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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
if ($key['id']!=$_GET['id']) {
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
  if ($keyIt!=$_GET['id']) {
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
$nOne=0;
$nTwo=0;
foreach (fetch_recursive2x($tree_data1,$im) as $key11) {
 // echo $key11['created_at']."<br>";

if ($key11['id']!=$_GET['id']) {

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






          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                  




                <span class="info-box-text">My Wallet



                </span>
                <span class="info-box-number">

Rs. 

<?php 

if (isset($dataArr3ZZleft['username']) && isset($dataArr3ZZright['username'])) {

           echo   (userBal($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'])*3150)-$dataArr3ZZb['sumV'];
 }else{
  echo 0;
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
        <!-- /.row -->
        <!-- /.row -->



<?php 

//   echo "<pre>";
// if (isset($dataArr3ZZleft['username']) && isset($dataArr3ZZright['username'])) {
//   # code...
// print_r(arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A"));
// }


// echo "</pre>"; 


?>


        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><a href="profile.php"><?php echo $_GET['id']; ?></a></h5>










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
                  <div class="col-md-8">





                    <p class="text-center">
                      <strong>Sales: 

<?php 


$stmta = $pdo->prepare("SELECT * FROM accounts WHERE status='1' ORDER BY id ASC LIMIT 1");
$stmta->execute();
// fetching rows into array
$dataaa = $stmta->fetchAll();

foreach ($dataaa as $keyData) {
  # code...
echo date('Y/m/d', strtotime($keyData['created_at'].'last sunday')). " - ";
echo date('Y/m/d', strtotime(date("Y-m-d").'next sunday'));
}



 ?>

                      </strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="200" style="height: 200px;"></canvas>




                    </div>
                    <!-- /.chart-responsive -->






<?php 


// $stmt = $pdo->prepare("select username as id,image, email as email, user_id as parent_id,created_at from accounts WHERE status='1' order by created_at desc limit 8");
// $stmt->execute();
// // fetching rows into array
// $tree_data = $stmt->fetchAll();
// $rc=$stmt->rowCount();
 ?>


<center>weeks

<br>
 LEFT <i class="fas fa-chart-line text-primary"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RIGHT <i class="fas fa-chart-line text-danger"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ALL <i class="fas fa-chart-line text-success"></i></center>


<br>
<br>
<br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Members</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger">


<?php 
if (($allRef-1)>8) {
  echo ($allRef)." Members";
}
else{
  echo ($allRef-1)." New Members";
}


// echo $allRef-1;
?>
</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">




<?php 
$nnn=0;
foreach (fetch_recursive2x($tree_data1,$im) as $key111) {
$nnn++;
  if ($key111['id']!=$_GET['id'] && $nnn<8) {
?>
                      <li>
<?php
  if ($key111['image']=='') {
    ?>
                        <img src="img/user-profile.png" alt="User Image" style="width: 40px; background-color: #fff;">
    <?php
  }else{
    ?>
                        <img src="admin/upload/<?php echo $key111['image']; ?>" alt="User Image" style="width: 40px; background-color: #fff;">
    <?php
  }
  ?>

                        <a class="users-list-name text-danger" href="userProfile.php?id=<?php echo $key111['id']; ?>"><?php echo $key111['first_name']; ?> <?php echo $key111['last_name']; ?></a>

<a href = "mailto:<?php echo $key111['email']; ?>">
<?php echo $key111['email']; ?>
</a>





                        <span class="users-list-date"><?php echo $key111['created_at']; ?></span>
                      </li>


<?php
}
 }
?>


                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="tree.php">View Your Tree</a>
                  </div>

                  <!-- /.card-footer -->
                </div>
                <!--/.card -->

























                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
<h4 align="center">week progresses</h4>


        <table  id="example2" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Week Number</th>
            <th>Week Start</th>
            <th>Week End</th>
            <th>Left side members</th>
            <th>Right side members</th>
            <th>Total members</th>
            <th>Balance</th>
          </tr>
          </thead>
          <tbody>
<?php 
//print_r(arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A"));
//if (isset($dataArr3ZZleft['username']) && isset($dataArr3ZZright['username'])) {
# code...

foreach (arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A") as $keyVal) {
  if ($keyVal['total']>0) {
    # code...
 
 ?>
          <tr>
            <th><?php echo $keyVal['number']; ?></th>
            <th><?php echo $keyVal['start']; ?></th>
            <th><?php echo $keyVal['end']; ?></th>
            <th><?php echo $keyVal['left']; ?></th>
            <th><?php echo $keyVal['right']; ?></th>
            <th><?php echo $keyVal['total']; ?></th>
            <th><?php echo "Rs.". $keyVal['balance']*3150; ?></th>
          </tr>
<?php  
}
}
//}
 ?>




          </tbody>
        </table>

                    <p class="text-center">
                      






<?php 
$stmt1 = $pdo->prepare("select username as id,image,first_name,last_name, username as name, user_id as parent_id ,created_at from accounts where status='1'");
$stmt1->execute();
// fetching rows into array
$tree_data1 = $stmt1->fetchAll();



$stmt3 = $pdo->prepare("select username as id,image,first_name,last_name, username as name, user_id as parent_id ,created_at from accounts where status='1'");
$stmt3->execute();
// fetching rows into array
$tree_data3 = $stmt3->fetchAll();







function fetch_recursive2($tree_data1, $currentid, $parentfound = false, $cats = array())
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
                $cats = array_merge($cats, fetch_recursive($tree_data1, $row['id'], true));
        }
    }
    return $cats;
}
// echo "<pre>";
// print_r(fetch_recursive2($tree_data1,$im)) ;
// echo "</pre>"; 

?>





                    <!-- /.progress-group -->
                  </div>
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Page specific script -->
<script>

$(document).ready(function(){
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var user = button.data('user') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('pay to ' + user)
  modal.find('.modal-body #input').val(recipient)
  modal.find('.modal-body #user_id').val(user)
})
  });


  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript">


$(function () {
  'use strict'

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

  var salesChartData = {
    labels: [   <?php 
$nnn=0;

foreach (arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A")  as $keyA) {
  $nnn++;
 echo $nnn;
 if (sizeof(arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A"))!=$nnn) {
   echo ",";
 }
}
 ?>
],
    datasets: [
      {
        label: 'Users',
        backgroundColor: 'rgba(60,141,188,0)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [  

 <?php 
$nnz=0;
foreach (arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A") as $keyA) {
  $nnz++;
 echo "'".$keyA['left']."'";
 if (sizeof(arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A"))!=$nnz) {
   echo ",";
 }
}
 ?>
 ]
      }
      ,


      {
        label: 'Digital Goods',
        backgroundColor: 'rgba(60,141,188,0)',
        borderColor: 'rgba(255,0,0,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [
 <?php 
$nn=0;
foreach (arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A") as $keyA) {
  $nn++;
 echo "'".$keyA['right']."'";
 if (sizeof(arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A"))!=$nn) {
   echo ",";
 }
}
 ?>

      ]
      }
      ,


      {
        label: 'Digital Goods',
        backgroundColor: 'rgba(60,141,188,0)',
        borderColor: 'rgba(0,128,0,0.5)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [
 <?php 
$nn=0;
foreach (arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A") as $keyA) {
  $nn++;
 echo "'".$keyA['total']."'";
 if (sizeof(arraySet($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'],"A"))!=$nn) {
   echo ",";
 }
}
 ?>

      ]
      }


    ]
  }

  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart(salesChartCanvas, {
    type: 'line',
    data: salesChartData,
    options: salesChartOptions
  }
  )

  //---------------------------
  // - END MONTHLY SALES CHART -
  //---------------------------

  //-------------
  // - PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData = {
    labels: [
      'Chrome',
      'IE',
      'FireFox',
      'Safari',
      'Opera',
      'Navigator'
    ],
    datasets: [
      {
        data: [700, 500, 400, 600, 300, 100],
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  })

  //-----------------
  // - END PIE CHART -
  //-----------------

  /* jVector Maps
   * ------------
   * Create a world map with markers
   */
  $('#world-map-markers').mapael({
    map: {
      name: 'usa_states',
      zoom: {
        enabled: true,
        maxLevel: 10
      }
    }
  })

  // $('#world-map-markers').vectorMap({
  //   map              : 'world_en',
  //   normalizeFunction: 'polynomial',
  //   hoverOpacity     : 0.7,
  //   hoverColor       : false,
  //   backgroundColor  : 'transparent',
  //   regionStyle      : {
  //     initial      : {
  //       fill            : 'rgba(210, 214, 222, 1)',
  //       'fill-opacity'  : 1,
  //       stroke          : 'none',
  //       'stroke-width'  : 0,
  //       'stroke-opacity': 1
  //     },
  //     hover        : {
  //       'fill-opacity': 0.7,
  //       cursor        : 'pointer'
  //     },
  //     selected     : {
  //       fill: 'yellow'
  //     },
  //     selectedHover: {}
  //   },
  //   markerStyle      : {
  //     initial: {
  //       fill  : '#00a65a',
  //       stroke: '#111'
  //     }
  //   },
  //   markers          : [
  //     {
  //       latLng: [41.90, 12.45],
  //       name  : 'Vatican City'
  //     },
  //     {
  //       latLng: [43.73, 7.41],
  //       name  : 'Monaco'
  //     },
  //     {
  //       latLng: [-0.52, 166.93],
  //       name  : 'Nauru'
  //     },
  //     {
  //       latLng: [-8.51, 179.21],
  //       name  : 'Tuvalu'
  //     },
  //     {
  //       latLng: [43.93, 12.46],
  //       name  : 'San Marino'
  //     },
  //     {
  //       latLng: [47.14, 9.52],
  //       name  : 'Liechtenstein'
  //     },
  //     {
  //       latLng: [7.11, 171.06],
  //       name  : 'Marshall Islands'
  //     },
  //     {
  //       latLng: [17.3, -62.73],
  //       name  : 'Saint Kitts and Nevis'
  //     },
  //     {
  //       latLng: [3.2, 73.22],
  //       name  : 'Maldives'
  //     },
  //     {
  //       latLng: [35.88, 14.5],
  //       name  : 'Malta'
  //     },
  //     {
  //       latLng: [12.05, -61.75],
  //       name  : 'Grenada'
  //     },
  //     {
  //       latLng: [13.16, -61.23],
  //       name  : 'Saint Vincent and the Grenadines'
  //     },
  //     {
  //       latLng: [13.16, -59.55],
  //       name  : 'Barbados'
  //     },
  //     {
  //       latLng: [17.11, -61.85],
  //       name  : 'Antigua and Barbuda'
  //     },
  //     {
  //       latLng: [-4.61, 55.45],
  //       name  : 'Seychelles'
  //     },
  //     {
  //       latLng: [7.35, 134.46],
  //       name  : 'Palau'
  //     },
  //     {
  //       latLng: [42.5, 1.51],
  //       name  : 'Andorra'
  //     },
  //     {
  //       latLng: [14.01, -60.98],
  //       name  : 'Saint Lucia'
  //     },
  //     {
  //       latLng: [6.91, 158.18],
  //       name  : 'Federated States of Micronesia'
  //     },
  //     {
  //       latLng: [1.3, 103.8],
  //       name  : 'Singapore'
  //     },
  //     {
  //       latLng: [1.46, 173.03],
  //       name  : 'Kiribati'
  //     },
  //     {
  //       latLng: [-21.13, -175.2],
  //       name  : 'Tonga'
  //     },
  //     {
  //       latLng: [15.3, -61.38],
  //       name  : 'Dominica'
  //     },
  //     {
  //       latLng: [-20.2, 57.5],
  //       name  : 'Mauritius'
  //     },
  //     {
  //       latLng: [26.02, 50.55],
  //       name  : 'Bahrain'
  //     },
  //     {
  //       latLng: [0.33, 6.73],
  //       name  : 'São Tomé and Príncipe'
  //     }
  //   ]
  // })
})

</script>
</body>
</html>
