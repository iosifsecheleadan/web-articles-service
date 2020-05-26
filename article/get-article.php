<?php
// get article id
if(! isset($_GET["article"])) exit("<h1>No article ID given</h1>");
$id = $_GET["article"];

// establish connection
$mysql = new mysqli("localhost", "sechelea", "Hheren1999", "articles")
    or die("<h1>Connection not working</h1>");
if ($mysql->connect_error) {
    $mysql->close();
    exit("<h1>Could not connect to database</h1>");
}

// execute statement
if($result = $mysql->query("select title, name, username, date, text"
        . " from Article natural join Author natural join Category"
        . " where ArticleID='$id'")) {
    $row = $result->fetch_row();
    if ($row == null) {
        echo "<h1>No such article</h1>"
            . "<p>We could not load the article you selected.<br>"
            . "Please click on home and find other articles.<br><br>"
            . "We apologise for the inconvenience!</p>";
    } else {
        $text = str_replace("\n", "<br>", $row[4]);
        echo "<h1>$row[0]</h1>"
            . "<div><label>Category : $row[1]</label>"
            . "<label>Author : $row[2]</label>"
            . "<label>Date : $row[3]</label>"
            . "</div><p>$text</p>";
    }
    $result->close();
} else echo("<h1>Invalid syntax in query</h1>");
$mysql->close();
?>