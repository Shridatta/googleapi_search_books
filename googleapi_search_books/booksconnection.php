<?php

function connect()
{
   $dbhost="localhost";
   $dbuser="root";
   $dbpass="Chopras1";
   $dbname="books";

   $conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname) or die("CONNECTION FAILED");

   return $conn;

}

?>