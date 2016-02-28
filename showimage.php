<?php require_once("includes/connection.php"); ?>
<?php 
$id = $_GET['id'];
$imageData = "";
	
if($id != "")
{
    $query = mysql_query("select * from items where sno = '$id'") or die(mysql_error());	
        $qr = mysql_fetch_array($query);
            $imageData = $qr['pic'];
}
if(empty($imageData))
{
    $query = mysql_query("select * from admin where sno = '1'") or die(mysql_error());	
        while($qr = mysql_fetch_array($query))
        {
            $imageData = $qr[1];
        }	
}
header("content-type: image/jpeg");
echo $imageData;
?>