<?php include 'main.php';

$stmtCk = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
$stmtCk->execute([ $_SESSION['id'] ]);
$account = $stmtCk->fetch(PDO::FETCH_ASSOC);
// Check if user is an admin...
// if ($account['role'] != 'Admin') {
//     exit('You do not have permission to access this page!');
//     header('all_product.php');
// }


if (!isset($_SESSION['name'])) {
  header('Location:all_products.php');
}


$stmt = $pdo->prepare("SELECT * FROM accounts WHERE username='".$_SESSION['name']."'");
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmtPay = $pdo->prepare("SELECT * FROM payments WHERE user_id='".$_SESSION['name']."'");
$stmtPay->execute();
$accountsPay = $stmtPay->fetchAll(PDO::FETCH_ASSOC);

$total=0;



$im=$_SESSION['name'];



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
      <!-- Sidebar Menu -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="index.php" class="nav-link  ">
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
            <a href="#" class="nav-link active">
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

              <li class="nav-item">
                <a href="userBalance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paymens</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin/transactions.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Transactions</p>
                </a>
              </li>
  <?php
}
 ?>
  <?php
}
 ?>

              <li class="nav-item">
                <a href="transactions.php" class="nav-link active">
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
            <h1 class="m-0">Payments   <span class="badge badge-pill badge-danger"><?php echo $_SESSION['name'] ?></span></h1>
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
        <!-- /.row -->
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Your Transactions</h5>








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






<?php 

try {
//include 'main.php';
// prepare sql and bind parameters
if (isset($_POST['submit'])) {
  # code...




    $stmt = $pdo->prepare("INSERT INTO payments (user_id, amount, 
note) 
VALUES (:user_id, :amount, :note)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':note', $note);

// insert a row
    $user_id = $_POST["user_id"];
    $amount = $_POST["amount"];
    $note = $_POST["note"];
    $stmt->execute();


    echo "<div class='bg-success'> &nbsp;New records created successfully<br>

&nbsp;&nbsp;User : ".$user_id."  &nbsp; &nbsp; &nbsp; Amount : Rs. ".$amount ."
    </div>";



}

}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
 ?>











<?php

$stmtAr = $pdo->prepare("SELECT * FROM accounts WHERE status=1");
$stmtAr->execute();
$accounts = $stmtAr->fetchAll(PDO::FETCH_ASSOC);
$stmtAr = $pdo->prepare("select username as id, email as email, user_id as parent_id,created_at from accounts WHERE status=1");
$stmtAr->execute();
// fetching rows into array
$tree_data = $stmtAr->fetchAll();
$total=0;

$tp1=0;
$tp2=0;



include 'user_balance.php';

function formatMoney($money) {
    if($money<1) {
        $money='Rs. '.$money*100;
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
        $money='Rs. '.$dollars.'.'.$cents;
    }
    return $money;
}


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
                $cats = array_merge($cats, fetch_recursive2($tree_data1, $row['id'], true));
        }
    }
    return $cats;
}

function ooo($ooo){

global $pdo;

$total=0;
$stmt1 = $pdo->prepare("select username as id,image,first_name,last_name, username as name, user_id as parent_id ,created_at from accounts where status='1'");
$stmt1->execute();
// fetching rows into array
$tree_data1 = $stmt1->fetchAll();

$stmta = $pdo->prepare("SELECT * FROM accounts WHERE status='1' AND role='Admin' ORDER BY id ASC LIMIT 1");
$stmta->execute();
// fetching rows into array
$dataaa = $stmta->fetchAll();



$stmt22 = $pdo->prepare("SELECT * FROM pointvalue");
$stmt22->execute();
$accounts22 = $stmt22->fetchAll(PDO::FETCH_ASSOC);

foreach ($accounts22 as $keyRow) {
  if ($keyRow['timeDuration']=="" && $keyRow['endDuration']=="") {
    $pV=$keyRow['pointVal'];
  }
}


foreach ($dataaa as $keyData) {
  # code...
$startDate = new DateTime(date('Y-m-d', strtotime($keyData['created_at'].'last sunday')));
$endDate = new DateTime(date('Y-m-d', strtotime(date("Y-m-d"))));
}

$numSr=0;
while ($startDate <= $endDate) {

$numSr=0;
$n=0;
$numSr=0;
$numV=0;    
if ($startDate->format('w') == 0) {

$numSr++;

foreach (fetch_recursive2($tree_data1,$ooo) as $key11) {
 // echo $key11['created_at']."<br>";
if ($key11['id']!=$ooo) {
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
  $n++;
} 



}

}


$arrD[] = array('name' => $n );
$sundays[] = $startDate->format('Y-m-d');

if ($n>0) {


?>     
<?php


/////////////////////////////////////////////

?>

<?php


 $total+=$n;
//echo $total
;


?>

<?php
}

    }
    
    $startDate->modify('+1 day');
}


return $total;

 ?>

<?php

}
//end fun
///////////////end fun oo/




function fetch_recursivePro($tree_data, $currentid, $parentfound = false, $cats = array())
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
                $cats = array_merge($cats, fetch_recursivePro($tree_data, $row['id'], true));
        }
    }
    return $cats;
}
/////////////

