<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Set connection parameters
    $host       = "localhost";
    $port       = "5432"; 
    $dbname     = "postgres";
    $user       = "postgres";
    $password   = "postgres";
    $table      = "test";

    $dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password")
        or die('Could not connect: ' . pg_last_error());

    $query = "SELECT * FROM test";
    $result = pg_query_params($dbconn, $query, array()) or die('Query failed: ' . pg_last_error());

    $data = pg_fetch_all($result);

    echo "<table>";
    echo "<tr><th>number</th><th>bool</th></tr>";
    foreach ($data as $row) {
        echo "<tr><td>".$row['number']."</td><td>".$row['bool']."</td></tr>";
    }
    echo "</table>";
?>