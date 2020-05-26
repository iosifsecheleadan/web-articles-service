<?php
// get arguments
if(! isset($_POST["title"])
        || ! isset($_POST["category"])
        || ! isset($_POST["text"])
        || ! isset($_POST["user"])) {
    exit("Empty title, category or text");
}

$username = $_POST["user"];
$title = $_POST["title"];
$category = $_POST["category"];
$text = $_POST["text"];
$text = str_replace("'", "''", $text);
$date = date("Y-m-d");

// establish connection
$mysql = new mysqli("localhost", "sechelea", "Hheren1999", "articles", 3306)
    or die("Connection not working");
if($mysql->connect_error) {
    exit("Could not connect to database");
}

// get foreign Keys
$mysql->query("insert into Category (name) values ('$category')");

$statement = $mysql->prepare("select CategoryID from Category where name='$category'");
if (! $statement) exit("Invalid syntax in query");
$statement->execute();
$statement->store_result();
$statement->bind_result($CategoryID);
$statement->fetch();

$statement = $mysql->prepare("select AuthorID from Author where username='$username'");
if (! $statement) exit("Invalid syntax in query");
$statement->execute();
$statement->store_result();
$statement->bind_result($AuthorID);
$statement->fetch();

if($CategoryID == null || $AuthorID == null) exit("Congratulations. You broke the app.");

// execute statement
$mysql->query("insert into Article(date, title, text, AuthorID, CategoryID) ".
    "values('$date', '$title', '$text', '$AuthorID', '$CategoryID')");

echo "Your article was successfully posted!";
?>

