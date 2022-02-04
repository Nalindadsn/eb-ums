<?php
include('db.php');
include('function.php');
$total=0;

$stmtAr = $pdo->prepare("SELECT * FROM accounts WHERE status=1");
$stmtAr->execute();
$accounts = $stmtAr->fetchAll(PDO::FETCH_ASSOC);
$stmtAr = $pdo->prepare("select username as id, email as email, user_id as parent_id,created_at from accounts WHERE status=1");
$stmtAr->execute();
// fetching rows into array
$tree_data = $stmtAr->fetchAll();


function formatMoney($money) {
    if($money<1) {
        $money='Rs. '.$money*100;
    }
    else {
        $dollars=intval($money);
        $cents=$money-$dollars;
        $cents=$cents*100;
        if ($cents>0) {
        $cents=$cents*100;
        }else{

        $cents="0".$cents*100;
        }
        $money='Rs. '.$dollars.'.'.$cents;
    }
    return $money;
}


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
///////////////end fun oo/




function fetch_recursivePro($tree_data, $currentid, $parentfound = false, $cats = array())
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
                $cats = array_merge($cats, fetch_recursivePro($tree_data, $row['id'], true));
        }
    }
    return $cats;
}
/////////////

function rc(){
global $pdo;
$query = "SELECT * FROM accounts";

$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$xx=0;
$aaa=0;
foreach($result as $row)
{


        $stmt3zzb = $pdo->prepare("SELECT sum(amount) AS sumV FROM payments WHERE user_id='".$row['username']."'");
        $stmt3zzb->execute();
        $dataArr3ZZb = $stmt3zzb->fetchAll(PDO::FETCH_ASSOC);
        $rcb=$stmt3zzb->rowCount();

                $azz=0;
        foreach ($dataArr3ZZb as $keyDt) {
           $azz =  $keyDt['sumV'];
        }

if ((ooo($row['username'])-$azz)>0) {
    $xx++;
    $aaa++;
}
$xx=0;
}

return $aaa;
}













$query = '';
$output = array();
$query .= "SELECT * FROM accounts ";
if(isset($_POST["search"]["value"]))
{
    $query .= 'WHERE first_name LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR username LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR email LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR idno LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR status LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$xx=0;
$aaa=0;
foreach($result as $row)
{





        $stmt3zzb = $pdo->prepare("SELECT sum(amount) AS sumV FROM payments WHERE user_id='".$row['username']."'");
        $stmt3zzb->execute();
        $dataArr3ZZb = $stmt3zzb->fetchAll(PDO::FETCH_ASSOC);
        $rcb=$stmt3zzb->rowCount();

                $azz=0;
        foreach ($dataArr3ZZb as $keyDt) {
           $azz =  $keyDt['sumV'];
        }



if (ooo($row['username'])-$keyDt['sumV']>0) {
    //$sub_array[] ="yes";
 


    $sub_array = array();



    $image = '';
    if($row["image"] != '')
    {

        $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
    }
    else
    {
        $image = '<img src="../img/user-profile.png" class="img-thumbnail" width="50" height="35" />';
    }
    $sub_array[] = $image;



    if ($row["nicF"]=='') {
    $sub_array[] =" <a class=' btn btn-warning btn-xs'><i class='fas fa-exclamation-triangle'></i> NIC Front</a>";
    }else{

    $sub_array[] =" <a class='btn btn-primary btn-xs ' href='nicF/".$row["nicF"]."'><i class='fa fa-check' aria-hidden='true'></i> NIC Front</a>";
    }


    if ($row["nicB"]=='') {
    $sub_array[] =" <a class=' btn btn-warning btn-xs'><i class='fas fa-exclamation-triangle'></i> NIC Back</a>";
    }else{

    $sub_array[] =" <a class='btn btn-primary btn-xs ' href='nicB/".$row["nicB"]."'><i class='fa fa-check' aria-hidden='true'></i> NIC Back</a>";
    }


    if ($row["bank"]=='') {
    $sub_array[] =" <a class=' btn btn-warning btn-xs'><i class='fas fa-exclamation-triangle'></i>  Pass Book</a>";
    }else{

    $sub_array[] =" <a class='btn btn-primary btn-xs ' href='bank/".$row["bank"]."'><i class='fa fa-check' aria-hidden='true'></i> Pass Book</a>";
    }



    $sub_array[] =  formatMoney(ooo($row['username']));


if ((ooo($row['username'])-$azz)>0) {
    $xx++;
    $aaa++;


}

    $sub_array[] = formatMoney($azz)."----".$xx."----".rc();
    $sub_array[] = ooo($row['username'])-$azz;


$xx=0;

$sub_array[] =$row['username']."<br><span class='badge badge-pill badge-secondary'>".$row['email']."</span><br>NIC : ".$row['idno'];


    $sub_array[] = $row["user_id"]. "<br> <a href='../view_tree.php?id=".$row["user_id"]."'>view tree</a>" ;
    $sub_array[] = $row["first_name"];
    $sub_array[] = $row["last_name"];
    //$sub_array[] = $row["status"];
    if ($row['status']==1) {
        # code...
        $sub_array[] = '<span class="badge badge-pill badge-success">Activated</span>';
    }
    else if ($row['status']=='0') {
        # code...
        $sub_array[] = '<span class="badge badge-pill badge-danger">  Not Activated</span>';
    }else{
    $sub_array[] = $row["status"];

    }

    
    $sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Activate</button>';
    $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';

    $data[] = $sub_array;
}
}
$output = array(
    "draw"              =>  intval($_POST["draw"]),
    "recordsTotal"      =>  $filtered_rows,
    "recordsFiltered"   =>  get_total_all_records(),
    "data"              =>  $data
);
echo json_encode($output);
?>