function rc(){
global $pdo;
$query = "SELECT * FROM accounts";

$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$xx=0;
$aaa=0;
foreach($result as $row)
{


        $stmt3zzb = $pdo->prepare("SELECT sum(amount) AS sumV FROM payments WHERE user_id='".$row['username']."'");
        $stmt3zzb->execute();
        $dataArr3ZZb = $stmt3zzb->fetchAll(PDO::FETCH_ASSOC);
        $rcb=$stmt3zzb->rowCount();

                $azz=0;
        foreach ($dataArr3ZZb as $keyDt) {
           $azz =  $keyDt['sumV'];
        }

if ((ooo($row['username'])-$azz)>0) {
    $xx++;
    $aaa++;
}
$xx=0;
}

return $aaa;
}




function leftSide($user_id){
global $pdo;
$stmt = $pdo->prepare("SELECT * FROM accounts WHERE user_id=? AND status='1' AND leftORright='l' ");
$stmt->execute([$user_id]); 
$user = $stmt->fetch();


if (isset($user['username'])) {
return $user['username'];
}else{
return "Not in left side";
}
}




function rightSide($user_id){
global $pdo;
$stmt = $pdo->prepare("SELECT * FROM accounts WHERE user_id=? AND status='1' AND leftORright='r' ");
$stmt->execute([$user_id]); 
$user = $stmt->fetch();
if (isset($user['username'])) {
return $user['username'];
}else{
return "Not in right side";
}
}





// ------------------------------


// function fetch_recursivePro($tree_data, $currentid, $parentfound = false, $cats = array())
// {
//     foreach($tree_data as $row)
//     {
//         if((!$parentfound && $row['id'] == $currentid) || $row['parent_id'] == $currentid)
//         {
//             $rowdata = array();
//             foreach($row as $k => $v)
//                 $rowdata[$k] = $v;
//             $cats[] = $rowdata;
//             if($row['parent_id'] == $currentid)
//                 $cats = array_merge($cats, fetch_recursivePro($tree_data, $row['id'], true));
//         }
//     }
//     return $cats;
// }


?>


<?php 


$money=0;
$bbb=0;
$subss=0;
foreach ($accounts as $row) {



       //echo sizeof(fetch_recursivePro($tree_data,$_SESSION['name']));
        $stmt3zzleft1 = $pdo->prepare("SELECT * FROM accounts WHERE user_id='".$row['username']."' AND leftORright='l' AND status='1' LIMIT 1");
        $stmt3zzleft1->execute();
        $dataArr3ZZleft1 = $stmt3zzleft1->fetch();
        $rcleft1=$stmt3zzleft1->rowCount();

       //echo sizeof(fetch_recursivePro($tree_data,$_SESSION['name']));
        $stmt3zzright1 = $pdo->prepare("SELECT * FROM accounts WHERE user_id='".$row['username']."' AND leftORright='r' AND status='1' LIMIT 1");
        $stmt3zzright1->execute();
        $dataArr3ZZright1 = $stmt3zzright1->fetch();
        $rcright1=$stmt3zzright1->rowCount();


        $stmt3zzb1 = $pdo->prepare("SELECT sum(amount) AS sumV FROM payments WHERE user_id='".$row['username']."'");
        $stmt3zzb1->execute();
        $dataArr3ZZb1 = $stmt3zzb1->fetch();
        $rcb=$stmt3zzb1->rowCount();


if ($rcleft1==1 & $rcright1==1) {


$bbbab=(userBal($tree_data,$dataArr3ZZleft1['username'],$dataArr3ZZright1['username'])*3150)-$dataArr3ZZb1['sumV'];


    if (userBal($tree_data,$dataArr3ZZleft1['username'],$dataArr3ZZright1['username'])>0 && $bbbab>0) {
//echo userBal($tree_data,$dataArr3ZZleft['username'],$dataArr3ZZright['username'])*3150;
$subss+=$dataArr3ZZb1['sumV'];
$bbb+=((userBal($tree_data,$dataArr3ZZleft1['username'],$dataArr3ZZright1['username'])*3150));
$money+=((userBal($tree_data,$dataArr3ZZleft1['username'],$dataArr3ZZright1['username'])*3150)-$dataArr3ZZb1['sumV']);


}



}
}

?>
<br>

<?php
 
 echo "<hr>";
 ?>



                <table  id="example2" class="table table-bordered table-hover">
                  <thead>











                  <tr>
                    <th>#SN</th>
                    <th>Username</th>
                    <th>Amount</th>
                    <th>Created at</th>
                  </tr>
                  </thead>
                  <tbody>
<?php



$naz=0;
foreach ($accountsPay as $row) {

$naz++;



?>
    <tr>
        <td align="center">

<?php echo $naz; ?>

        </td>
        <td>

<?php echo $row['user_id']; ?>

        </td>
            
   
        <td>
<?php echo $row['amount']; ?>
        </td>
        <td align="center">
<?php echo $row['created_at']; ?>

        </td>
    </tr>
<?php
    }
?>

                  </tfoot>
                </table>




                
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="userBalance.php"  method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Amount:</label>
            <input type="text" class="form-control" id="input" name="amount">
            <input  type="hidden" class="form-control" id="user_id" name="user_id">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Note:</label>
            <textarea class="form-control" id="message-text" name="note"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Pay</button>
      </div>


        </form>

    </div>
  </div>
</div>

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
</body>

</html>
