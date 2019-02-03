<?php

class Repository {
  private $conn;

  private $filters;

  public function __construct($conn) {
    $this->conn = $conn;
    $this->filters = null;
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
}