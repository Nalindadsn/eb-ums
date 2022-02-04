
<table class="table table-hover table-striped">
  <tbody>


<?php

//fetch_comment.php
include 'main.php';





$stmt = $pdo->prepare("SELECT * FROM accounts WHERE username='".$_SESSION['name']."'");
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($accounts as $keyD) {
  if ($keyD['role']=="Admin") {

$query = "
SELECT * FROM tbl_comment 
WHERE  parent_comment_id = '0' 
ORDER BY comment_id DESC LIMIT 30
";

  }
  if ($keyD['role']=="Member") {

$query = "
SELECT * FROM tbl_comment 
WHERE user_id='".$_SESSION['name']."' AND parent_comment_id = '0' 

ORDER BY comment_id DESC LIMIT 30

";
  }
}


$statement = $pdo->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';




foreach($result as $row)
{




// $query1 = "
// SELECT * FROM accounts 
// WHERE username='".$_SESSION['name']."'
// ";
//   }

// $statement = $pdo->prepare($query1);

// $statement->execute();

// $result = $statement->fetchAll();





 $output .= '

                  <tr style="border-left:4px solid #333">
                    <td class="mailbox-name"><a href="userProfile.php?id='.$row["user_id"].'"><i class="fa fa-user"></i> '.$row["user_id"].'</a><br>


<b>'.$row["comment_sender_name"].'</b>
                    </td>
                    <td class="mailbox-subject">'.$row["comment"].'
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">'.$row["date"].'<button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'" style="float:right">Reply</button></td>
                  </tr>


 ';
 $output .= get_reply_comment($pdo, $row["comment_id"]);
}

echo $output;

function get_reply_comment($pdo, $parent_id = 0, $marginleft = 0)
{

 $query = "
 SELECT * FROM tbl_comment WHERE parent_comment_id = '".$parent_id."'
 ";
 $output = '';
 $statement = $pdo->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 20;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {

   $output .= '



                  <tr style="border-left:'.$marginleft.'px solid #ccc">
                    <td class="mailbox-name"><a href="userProfile.php?id='.$row["user_id"].'"><i class="fa fa-user"></i> '.$row["user_id"].'</a><br>


<b>'.$row["comment_sender_name"].'</b>
                    </td>
                    <td class="mailbox-subject">'.$row["comment"].'
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">'.$row["date"].'<button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'" style="float:right">Reply</button></td>
                  </tr>


   ';
   $output .= get_reply_comment($pdo, $row["comment_id"], $marginleft);
  }
 }
 return $output;
}


?>

                  </tbody>
                </table>