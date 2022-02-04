<?php
include 'main.php';
$stmt = $pdo->prepare("SELECT * FROM accounts WHERE username='".$_SESSION['name']."'");
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);


check_loggedin($pdo);
// output message (errors, etc)
$msg = '';
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->execute([ $_SESSION['id'] ]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);
// Handle edit profile post data
if (isset($_POST['username'], $_POST['password'], $_POST['cpassword'], $_POST['email'])) {
  // Make sure the submitted registration values are not empty.
  if (empty($_POST['username']) || empty($_POST['email'])) {
    $msg = 'The input fields must not be empty!';
  } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $msg = 'Please provide a valid email address!';
  } else if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
      $msg = 'Username must contain only letters and numbers!';
  } else if (!empty($_POST['password']) && (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5)) {
    $msg = 'Password must be between 5 and 20 characters long!';
  } else if ($_POST['cpassword'] != $_POST['password']) {
    $msg = 'Passwords do not match!';
  }
  if (empty($msg)) {
    // Check if new username or email already exists in database
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM accounts WHERE (username = ? OR email = ?) AND username != ? AND email != ?');
    $stmt->execute([ $_POST['username'], $_POST['email'], $_SESSION['name'], $account['email'] ]);
    if ($result = $stmt->fetchColumn()) {
      $msg = 'Account already exists with that username and/or email!';
    } else {
      // no errors occured, update the account...
      $uniqid = account_activation && $account['email'] != $_POST['email'] ? uniqid() : $account['activation_code'];
      $stmt = $pdo->prepare('UPDATE accounts SET  password = ?, email = ?, activation_code = ? WHERE id = ?');
      // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
      $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $account['password'];
      $stmt->execute([ $password, $_POST['email'], $uniqid, $_SESSION['id'] ]);
      // Update the session variables
      $_SESSION['name'] = $_POST['username'];
      if (account_activation && $account['email'] != $_POST['email']) {
        // Account activation required, send the user the activation email with the "send_activation_email" function from the "main.php" file
        send_activation_email($_POST['email'], $uniqid);
        // Log the user out
        unset($_SESSION['loggedin']);
        $msg = 'You have changed your email address, you need to re-activate your account!';
      } else {
        // profile updated redirect the user back to the profile page and not the edit profile page
        header('Location: profile.php');
        exit;
      }
    }
  }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">


  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->



</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">  <!-- Navbar -->
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
            <a href="index.php" class="nav-link  ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                dashboard
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link active">
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
            <h1 class="m-0">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
            
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">











<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-danger card-outline">
              <div class="card-body box-profile">
<button type="button" name="update" id="<?php echo $_SESSION['id'] ?>" class="btn btn-warning btn-xs update" style="float: right;">Edit Profile </button>
<br>
                <div class="text-center">

<div id="imgD"></div>

                    

                <h3 class="profile-username text-center"><?php echo $_SESSION['name']; ?></h3>

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

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                 
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">

    <?php if (!isset($_GET['action'])): ?>
    <div class="content profile">
      <h2>Profile Page</h2>
      <div class="block">
        <p>Your account details are below:</p>
        <table>

          <tr>
            <td>Email:</td>
            <td><?=$account['email']?></td>
          </tr>
          <tr>
            <td>Role:</td>
            <td><?=$account['role']?></td>
          </tr>
        </table>
        <a class="profile-btn" href="profile.php?action=edit">Edit Details</a>
      </div>
    </div>
    <?php elseif ($_GET['action'] == 'edit'): ?>
    <div class="content profile">
      <div class="block">
        <form action="profile.php?action=edit" method="post">
          <label for="username">Username</label>
          <input class="form-control" type="text" value="<?=$_SESSION['name']?>" name="username" id="username" placeholder="Username">
          <label for="password">Password</label>
          <input class="form-control" type="password" name="password" id="password" placeholder="Password">
          <label for="cpassword">Confirm Password</label>
          <input class="form-control" type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
          <label for="email">Email</label>
          <input class="form-control" type="email" value="<?=$account['email']?>" name="email" id="email" placeholder="Email">
          <br>
          <input class="profile-btn btn btn-danger" type="submit" value="Save">
          <p style="color: red;"><?=$msg?></p>
        </form>
      </div>
    </div>
    <?php endif; ?>






<hr>


      <h2>NIC and Pass Book  <a class="btn " href="admin/verify.php" style="float: right;">- Edit</a></h2>



<div class="row">


  <div class="col-md-4">
    
<?php 
foreach ($accounts as $keySes) {
if($keySes['nicF']==""){

 ?>
          <img src="img/img.png" alt="User Image" style="background-color: #fff;width:100%;">
<?php   

if($keySes['idno']!=""){
echo "&nbsp;&nbsp;&nbsp;NIC : ".$keySes['idno'];
}

 ?>
  <?php
}else{

?>

          <img src="admin/nicF/<?php echo $keySes['nicF'] ?>" alt="User Image" style="width:100%;">

<?php

}
}
?>
  </div>
  <div class="col-md-4">
    

    
<?php 
foreach ($accounts as $keySes) {
if($keySes['nicB']==""){

 ?>
          <img src="img/img.png" alt="User Image" style="background-color: #fff;width:100%;">

  <?php
}else{

?>

          <img src="admin/nicB/<?php echo $keySes['nicB'] ?>" alt="User Image" style="width:100%;">

<?php

}
}
?>

  </div>

</div>









                    </div>
                    <!-- /.post -->

                    <!-- /.post -->

                    <!-- /.post -->
                  </div>


                 


                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

















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



                    <!-- /.chart-responsive -->
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
<script type="text/javascript" language="javascript" >



$(document).ready(function(){



    showAll();
    function showAll(){

    var keyword = "0";

  $.ajax({
    method: 'POST',
    url: 'admin/uimg.php',
    data:'request='+keyword,

    success: function(response){
      $('#imgD').html(response);


    }
  });
    }


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
      url:"admin/fetch.php",
      type:"POST"
    },


            dom: 'Bfrtip',
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
        url:"admin/insert.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          alert(data);
          $('#user_form')[0].reset();
          $('#userModal').modal('hide');
       
    showAll();
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
      url:"admin/fetch_single.php",
      method:"POST",
      data:{user_id:user_id},
      dataType:"json",
      success:function(data)
      {
        $('#userModal').modal('show');
        $('#first_name').val(data.first_name);
        $('#last_name').val(data.last_name);
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
        url:"admin/delete.php",
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