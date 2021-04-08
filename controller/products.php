<?php

if( isset($_POST["cancel"]) ) {

    $_SESSION["edit_id"] = array();
    header("Location:../");
    exit;
}

require("model/products.php");

$modelProducts = new Products;


if( isset($_POST["send"]) ) {

    $compareName = strtolower($_POST["name"]);

    if($compareName === "sku") {

        $productExists = $modelProducts->checkProductExists();

        if( $productExists ) {
            header("Location:../");
            exit;
        }

    }

    $result = $modelProducts->createProduct( $_POST );

    if($result) {
        header("Location:../");
    }


}
else {

    $products = $modelProducts->getProducts();


    require("view/products.php");
}


