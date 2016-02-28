<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Item
 *
 * @author Araja Jyothi Babu
 */
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
        echo    '<div class="row">
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
