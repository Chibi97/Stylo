<?php

  function selectMultipleRows($conn, $upit) {
    $result = $conn->query($upit);
    return $result->fetchAll();
  }