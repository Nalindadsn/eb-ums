<?php include '../main.php';
$stmt = $pdo->prepare("SELECT * FROM accounts WHERE username='".$_SESSION['name']."'");
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
  <head>
    <title>Users</title>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">



    <style>
      body
      {
        margin:0;
        padding:0;
        background-color:#f1f1f1;
      }
      .box
      {
        width:1270px;
        padding:20px;
        background-color:#fff;
        border:1px solid #ccc;
        border-radius:5px;
        margin-top:25px;
      }
    </style>
  </head>
  <body  class="hold-transition sidebar-mini">






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
        <a href="../index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="products.php" class="nav-link">Products</a>
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
    <a href="../index.php" class="brand-link navbar-navy">
      <span class="brand-text font-weight-light"><img src="../dist/img/AdminLTELogo3.png" style="width: 80%;"></span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">



<?php 
foreach ($accounts as $keySes) {
if($keySes['image']==""){

 ?>
          <img src="../img/user-profile.png" class="img-circle elevation-2" alt="User Image" style="background-color: #fff;">

  <?php
}else{

?>

          <img src="upload/<?php echo $keySes['image'] ?>" class="img-circle elevation-2" alt="User Image">

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


          <a href="../profile.php" class="d-block">


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
            <a href="../index.php" class="nav-link  active ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../tree.php" class="nav-link">
   
              <i class="fas fa-network-wired"></i>         
              <p>
                 &nbsp;&nbsp;Genealogy
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../compose.php" class="nav-link ">

              <i class="nav-icon fas fa-envelope"></i>              
              <p>
                Contact
                
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="verify.php" class="nav-link ">

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
            <a href="products.php" class="nav-link ">

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
                <a href="users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="member_list.php" class="nav-link">
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
                <a href="../userBalance.php" class="nav-link">
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
                <a href="../transactions.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Transactions</p>
                </a>
              </li>

              


            </ul>
          </li>

          <li><hr></li>
          <li class="nav-item">
            <a href="../logout.php" class="nav-link " style="background-color: #d81b60;color: #fff;">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Members</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">







    <div class="">
      <div class="table-responsive">
        <br />
        <div align="right">
          <a href="../admin_newUser.php"  class="btn btn-danger btn-lg">+ Register Member</a>
          <a href="../admin_newUser2.php"  class="btn btn-danger btn-lg">+ Register Admin</a>
        </div>
        <br /><br />
        <table id="user_data" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="35%">Username</th>
              <th width="35%">direct referral</th>
              <th width="35%">users</th>
              <th width="35%">Total</th>
              <th width="35%">Bank</th>
              <th width="35%">Branch</th>
              <th width="35%">Account No</th>
              <th width="35%">Total Points </th>
              <th width="35%">Paid  </th>
              <th width="35%">Balance</th>
              <th width="35%"></th>
              <th width="35%">Status</th>
              <th width="10%">Payment</th>
            </tr>
          </thead>
        </table>
        
      </div>
    </div>





              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

























  </body>



</html>

<div id="userModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="user_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add User</h4>
        </div>
        <div class="modal-body">
          <label>UserName </label>
          <input type="text" name="first_name" id="first_name" class="form-control" readonly="" />
          <br />
          <label>Amount</label>
          <input type="text" name="last_name" id="last_name" class="form-control" />
          <br />
          <label style="display: none;">Select User Image</label>
          <input style="display: none;" type="file" name="user_image" id="user_image" />
          <span style="display: none;" id="user_uploaded_image"></span>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="user_id" id="user_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<script type="text/javascript" language="javascript" >



$(document).ready(function(){
  $('#add_button').click(function(){
    $('#user_form')[0].reset();
    $('.modal-title').text("Add User");
    $('#action').val("Add");
    $('#operation').val("Add");
    $('#user_uploaded_image').html('');
  });
  
  var dataTable = $('#user_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch_bal.php",
      type:"POST"
    },
      dom: 'Bfrtip',

"lengthMenu":[[10,25,50,-1],[10,25,50,"All"]],

      buttons: ['copy','csv','excel','pdf','print'],
    "columnDefs":[
      {
        "targets":[0, 3, 4],
        "orderable":false,
      },




    ],





  });

  $(document).on('submit', '#user_form', function(event){
    event.preventDefault();
    var firstName = $('#first_name').val();
    var lastName = $('#last_name').val();
    var lastName = $('#status').val();
    var extension = $('#user_image').val().split('.').pop().toLowerCase();
    if(extension != '')
    {
      if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
      {
        alert("Invalid Image File");
        $('#user_image').val('');
        return false;
      }
    } 
    if(firstName != '' && lastName != '')
    {
      $.ajax({
        url:"insert_bal.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          alert(data);
          $('#user_form')[0].reset();
          $('#userModal').modal('hide');
          dataTable.ajax.reload();
        }
      });
    }
    else
    {
      alert("Both Fields are Required");
    }
  });
  
  $(document).on('click', '.update', function(){
    var user_id = $(this).attr("id");
    $.ajax({
      url:"fetch_single_bal.php",
      method:"POST",
      data:{user_id:user_id},
      dataType:"json",
      success:function(data)
      {
        $('#userModal').modal('show');
        $('#first_name').val(data.first_name);
        $('#last_name').val(data.last_name);
        $('.modal-title').text("Payment");
        $('#user_id').val(user_id);
        $('#user_uploaded_image').html(data.user_image);
        $('#action').val("Edit");
        $('#operation').val("Edit");
      }
    })
  });
  
  $(document).on('click', '.delete', function(){
    var user_id = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"delete.php",
        method:"POST",
        data:{user_id:user_id},
        success:function(data)
        {
          alert(data);
          dataTable.ajax.reload();
        }
      });
    }
    else
    {
      return false; 
    }
  });
  
  
});
</script>

<script>
</script>