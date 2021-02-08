<?php
//implemented based on code found at https://codeofaninja.com/2017/02/create-simple-rest-api-in-php.html
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//add basic auth requirement for this page  
include '../security/apiBasicAuth.php';

// include database and object files
include_once '../db.php';
include_once '../objects/stockitem.php';


// initialize object with the db connection
$stockitem = new StockItem($conn);

// query the db for stock items
$query_result = $stockitem->read();
$num = $query_result->num_rows;

// check if more than 0 record found
if ($num > 0) {

    // create an array for the output
    $stockitems_arr = array();
    $stockitems_arr["records"] = array();

    // retrieve our table contents
    while ($row = $query_result->fetch_assoc()) {

        $stockitem_item = array(
            "num_id" => $row["num_id"],
            "item_id" => $row["item_id"],
            "item_name" => $row["item_name"],
            "category" => $row["category"],
            "price" => $row["price"],
            "sold_online" => $row["sold_online"],
            "link" => $row["link"],
            "other_colours" => $row["other_colours"],
            "short_desc" => $row["short_desc"]
        );
        // add array describing the item to the main array
        array_push($stockitems_arr["records"], $stockitem_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show stock items data in json format
    echo json_encode($stockitems_arr);
} else {
    // set response code - 404 Not found, as no rows returned/
    http_response_code(404);

    // tell the user no stock items found
    echo json_encode(
        array("message" => "No items found.")
    );
}
