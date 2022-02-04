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



  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">





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
                <a href="noticePB.php" class="nav-link  active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pole Brakedown</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="noticeSW.php" class="nav-link ">
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
            <h1>Pole Breakdown</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Notice</li>
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
                <h3 class="card-title">Notice</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">








    <div class="">
      <div class="table-responsive">
        <br />
        <div align="right">
          <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-danger">+ Add New Note</button>
        </div>
        <br /><br />
        <table id="user_data" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th >Attachment</th>
              <th >Registration No</th>
              <th>Name</th>
              <th>Category</th>
              <th>address</th>
              <th>Mobile No</th>
              <th>Remark</th>
              <th>Created at</th>
              <th>Edit</th>
              <th>Delete</th>
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
          <h4 class="modal-title">Add New Notice</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <label>Enter Registration Number</label>
          <input type="text" name="registration_no" id="registration_no" class="form-control" />
          <br />
          <label>Enter Name</label>
          <input type="text" name="u_name" id="u_name" class="form-control" />
          <br />
          <label>Select category</label>
          <select  name="cat_id" id="cat_id" class="form-control" >

            <option value="PB">Pole Breackdown</option>
          </select>
          <br />
          <label>Enter address</label>
          <textarea name="address" id="address" class="form-control" ></textarea>
          <br />
          <label>Mobile No</label>
          <input type="Number" name="phone_no" id="phone_no" class="form-control" />
          <br />
          <label>Remarks</label>
          <input type="text" name="remarks" id="remarks" class="form-control" />
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


<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<script>
  $(function () {
    //Add text editor
    $('#description').summernote()
  })
</script>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
  $('#add_button').click(function(){
    $('#user_form')[0].reset();
    $('.modal-title').text("Add Note");
    $('#action').val("Add");
    $('#operation').val("Add");
    $('#user_uploaded_image').html('');
  });

  
  var dataTable = $('#user_data').DataTable({


      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    
    
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetchPB.php",
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
    var registration_no = $('#registration_no').val();
    var u_name = $('#u_name').val();
    var cat_id = $('#cat_id').val();
    var address = $('#address').val();
    var phone_no = $('#phone_no').val();
    var remarks = $('#remarks').val();
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
    if(registration_no != '' && u_name != '')
    {
      $.ajax({
        url:"insert1.php",
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
      url:"fetch_single1.php",
      method:"POST",
      data:{user_id:user_id},
      dataType:"json",
      success:function(data)
      {
        $('#userModal').modal('show');
        $('#registration_no').val(data.registration_no);
        $('#u_name').val(data.u_name);
        $('#cat_id').val(data.cat_id);
        $('#address').val(data.address);
        $('#phone_no').val(data.phone_no);
        $('#remarks').val(data.remarks);
        $('.modal-title').text("Edit Notice");
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
        url:"delete1.php",
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