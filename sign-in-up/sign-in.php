<?php
// get arguments
if(!isset($_GET["username"]) || !isset($_GET["password"])) {
    exit("Empty username or password");
}
$username = $_GET['username'];
$password = $_GET['password'];

// establish connection
$mysql = new mysqli("localhost", "sechelea", "Hheren1999", "articles", 3306)
    or die("Connection not working");
if($mysql->connect_error) {
    exit("Could not connect to database");
}

// execute statement
$statement = $mysql->prepare("select AuthorID from Author ".
    "where username='$username' and password='$password'");
if (! $statement) exit("Invalid syntax in query");
$statement->execute();
$statement->store_result();
$statement->bind_result($id);
$statement->fetch();
$statement->close();
$mysql->close();

if($id == null) exit("Invalid username or password");

// return result
echo "user=$username";
?>