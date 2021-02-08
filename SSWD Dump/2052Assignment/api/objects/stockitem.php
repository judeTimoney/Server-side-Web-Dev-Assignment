<?php
class StockItem
{

    // database connection and table name
    private $conn;
    private $table_name = "IKEAstock";

    // object properties
    public $num_id;
    public $item_id;
    public $item_name;
    public $category;
    public $price;
    public $sold_online;
    public $link;
    public $other_colours;
    public $short_desc;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {

        $readSQL = " SELECT * FROM IKEAstock ";

        $resultread = $this->conn->query($readSQL);

        return $resultread;
    }
    //function to read single item from database
    function readOne()
    {

        $readSQL = " SELECT num_id,item_id,item_name,category,price,sold_online,link,other_colours,short_desc FROM IKEAstock WHERE num_id = ?";
        $stmt = $this->conn->prepare($readSQL);
        $stmt->bind_param("i", $this->num_id);
        $stmt->execute();
        $stmt->bind_result(
            $this->num_id,
            $this->item_id,
            $this->item_name,
            $this->category,
            $this->price,
            $this->sold_online,
            $this->link,
            $this->other_colours,
            $this->short_desc
        );
        $resultread = $stmt->fetch();
        return $this;
    }
    //function to update stock in database
    function update()
    {

        // update query
        $query = "UPDATE IKEAstock SET item_id = ?,
                                        item_name = ?,
                                        category = ?,
                                        price = ?,
                                        sold_online = ?,
                                        link = ?,
                                        other_colours = ?,
                                        short_desc = ?
                                        WHERE
                                        num_id = ?";

        // prepare query statement
        if ($stmt = $this->conn->prepare($query)) {
            // clean the input from special characters
            $this->num_id = htmlspecialchars(strip_tags($this->num_id));
            $this->item_id = htmlspecialchars(strip_tags($this->item_id));
            $this->item_name = htmlspecialchars(strip_tags($this->item_name));
            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->sold_online = htmlspecialchars(strip_tags($this->sold_online));
            $this->link = htmlspecialchars(strip_tags($this->link));
            $this->other_colours = htmlspecialchars(strip_tags($this->other_colours));
            $this->short_desc = htmlspecialchars(strip_tags($this->short_desc));


            // bind new values
            $stmt->bind_param(
                'issiisisi',
                $this->item_id,
                $this->item_name,
                $this->category,
                $this->price,
                $this->sold_online,
                $this->link,
                $this->other_colours,
                $this->short_desc,
                $this->num_id
            );

            // execute the query
            if ($stmt->execute()) {
                return true;
            }

            return false;
        } else {
            $error = $this->conn->errno . ' ' . $this->conn->error;
            echo $error;
        }
        return false;
    }
}
