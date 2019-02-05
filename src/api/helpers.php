<?php
  require_once "../../database.php";
  require_once "../../src/repository.php";
  require_once "../../src/utilities.php";

  $repo = new Repository($conn);

  $request = mergeRequestParams();

  header("Content-Type: Application/json");