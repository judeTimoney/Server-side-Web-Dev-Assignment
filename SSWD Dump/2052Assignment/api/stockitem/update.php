<?php
//implemented based on code found at https://codeofaninja.com/2017/02/create-simple-rest-api-in-php.html
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//add basic auth requirement for this page
include '../security/apiBasicAuth.php';

// include database and object files
include_once '../db.php';
include_once '../objects/stockitem.php';


// initialize object with the db connection
$stockitem = new StockItem($conn);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
// set ID property of product to be edited
$stockitem->num_id = $data->num_id;

// set product property values
$stockitem->num_id = $data->num_id;
$stockitem->item_id = $data->item_id;
$stockitem->item_name = $data->item_name;
$stockitem->category = $data->category;
$stockitem->price = $data->price;
$stockitem->sold_online = $data->sold_online;
$stockitem->link = $data->link;
$stockitem->other_colours = $data->other_colours;
$stockitem->short_desc = $data->short_desc;

// update the product
if ($stockitem->update()) {

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Stock item was updated."));
}

// if unable to update the product, tell the user
else {

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update stock item."));
}
