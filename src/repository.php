<?php

class Repository {
  private $conn;

  private $filters;

  private $request;

  public function __construct($conn) {
    $this->conn    = $conn;
    $this->filters = null;
  }

  public function getProducts($filters = [], $categories = []) {
    $where_filter = null; 
    $where_category = null;
    $at_end = [];
    $bindings = [];
    $query = "SELECT a.* FROM articles a ";
    
    if(!empty($filters)) {
      $where_filter = $this->whereFragment($filters, "filter");
      
      $query   .= "JOIN filters f on a.id_filter = f.id ";
      $at_end[] = $where_filter->query;
      $bindings = array_merge($bindings, $where_filter->bindings);
    }

    if(!empty($categories)) {
      $where_category = $this->whereFragment($categories, "category");
      $query   .= "JOIN categories c on a.id_category = c.id ";
      $at_end[] = $where_category->query; 
      $bindings = array_merge($bindings, $where_category->bindings);
    }

    if(!empty($at_end)) {
      for($i=0; $i<count($at_end); $i++) {
        if($i == 0) {
          $query .= " WHERE {$at_end[$i]}";
        } else {
          $query .= " AND {$at_end[$i]} ";
        }

      }
    }
    
    return bindQuery($this->conn, $query, $bindings);
  }

  public function allFilters() {
    if($this->filters == null) {
      $this->fetchFilters();
    }
    return $this->filters;
  }

  private function fetchFilters() { 
    $this->filters = selectRows($this->conn, "SELECT * FROM filters");
  }

  // WHERE category IN (:c0, :c1, :c2)
  private function whereFragment($filters, $name) {
    $ret = [];
    $bindings = [];
    $number = count($filters);
    $args   = [];
    for($i = 0; $i < $number; $i++) {
      $bName = "$name$i";
      $args[] = ":$bName";
      $bindings[$bName] = $filters[$i];
    }
    $in = implode(", ", $args);
    $fragment = " $name IN ($in)";
    // where filters IN [:f0, :f1, :f2]
    return new WhereFragment($fragment, $bindings);
  }
}

class WhereFragment {
  public $query;
  public $bindings;

  public function __construct($query, $bindings)
  {
    $this->query  = $query;
    $this->bindings = $bindings; 
  }
}