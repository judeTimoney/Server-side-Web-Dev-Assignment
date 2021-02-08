
<?php
//file for initially loading data to the database

include("db.php");

$file = fopen("IKEA_SA_Furniture.csv", "r");

//read and discard first line of csv file, containing column names
$line = fgetcsv($file);


while (($line = fgetcsv($file)) !== FALSE) {

    print_r($line);
    print_r("");
    $num_id = $line[0];
    $item_id = $line[1];
    $item_name = $line[2];

    $category = $line[3];
    $category = str_replace('\'', '\\\'', $category);
    $price = $line[4];
    $old_price = $line[5];
    $sold_online = $line[6];

    $b_sold_online = 0;
    if ($sold_online = "TRUE") {
        $b_sold_online = 1;
    }

    $link = $line[7];
    $other_colours = $line[8];

    $b_other_colours = 0;
    if ($other_colours = "Yes") {
        $b_other_colours = 1;
    }
    $short_desc =  $line[9];
    $short_desc = str_replace('\'', '\\\'', $short_desc);



    $designer = $line[10];
    $designer = str_replace('\'', '\\\'', $designer);


    $insertSQL = "INSERT INTO IKEAstock (num_id, item_id, item_name, category, price, old_price, sold_online,
                                         link, other_colours, short_desc, designer) VALUES 
                                         ($num_id, '$item_id', '$item_name', '$category', '$price', '$old_price', 
                                         '$b_sold_online', '$link', '$b_other_colours', '$short_desc', '$designer')";


    $result = $conn->query($insertSQL);

    if (!$result) {
        echo "<br>Something wrong  " . $conn->error;
        echo "<br><br>";
    } else {
        echo "don't refresh page if you see this message<br>";
    }
}

?>