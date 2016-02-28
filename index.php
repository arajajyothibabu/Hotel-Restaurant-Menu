<?php require_once 'includes/connection.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
class Item
{
    var $name;
    var $type;
    var $price;
    var $size;
    var $pic;
    function Item($name = "itemName", $type = "itemType", $price = "0", $size = "0", $id = "")
    {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->size = $size;
        $this->pic = $id;
        echo    '<div class="row" id="item">
                    <div class="col-xs-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">'.$name .'</div>
                            <div class="panel-body">
                                <div class="price">'. $price .'/'.$size.' pcs</div>
                                <img class="img-responsive" src="showimage.php?id='. $id . '">
                            </div>
                        </div>
                    </div>
                </div>';
    }
}
?>
<?php 
$items = mysql_query("select * from items") or die(mysql_error());
while($item = mysql_fetch_array($items))
{
    $newItem = new Item($item[1],$item[2],$item[3],$item[4],$item[0]);
}
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include 'includes/footer.php'; ?>
