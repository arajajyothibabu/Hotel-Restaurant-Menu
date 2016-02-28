<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require_once("includes/connection.php"); ?>
<?php 
$message = "";
?>
<?php include 'includes/header.php'; ?>
<div class="row">
    <div class="col-md-12">
        <h3 style="font-style: italic;">Update Item</h3>
        <?php if(isset($message)) echo '<h4 align="center" style="color:#F00; background-color:#FFF">'.$message.'</h4>';?>
    </div>
</div>
<hr>
<div class="row">
    <form role="form" class="" method="post" action="search.php" enctype='multipart/form-data'>
    <div class="col-md-5">
        <div class="form-group">
            <input type="text" list="names" id="name" class="form-control" name="q" value="" placeholder="Enter Item Name">
            <datalist id="names">
                <?php 
                $names = mysql_query("select name from items") or die(mysql_error());
                while($name = mysql_fetch_array($names))
                {
                    echo '<option>'.$name[0].'</option>';
                }
                ?>
            </datalist>
        </div>
    </div>
    <div class="col-md-5">
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
    <div class="col-md-2">
        <div class="form-group">
            <input type="submit" class="form-control bg-success" value="Search" name="search">
        </div>
    </div>
    </form>
</div>
<hr>
<?php 
if(isset($_POST['search']))
{
    $name = $_POST['q'];
    $type = $_POST['type'];
    if(!empty($type))
        $query = mysql_query("select * from items where type='$type'");
    else if(!empty($name))
        $query = mysql_query("select * from items where name = '$name'");
    else
        $msg = "Please enter something to search..!";
    if(isset($query))
    {
        echo '<table width="100%" class="table-responsive table-bordered">
            <thead>
                <tr>
                    <th>Sno.</th><th>Name</th><th>Price</th><th>Size/Quantity</th><th>Pic</th>
                </tr>
            </thead><tbody>';
        $i = 1;
        while($item = mysql_fetch_array($query))
        {
            echo '<tr><td><a href="update.php?id='.$item[0].'"><table width="100%" class="table-responsive table-bordered"><tr>
                    <td>'.$i.'</td><td>'.$item[1].'</td><td>'.$item[3].'</td><td>'.$item[4].'</td><td><img class="img-responsive" src="showimage.php?id='.$item[0].'"></td>
                </tr><table></a></td></tr>';
            $i++;
        }
        if($i == 1)
            $msg = "No items found";
        else
            echo '</tbody></table>';
    }
}
?>
<?php if(isset($msg)) echo '<h4 align="center" style="color:#F00; background-color:#FFF">'.$msg.'</h4>';?>
<?php include 'includes/footer.php'; ?>