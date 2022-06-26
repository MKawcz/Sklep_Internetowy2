<?php

// use to fetch product data
class Product
{
    public $db = null;

    public function __construct(DBController $db){
        if(!isset($db->con)) return null;
        $this->db = $db;
    }

    // fetch product data using getData Method
    public function getData($table = 'product'){
        $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array();

        // fetch product data on by one
        while ($item = $result->fetch(PDO::FETCH_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // get product using item id
    public function getProduct($item_id = null, $table = 'product'){
        if(isset($item_id)){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE item_id = {$item_id}");

            $resultArray = array();

            // fetch product data on by one
            while ($item = $result->fetch(PDO::FETCH_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

    // add product
    public function addProduct($item_genre, $item_brand, $item_name, $item_price, $item_image, $table){
        if ($this->db->con != null) {
            if(isset($item_name) && isset($item_genre) && isset($item_brand) && isset($item_price) &&
                isset($item_image)){
                if(is_double(doubleval($item_price))) {

                    $columns = 'item_genre, item_brand, item_name, item_price, item_image';

                    $result = $this->db->con->query("INSERT INTO {$table}({$columns}) VALUES ({$item_genre}, {$item_brand}, {$item_name}, {$item_price}, {$item_image})");

                    return $result;
                } else {
                    echo "<div class='px-5 pb-2'><p style='color: red'>Cena musi być wartością numeryczną</p></div>";
                }
            } else {
                echo "<div class='px-5 pb-2'><p style='color: red'>Proszę uzupełnić wszystkie dane</p></div>";
            }
        }
    }

    public function deleteProduct($item_id, $table = "product"){
        if ($item_id != null) {
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if ($result) {
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }

    }

    /*public function editProduct($item_id, $table = "product"){

    }*/
}