<?php
//read table function used in both front end pages
function readmytable(){

    include("RESTclient/restclient.php");

    $myStockList = (array) getAllStockItemsFromRest();

    echo " <table class='table'> 
                    <thead class='thead-dark'>
                        <tr>
                            <th scope='col'>Item Number</th>
                            <th scope='col'>Item ID</th> 
                            <th scope='col'>Item Name</th>
                            <th scope='col'>Category</th>
                            <th scope='col'>Price</th>
                            <th scope='col'>Sold Online</th>
                            <th scope='col'>Other Colours</th>
                            <th scope='col'>Description</>
                        </tr>
                    </thead>
                    <tbody id=\"stocktable\">
                ";

                // iterate through array and assign variables like in functions

                $count = count($myStockList["records"]);
                for ($i = 0; $i < $count; $i++) {

                    $row = (array) $myStockList["records"][$i];

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
                    </tr>
                ";
                }

            
            echo "</tbody></table>";


}
