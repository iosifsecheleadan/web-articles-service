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
$statement = $mysql->prepare("insert into Author (username, password) "
    ."values('$username', '$password');");
if(! $statement) exit("Username already exists");
$statement->execute();
$statement->fetch();
$statement->close();
$mysql->close();

echo "user=$username";
?>