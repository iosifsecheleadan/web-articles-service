<?php
// establish connection
$mysql = new mysqli("localhost", "sechelea", "Hheren1999", "articles")
    or die("Connection not working");
if ($mysql->connect_error) {
    $mysql->close();
    exit("Could not connect to database");
}

// create statement
$statement = "select title, text, name, username, date, ArticleID"
    . " from Article natural join Author natural join Category"
    . " where true";
if(isset($_GET["start"])) {
    $startDate = $_GET["start"];
    $statement .= " and date>='$startDate'";
}
if(isset($_GET["end"])) {
    $endDate = $_GET["end"];
    $statement .= " and date<='$endDate'";
}
if(isset($_GET["category"])) {
    $category = $_GET["category"];
    $statement .= " and name='$category'";
}
// execute statement
if($result = $mysql->query($statement)) {
    while ($row = $result->fetch_row()) {
        echo "<article><a href='../article/article.html?article=$row[5]'>"
            . "$row[0]</a>"
            . "<p>" . substr($row[1], 0, 128) . "...</p>"
            . "<div><label>Category : $row[2]</label>"
            . "<label>Author : $row[3]</label>"
            . "<label>Publish Date : $row[4]</label>".
            "</div></article>";
    }
    $result->close();
} else echo "Invalid syntax in query";
$mysql->close();
?>