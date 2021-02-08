<?php
//read table function used in both front end pages
//contains uptdate button with link to AdminEdit
function readmytable()
{

    include("../RESTclient/restclient.php");

    include("db.php");

    $readSQL = " SELECT * FROM IKEAstock ";
    $chosenitem;

    $resultread = $conn->query($readSQL);

    if (!$resultread) {
        echo "Something went wrong." . $conn->error;
    }

    echo " <table class='table'> 
                    <thead>
                        <tr>
                            <th scope='col'>Item Number</th>
                            <th scope='col'>Item ID</th> 
                            <th scope='col'>Item Name</th>
                            <th scope='col'>Category</th>
                            <th scope='col'>Price</th>
                            <th scope='col'>Sold Online</th>
                            <th scope='col'>Other Colours</th>
                            <th scope='col'>Description</th>
                            <th scope='col'>Update Stock</th>
                        </tr>
                    </thead>
                    <tbody id=\"stocktable\">
                ";




    while ($row = $resultread->fetch_assoc()) {
        $num_id = $row["num_id"];
        $item_id = $row["item_id"];
        $item_name = $row["item_name"];
        $category = $row["category"];
        $price = $row["price"];
        $sold_online = $row["sold_online"];
        $link = $row["link"];
        $other_colours = $row["other_colours"];
        $short_desc = $row["short_desc"];

        echo "<tr> 
                    <th scope = 'row'>$num_id</th>
                    <td>$item_id</td>
                    <td> <a href=\"$link\">$item_name</a> </td>
                    <td>$category</td>
                    <td>$price</td>
                    <td>$sold_online</td>  
                    <td>$other_colours</td>
                    <td>$short_desc</td>
                    <td> <a href=\"AdminEdit.php?param1=$num_id\">Update </a> </td>
                    </tr>
                ";
    }


    echo "</tbody></table>";
}
