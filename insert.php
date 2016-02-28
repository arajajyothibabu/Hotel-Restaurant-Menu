<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require_once("includes/connection.php"); ?>
<?php 
$message = "";
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $type = $_POST['type'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    if(isset($_FILES['pic']))
    {
        if($_FILES["pic"]["size"] != 0) 
        {						  
            $imageName = mysql_real_escape_string($_FILES["pic"]["name"]);
            $imageData = mysql_real_escape_string(file_get_contents($_FILES["pic"]["tmp_name"]));
            $imageType = mysql_real_escape_string($_FILES["pic"]["type"]);
                if($_FILES["pic"]["type"] == "image/jpeg" || $_FILES["pic"]["type"] == "image/gif" || $_FILES["pic"]["type"] == "image/png" && $_FILES["pic"]["size"] < 2120000)
                { 
                    $pic = $imageData;		
                }
                else
                {
                    $message = "Only images(.jpg/.jpeg) are allowed or image size must be less than 500KB..!";
                    $pic = "";
                }
        }
    }
    else
    {
        $pic = "";
    }
    
    $insertDetails = mysql_query("INSERT into items values('', '$name', '$type', '$price', '$size', '$pic')") or die(mysql_error());
    if($insertDetails)
        $message .= "<br>Successfully added..!";
    else
        $message .= "<br>Something went wrong. Try again..!";
}
?>
<?php include 'includes/header.php'; ?>
<div class="row">
    <div class="col-md-12">
        <h3 style="font-style: italic;">Add New Item</h3>
        <?php if(isset($message)) echo '<h4 align="center" style="color:#F00; background-color:#FFF">'.$message.'</h4>';?>
    </div>
</div>
<hr>
<div class="row">
    <form role="form" class="" method="post" action="" enctype='multipart/form-data'>
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" class="form-control" name="name" required value="" placeholder="Item Name">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <select name="type" class="form-control">
                <option value="">--Type of Item--</option>
                <?php 
                $typeQuery = mysql_query("select * from types") or die(mysql_errno());
                while($types = mysql_fetch_array($typeQuery))
                        echo '<option value="'.$types[1].'">'.$types[1].'</option>';
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="number" value="0" required class="form-control" placeholder="Price" name="price">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">&nbsp;</div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" class="form-control" required name="size" value="" placeholder="Size/Quantity">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="file" name="pic" class="form-control bg-warning">
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<hr>
<div class="row">
    <div class="col-md-2">&nbsp;</div>
    <div class="col-md-8">
        <div class="form-group">
            <input type="submit" name="submit" class="form-control bg-success" value="Add Item"> 
        </div>
    </div>
    <div class="col-md-2">&nbsp;</div>
</div>
<?php include 'includes/footer.php'; ?>
