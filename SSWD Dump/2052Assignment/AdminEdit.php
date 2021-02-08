<?php
//contains form for admin to edit products
include("RESTclient/restclient.php");
include("FrontEndUtils/security/AdminBasicAuth.php");

$chosenitem = isset($_GET['param1']) ? $_GET['param1'] : die();


$stockitem = getOneStockItemFromRest($chosenitem);




echo "<!DOCTYPE html>
<head>

<meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css\" integrity=\"sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2\" crossorigin=\"anonymous\">


<h1>ADMIN: Edit Profile</h1>
<body>";

echo "<form action=\"FrontEndAdmin.php\"> 
    
    
  <div class =\"form-group\">      
  <input type=\"hidden\" class=\form-control\" id=\"num_id\" name=\"num_id\" value=\"$stockitem->num_id\"><br>
  <input type=\"hidden\" id=\"link\" name=\"link\" value=\"$stockitem->link\"><br>
  </div>

  <div class =\"form-group\">  
  <label for=\"item_id\">Item ID: </label> <br>
  <input type=\"text\" id=\"item_id\" name=\"item_id\" value=\"$stockitem->item_id\"><br>
  </div>

  <div class =\"form-group\">
  <label for=\"item_name\">Item Name: </label> <br>
  <input type=\"text\" id=\"item_name\" name=\"item_name\" value=\"$stockitem->item_name\"><br>
  </div>

  <div class =\"form-group\">
  <label for=\"category\">Category: </label> <br>
  <input type=\"text\" id=\"category\" name=\"category\" value=\"$stockitem->category\"><br><br>
  </div>

  <div class =\"form-group\">
  <label for=\"price\">Price:</label><br>
  <input type=\"text\" id=\"price\" name=\"price\" value=\"$stockitem->price\"><br><br>
  </div>

  <div class =\"form-check\">
  <label for=\"sold_online\">Sold Online:</label><br>
  <input type=\"checkbox\" class=\"form-check-input\" id=\"sold_online\" name=\"sold_online\" value=\"$stockitem->sold_online\"><br><br>
  </div>

  <div class =\"form-check\">
  <label for=\"other_colours\">Other Colours: </label> <br>
  <input type=\"checkbox\" class=\"form-check-input\" id=\"other_colours\" name=\"other_colours\" value=\"$stockitem->other_colours\"><br><br>
  </div>

  <div class =\"form-group\">
  <label for=\"short_desc\">Description: </label> <br>
  <input type=\"text\" id=\"short_desc\" name=\"short_desc\" value=\"$stockitem->short_desc\"><br><br>
  </div>

  <button type = \"submit\" formaction=\"formaction.php\" formmethod=\"post\"> Save </button>
  <button type = \"submit\" > Cancel </button> 
</form>  

</body>
</head>
";
