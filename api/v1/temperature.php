<?php
$body = file_get_contents("php://input");

$data = json_decode($body, true);
$data = (string) $data['temperature'];

echo "Temperature: ";
echo $data;
echo "\n";


if ($data) {
    // Set connection parameters
    $host       = "localhost";
    $port       = "5432"; 
    $dbname     = "postgres";
    $user       = "postgres";
    $password   = "postgres";
    $table      = "Temperature";

    $dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password")
        or die('Could not connect: ' . pg_last_error());

    // Get current timestamp
    $time = date('Y-m-d H:i:s');

    echo "Time: ";
    echo $time;
    echo "\n";


    $insertQuery = "INSERT INTO $table ($time, $data) VALUES ";
    

    echo "insert query: ";
    echo $insertQuery;
    echo "\n";

    // Remove trailing comma and space
    $insertQuery = rtrim($insertQuery, ', ');

    echo "insert query: ";
    echo $insertQuery;
    echo "\n";

    $result = pg_query($dbconn, $insertQuery);

    echo "result: ";
    echo $result;
    echo "\n";

    if ($result) {
        echo "Data inserted into the PostgreSQL database.\n";
    } else {
        echo "Failed to insert data into the PostgreSQL database.\n";
    }

    // Close the database connection
    pg_close($dbconn);
} else {
    echo "No data received.";
}
?>
