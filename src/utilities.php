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
  function view($templateName, $varScope = [], $baseFolder = "views") {
    global $conn;
    global $repo;

    if(is_array($templateName)) {
      foreach($templateName as $template) {
        view($template, $varScope);
      }
      return;
    }

    extract($varScope);
    $file = $baseFolder . "/$templateName.php";
    
    // treba raditi samo u development modu aplikacije
    $viewPath = dirname(__FILE__) . "\\$baseFolder\\$templateName.php";
    if(!file_exists($viewPath)) {
      throw new Error("File $file nije pronadjen");
    }
    include $file;
  }

/*
  set_error("login", "Neka greska")
  get_error("login") ["Neka greska"]
  get_error("login") []

  set_error("login", "1")
  set_error("login", "2")
  get_error("login") ["1", "2"]
  get_error("login") []
  */

  /**
   * Run a query and use bindings to prepare the PDO statement.
   * 
   * @param PDO $conn the connection statement
   * @param string $query the query to execute
   * @param array[] $bindings array of bindings 
   * @param bool $insert is query running in insert mode
   */
  function bindQuery($conn, $query, $bindings = [], $insert = false) {
    $stmt = $conn->prepare($query);
    foreach($bindings as $key => &$val) {
      $stmt->bindParam(":$key", $val);
    }
    
    $stmt->execute();
    if(!$insert) {
      return $stmt->fetchAll();
    }

    return [];
  }

  function mergeRequestParams()
  {
    $merged = [];

    foreach ($_POST as $key => $val) {
      $merged[$key] = $val;
        // [ kljuc => vrednost ]
    }

    $other = json_decode(file_get_contents("php://input"), true);

    if ($other) {
      foreach ($other as $key => $val) {
        $merged[$key] = $val;
      }
    }

    return $merged;
  }

  function selectRows($conn, $upit) {
    $result = $conn->query($upit);
    
    if($result->rowCount() == 0) {
      return [];
    }

    if($result->rowCount() == 1) {
      return $result->fetch();
    }
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
      '/^\/product\/(\d+)$/' => "product-details",
      '/^\/index.php$/'      => $index,
      '/^\/panel$/'          => "admin/panel"
    ];

    $matched = null;
    $capture_group = [];
    foreach(array_keys($web) as $key) {
      if(preg_match($key, $uri, $re)) {
        $matched = $web[$key];
        $capture_group = $re;
        break;
      }
    }

    array_shift($capture_group);
    if($matched) {
      return [
        "view" => $matched,
        "args" => $capture_group,
        "namespace" => is_array($matched) ? $matched[0] : $matched
      ];
    } 
    return [
      "view" => "404",
      "args" => [],
      "namespace" => "404"
    ];
  }
















