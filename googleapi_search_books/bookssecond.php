<?php

error_reporting( error_reporting() & ~E_NOTICE );


require 'booksconnection.php';
$conn=connect();

$title=$conn->real_escape_string($_POST['title']);
$authors= $conn->real_escape_string($_POST['authors']);
$pageCount=  $conn->real_escape_string($_POST['pageCount']);
$isbn=  $conn->real_escape_string($_POST['isbn']);
$notes=  $conn->real_escape_string($_POST['notes']);
$query= "INSERT into books(title,authors,pageCount,isbn,notes) values('".$title."','".$authors."','".$pageCount."','".$isbn."','".$notes."')";

$success=$conn->query($query);

if(!$success)
{
	die('connection failed');
}

echo 'Connection successful !!!!!!!';


?>