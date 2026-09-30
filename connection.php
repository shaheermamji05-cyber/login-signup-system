<?php

try {
  
    $connection = new PDO("mysql:host=localhost;dbname=database","root","");
    // echo "database connected";




} catch (\Throwable $th) {
    throw $th;
}




?>