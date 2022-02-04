<?php include 'main.php';


$stmt = $pdo->prepare("SELECT * FROM accounts WHERE username='".$_SESSION['name']."'");
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);


$im=$_SESSION['name'];



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
  <title> Compose Message</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini">
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

      <!-- Sidebar Menu -->
   
      <!-- Sidebar Menu -->
      <!-- Sidebar Menu -->
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
                 &nbsp;&nbsp;Genealogy
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="compose.php" class="nav-link  active  ">

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

          <h2 class=""><br>&nbsp;&nbsp;&nbsp;Messages</h2>
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
        <!-- /.row -->

        <div class="row ">
          <!-- /.col -->

          <div class="col-md-5">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Compose New Message</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div>
                 <form method="POST" id="comment_form">
                  <div class="form-group">
                   <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
                  </div>
                  <div class="form-group">
                   <textarea name="comment_content" id="" class="form-control" placeholder="Enter Comment" rows="10"></textarea>
                  </div>
                  <div class="form-group">
                   <input type="hidden" name="comment_id" id="comment_id" value="0" />
                   <button type="submit" name="submit" id="submit" class="btn btn-danger"  />&nbsp;&nbsp;&nbsp;Send &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-envelope"></i></button>
                  </div>
                 </form>
                 <span id="comment_message"></span>
                 <br />
                </div>



              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                </div>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-7">



<div class="card" style="min-height: 500px;">
            <div class="card-header">
              <h3 class="card-title">Inbox</h3>


              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
   <div id="display_comment"></div>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
            </div>
          </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Add text editor
    $('#comment_content').summernote()
  })
</script>
<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 
});
</script>
</body>
</html>
