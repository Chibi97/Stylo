<?php

/**
 * Funkcija koja nam radi kao mali "template engine".
 * Posto svaka funckija pravi svoj scope, mi moramo da prosledimo
 * varijable kojoj trebaju.
 * 
 * Ti kada kazes require $file, on nasledi variajble iz TRENUTNOG SCOPA-a.
 * Tako da sve varijable koje se nalaze u scopu funkcije view se proslede.
 * 
 * Koriscenjem extract() mi popunjavamo scope od funckije view sa varijablama
 * koji je korisnik nase funkcije prosledio.
 */
  function view($templateName, $varScope = []) {
    global $conn;

    if(is_array($templateName)) {
      foreach($templateName as $template) {
        view($template, $varScope);
      }
      return;
    }

    extract($varScope);
    $file = "views/$templateName.php";
    
    // TODO: treba raditi samo u development modu aplikacije.
    $viewPath = dirname(__FILE__) . "\\views\\$templateName.php";
    if(!file_exists($viewPath)) {
      throw new Error("File $file nije pronadjen");
    }

    include $file;
  }

  function selectMultipleRows($conn, $upit) {
    $result = $conn->query($upit);
    return $result->fetchAll();
  }

  function resolveRoute() {
    $uri = $_SERVER["REQUEST_URI"];
    $index = ["slider", "featured-products", "advertising"];
    $web = [
      '/^\/$/'               => $index,
      '/^\/shop$/'           => "all-products",
      '/^\/popular$/'        => "featured-products",
      '/^\/about$/'          => "about",
      '/^\/contact$/'        => "contact",
      '/^\/cart$/'           => "cart",
      '/^\/product\/(\d+)\/(\d+)$/' => "product-details",
      '/^\/index.php$/'      => $index
    ];

    $matched = null;
    $reret = [];
    foreach(array_keys($web) as $key) {
      if(preg_match($key, $uri, $re)) {
        $matched = $web[$key];
        $reret = $re;
        break;
      }
    }

    array_shift($reret);
    if($matched) {
      return [
        "view" => $matched,
        "args" => $reret
      ];
    } 
    return "404";
  }
















