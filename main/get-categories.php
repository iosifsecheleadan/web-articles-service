<?php
// establish connection
$mysql = new mysqli("localhost", "sechelea", "Hheren1999", "articles")
or die("Connection not working");
if ($mysql->connect_error) {
    $mysql->close();
    exit("Could not connect to database");
}

// execute statement
if($results = $mysql->query("select name from Category")) {
    while ($row = $results->fetch_row()) {
        echo "<option value=\"$row[0]\">$row[0]</option>";
    }
    $results->close();
}
$mysql->close();
?>