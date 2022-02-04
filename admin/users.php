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
  <!-- Navbar -->  <!-- Navbar -->
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
    <a href="../index.php" class="brand-link navbar-white">
      <span class="brand-text font-weight-light">





        <img src="../dist/img/logoceb.png" style="width: 80%;">




      </span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">



<?php 
foreach ($accounts as $keySes) {
if($keySes['image']==""){

 ?><br>
          <img src="../img/user-profile.png" class="img-circle elevation-2" alt="User Image" style="background-color: #fff;">

  <?php
}else{

?><br>

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



   " style="float: right;"> <?php echo $keySes['username']; ?></span><br>
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
            <a href="../index.php" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../profile.php" class="nav-link">
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
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-bell"></i>   
              <p>
                Notice
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="notice.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Notice</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="noticeMC.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Meter Changing</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="noticeWL.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>WAYLEVES</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="noticeLS.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Line Shifting</p>
                </a>
              </li>
              

              <li class="nav-item">
                <a href="noticePS.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pole Shifting</p>
                </a>
              </li>
              

              <li class="nav-item">
                <a href="noticePB.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pole Brakedown</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="noticeSW.php" class="nav-link  active ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service Wayer</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="noticeCU.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cutouts</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="noticeMB.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Meter Box</p>
                </a>
              </li>
              

              <li class="nav-item">
                <a href="noticeOT.php" class="nav-link ">
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
            <h1>All Users</h1>
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
          <a href="../adminNew.php"  class="btn btn-danger btn-lg">+ Register Admin</a>
        </div>
        <br /><br />
        <table id="user_data" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="10%">Image</th>
              <th width="15%">nic front</th>
              <th width="15%">nic Back</th>
              <th width="35%">Username</th>
              <th width="35%">First Name</th>
              <th width="35%">Last Name</th>
              <th width="35%">Status</th>
              <th width="10%">Edit</th>
              <th width="10%">Delete</th>
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
          <label>Enter First Name</label>
          <input type="text" name="first_name" id="first_name" class="form-control" />
          <br />
          <label>Enter Last Name</label>
          <input type="text" name="last_name" id="last_name" class="form-control" />
          <br />

          <input type="hidden" name="status" value="1">
          <br />
          <label>Select User Image</label>
          <input type="file" name="user_image" id="user_image" />
          <span id="user_uploaded_image"></span>
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


      "paging": true,
      "lengthChange": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch.php",
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
        url:"insert.php",
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
      url:"fetch_single.php",
      method:"POST",
      data:{user_id:user_id},
      dataType:"json",
      success:function(data)
      {
        $('#userModal').modal('show');
        $('#first_name').val(data.first_name);
        $('#last_name').val(data.last_name);
        $('#status').val(data.status);
        $('.modal-title').text("Edit User");
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