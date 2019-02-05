<?php
  require_once "../../src/api/helpers.php";
  
    /*
    $products = [[
       "id"    => 1,
       "img"   => "/images/item1.jpg",
       "alt"   => "IMG-PRODUCT",
       "name"  => "Herschel Supply co 251",
       "price" => 75.00,
       "new"  => true
     ],
     [
       "id"    => 2,
       "img"   => "/images/item2.jpg",
       "alt"   => "IMG-PRODUCT",
       "name"  => "Herschel Supply co 251",
       "price" => 75.00,
       "name"  => "Denim jacket blue"
     ],
     [
       "id"    => 3,
       "img"   => "/images/item3.jpg",
       "alt"   => "IMG-PRODUCT",
       "name"  => "Coach slim easton black",
       "price" => 75.00,
       "sale"  => 15.60
     ]]; */

  $status = 200;
  if($_SERVER["REQUEST_METHOD"] === "GET") {
    echo json_encode($repo->getProducts());
  } else if($_SERVER["REQUEST_METHOD"] === "POST") {
    $filters    = $request['filters']    ?? [];
    $categories = $request['categories'] ?? [];

    if(!empty($filters) || !empty($categories)) {
      echo json_encode($repo->getProducts($filters, $categories));
    } else {
      echo json_encode($repo->getProducts());
    }

  } else {
    $status = 405;
  }


  http_response_code($status);