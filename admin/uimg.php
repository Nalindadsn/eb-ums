<style type="text/css">

<style type="text/css">
  .tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
</style><?php
include '../main.php';



$stmt = $pdo->prepare("SELECT * FROM accounts WHERE username='".$_SESSION['name']."'");
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($accounts as $key ) {
  if ($key['image']=='') {
    ?>


<img src="img/user-profile.png" style="width: 100%; max-width: 150px;"><br>

    <?php
  }else{
    ?>


<img style="width: 100%" src="admin/upload/<?php echo $key['image']; ?>"><br>
    <?php
  }
  ?>

  <?php


  if ($key['status']==1) {
    ?>

<span class="badge rounded-pill bg-success">Activated</span>
    <?php
  }else{
    ?>
<span class="badge rounded-pill bg-success">Activated</span>

    <?php
  }
}
?>