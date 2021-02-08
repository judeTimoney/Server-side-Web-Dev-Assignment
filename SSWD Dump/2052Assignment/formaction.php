<?php
//security imported
include("FrontEndUtils/security/AdminBasicAuth.php");

//retrieve parameters from POST as input to update database
$num_id = isset($_POST['num_id']) ? $_POST['num_id'] : NULL;
$item_id = isset($_POST['item_id']) ? $_POST['item_id'] : NULL;
$item_name = isset($_POST['item_name']) ? $_POST['item_name'] : NULL;
$category = isset($_POST['category']) ? $_POST['category'] : NULL;
$price = isset($_POST['price']) ? $_POST['price'] : NULL;
$sold_online = isset($_POST['sold_online']) ? $_POST['sold_online'] : NULL;
$link = isset($_POST['link']) ? $_POST['link'] : NULL;
$other_colours = isset($_POST['other_colours']) ? $_POST['other_colours'] : NULL;
$short_desc = isset($_POST['short_desc']) ? $_POST['short_desc'] : NULL;



include("RESTclient/restclient.php");
$stockitem = array(
    "num_id" => $num_id,
    "item_id" => $item_id,
    "item_name" => $item_name,
    "category" => $category,
    "price" => $price,
    "sold_online" => $sold_online,
    "link" => $link,
    "other_colours" => $other_colours,
    "short_desc" => $short_desc
);
$testresult = updateStockItemUsingRest($stockitem);

header("Location: FrontEndAdmin.php");
