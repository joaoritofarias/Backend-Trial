<?php
require("base.php");

class Products extends Base
{   
    public function createProduct( $product ) {
    
        $product = $this->sanitize( $product );
    
        if(
            !empty($product["name"]) &&
            !empty($product["description"]) &&
            !empty($product["price"]) &&
            !empty($product["stock"]) &&
            mb_strlen($product["name"]) > 2 &&
            mb_strlen($product["name"]) <= 64 &&
            mb_strlen($product["description"]) > 10 &&
            mb_strlen($product["description"]) <= 65535 &&
            mb_strlen($product["price"]) <= 4 &&
            mb_strlen($product["stock"]) <= 4
        ) {
    
            $query = $this->db->prepare("
                INSERT INTO products
                (name,description,price,stock)
                VALUES(?,?,?,?)
            ");
    
            return $query->execute([
                $product["name"],
                $product["description"],
                $product["price"],
                $product["stock"]
            ]);
        }
    
        return false;
    }
    
    public function editProduct( $product, $product_id ) {

        $product = $this->sanitize( $product );

        if(
            !empty($product["name"]) &&
            !empty($product["description"]) &&
            !empty($product["price"]) &&
            !empty($product["stock"]) &&
            mb_strlen($product["name"]) > 2 &&
            mb_strlen($product["name"]) <= 64 &&
            mb_strlen($product["description"]) > 10 &&
            mb_strlen($product["description"]) <= 65535 &&
            mb_strlen($product["price"]) <= 4 &&
            mb_strlen($product["stock"]) <= 4
        ) {
    
            $query = $this->db->prepare("
                INSERT INTO 
                (name,description,price,stock)
                VALUES(?,?,?,?)
                WHERE product_id = ?
            ");
    
            return $query->execute([
                $product["name"],
                $product["description"],
                $product["price"],
                $product["stock"],
                $product_id
            ]);
        }
    
        return false;
    
    }
    
    public function getProducts() {

        $query = $this->db->prepare("
            SELECT product_id, name, description, price, stock
            FROM products
        ");

        $query->execute();

        return $query->fetchAll( PDO::FETCH_ASSOC );
    
    }

    public function getProduct( $product_id ) {
        
        $query = $this->db->prepare("
        SELECT product_id, name, description, price, stock
        FROM products
        WHERE product_id = ?
        ");

        $query->execute([ $product_id ]);

        return $query->fetch( PDO::FETCH_ASSOC );
    
    }  

    public function checkProductExists () {

        $query = $this->db->prepare("
            SELECT product_id
            FROM products
            WHERE lower(name) = 'sku'
        ");

        $query->execute();

        return $query->fetch( PDO::FETCH_ASSOC );
    }
    
    public function sanitize( $array ) {
        foreach($array as $key => $value) {
            $array[ $key ] = trim(strip_tags($value));
        }
        return $array;
    }
}

