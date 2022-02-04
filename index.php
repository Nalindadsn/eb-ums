<?php include 'main.php';

include 'user_balance.php';

if (!isset($_SESSION['name'])) {
  header('Location:login.php');
}
$stmt = $pdo->prepare("SELECT * FROM accounts WHERE username='".$_SESSION['name']."'");
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total=0;
include 'admin/function.php';

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

  <style>
/* width */
.main-sidebar{
  overflow: auto;
}
.main-sidebar::-webkit-scrollbar {
  width: 10px;
}

/* Track */
.main-sidebar::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
}
 
/* Handle */
.main-sidebar::-webkit-scrollbar-thumb {
  background: #ccc; 
  border-radius: 10px;
}

/* Handle on hover */
.main-sidebar::-webkit-scrollbar-thumb:hover {
  background: #000; 
}
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="




main-header navbar navbar-expand navbar-white navbar-light
  ">    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link"><span class="badge badge-pill badge-dark">Ceylon Electricity Board</span></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->


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
    <a href="index.php" class="brand-link navbar-white">

      <span class="brand-text font-weight-light">





        <img src="dist/img/logoceb.png" style="width: 80%;">




      </span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar"><br>
      <!-- Sidebar user (optional) -->
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

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="index.php" class="nav-link  active ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                dashboard
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile 
                
              </p>
            </a>
          </li>

<?php 
foreach ($accounts as $keySes) { ?>
<?php if($keySes['role']=="Admin"){ ?>


<li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-bell"></i>   
              <p>
                Notice
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="admin/notice.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Notice</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="admin/noticeMC.php" class="nav-link  ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Meter Changing</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="admin/noticeWL.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>WAYLEVES</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="admin/noticeLS.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Line Shifting</p>
                </a>
              </li>
              

              <li class="nav-item">
                <a href="admin/noticePS.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pole Shifting</p>
                </a>
              </li>
              

              <li class="nav-item">
                <a href="admin/noticePB.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pole Brakedown</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="admin/noticeSW.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service Wayer</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="admin/noticeCU.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cutouts</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="admin/noticeMB.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Meter Box</p>
                </a>
              </li>
              

              <li class="nav-item">
                <a href="admin/noticeOT.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Other</p>
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
 
        <!-- /.row -->
        <!-- /.row -->
<div class="alert alert-success" role="alert">
           <h4 class="alert-heading">Welcome!</h4>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
           </button>
           <p>Dear <?php echo $_SESSION['name']; ?>, You have Successfully Signed In CEB</p>
           <!--<p class="mb-0">Thanks From Solario!.</p>-->
          </div>


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
                <h5 class="card-title"><a href="profile.php"><?php echo $_SESSION['name']; ?></a> <span class="badge badge-pill badge-dark">Role : <?php echo $_SESSION['role']; ?></span></h5>










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



<a   class="btn btn-default btn-lg">No of Admins :  <?php   echo get_total_all_records(); ?></a>

<a href="adminNew.php"  class="btn btn-danger btn-lg">+ Add New Admin</a>

<a href="admin/users.php"  class="btn btn-danger btn-lg"> View Admin List</a>

<hr>

<div class="container-fluid">
  <div class="row">
    <div class="card-deck">
      <div class="card">
        <img class="card-img-top" src="//placehold.it/720x350" alt="Card image cap">
        <div class="card-block">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="//placehold.it/720x350" alt="Card image cap">
        <div class="card-block">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="//placehold.it/720x350" alt="Card image cap">
        <div class="card-block">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 


// $stmt = $pdo->prepare("select username as id,image, email as email, user_id as parent_id,created_at from accounts WHERE status='1' order by created_at desc limit 8");
// $stmt->execute();
// // fetching rows into array
// $tree_data = $stmt->fetchAll();
// $rc=$stmt->rowCount();
 ?>


     





















                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
<h4 align="center"><?php echo $_SESSION['name']; ?></h4>
            <!-- Profile Image -->
            <div class="card card-danger card-outline">
              <div class="card-body box-profile">
<a href="profile.php" name="update" id="<?php echo $_SESSION['id'] ?>" class="btn btn-warning btn-xs update" style="float: right;">Edit Profile </a>
<br>
                <div class="text-center">

<div id="imgD">

<?php 
foreach ($accounts as $keySes) { 

echo "<img style='width:100%' src=admin/upload/".$keySes['image'].""?>

<?php } ?>
</div>

                    


                <p class="text-muted text-center">



<?php 
foreach ($accounts as $keySes) { 
echo "<h4>";
echo $keySes['first_name']." ";
echo $keySes['last_name'];
echo "</h4>";
echo $keySes['email'];

  ?>

<?php } ?>
                </p>
</div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


        
                    <p class="text-center">
                      



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

</body>
</html>
