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

    echo "<table style='margin: 0 auto; border-collapse: collapse;'>";
    echo "<tr><th style='border: 1px solid black; padding: 5px;'>number</th><th style='border: 1px solid black; padding: 5px;'>bool</th></tr>";
    foreach ($data as $row) {
        echo "<tr><td style='border: 1px solid black; padding: 5px; text-align: center;'>".$row['number']."</td><td style='border: 1px solid black; padding: 5px; text-align: center;'>".$row['bool']."</td></tr>";
    }
    echo "</table>";

    $encodedData = json_encode($data);
?>