<?php
//implemented based on code found at https://codeofaninja.com/2017/02/create-simple-rest-api-in-php.html
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

//add basic auth requirement for this page
include '../security/apiBasicAuth.php';

// include database and object files
include_once '../db.php';
include_once '../objects/stockitem.php';

// initialize object with the db connection
$stockitem = new StockItem($conn);

// set ID property of record to read
// get the id from the URL
$stockitem->num_id = isset($_GET['num_id']) ? $_GET['num_id'] : die();

// read the details of one stock item
$stockitem->readOne();

if ($stockitem->item_name != null) {
    // create array
    $stockitem_arr = array(
        "num_id" => $stockitem->num_id,
        "item_id" => $stockitem->item_id,
        "item_name" => $stockitem->item_name,
        "category" => $stockitem->category,
        "price" => $stockitem->price,
        "sold_online" => $stockitem->sold_online,
        "link" => $stockitem->link,
        "other_colours" => $stockitem->other_colours,
        "short_desc" => $stockitem->short_desc
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($stockitem_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Item does not exist."));
}
