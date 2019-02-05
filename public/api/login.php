<?php 
  $kredencijali = false;
  $greska = "";

  if($kredencijali) {
    $_SESSION["korisnik"] = ["ime" => "stefan", "id" => 1];
  } else {
    $greska = "nije uspelo login";
  }

  if($greska) {
    $_SESSION["greska"] = $greska;
  }

  header("Location: /");  