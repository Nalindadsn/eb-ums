<?php
include('db.php');
include('function.php');

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


 $total+=($n*$pV);
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
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $pdo->prepare(
		"SELECT * FROM accounts 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();














	foreach($result as $row)
	{


        $stmt3zzb = $pdo->prepare("SELECT sum(amount) AS sumV FROM payments WHERE user_id='".$row['username']."' LIMIT 1");
        $stmt3zzb->execute();
        $dataArr3ZZb = $stmt3zzb->fetchAll(PDO::FETCH_ASSOC);
        $rcb=$stmt3zzb->rowCount();
        foreach ($dataArr3ZZb as $keyDt) {
           $key_dt =   $keyDt['sumV'];
        }




		$output["first_name"] = $row["username"];
		$output["last_name"] = ooo($row['username'])-$keyDt['sumV'];
		$output["status"] = $row["status"];
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>