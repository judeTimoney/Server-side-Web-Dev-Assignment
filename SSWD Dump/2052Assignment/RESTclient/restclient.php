
<?php

// Method: POST, PUT, GET etc

//api code from https://stackoverflow.com/questions/9802788/call-a-rest-api-in-php -- code has since been adapted
function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            //curl_setopt($curl, CURLOPT_PUT, 1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // the rest api expects basic authentication from the client
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "apiuser:apipass");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
}

function getAllStockItemsFromRest()
{
    //gets the full set of available stock
    $stockjson = CallAPI("GET", "http://jtimoney03.sites.eeecs.qub.ac.uk/2052Assignment/api/stockitem/read.php", 0);
    $stocklist = json_decode($stockjson);
    return $stocklist;
}

function getOneStockItemFromRest($num_id)
{
    // get a single item identified by the num_id
    $data = array(
        "num_id" => $num_id
    );
    $stockjson = CallAPI("GET", "http://jtimoney03.sites.eeecs.qub.ac.uk/2052Assignment/api/stockitem/readOne.php", $data);
    $stocklist = json_decode($stockjson);
    return $stocklist;
}

function updateStockItemUsingRest($dataarray)
{
    // update a single item identified by the num_id
    $data = json_encode($dataarray);
    $stockjson = CallAPI("PUT", "http://jtimoney03.sites.eeecs.qub.ac.uk/2052Assignment/api/stockitem/update.php", $data);
    $stocklist = json_decode($stockjson);
    return $stocklist;
}



?> 