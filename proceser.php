<?php

include 'main.php';

if(isset($_POST['username'])){
   $username = $_POST['username'];

   // Check username
   $stmt = $pdo->prepare("SELECT count(*) as cntUser FROM accounts WHERE username=:username");
   $stmt->bindValue(':username', $username, PDO::PARAM_STR);
   $stmt->execute(); 
   $count = $stmt->fetchColumn();

   $response = "<div style='color: green;'>Available.</div>";
   if($count > 0){
      $response = "<div style='color: red;'>Not Available.</div>";
   }
   echo $response;
   exit;
}