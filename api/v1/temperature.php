<?php
$body = file_get_contents("php://input");

echo $body;
echo "\n";

$data = json_decode($body, true);

echo $data;
echo "\n";

$temperature = (string) $data['temperature'];
echo $temperature;
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

    // Prepare and execute the SQL statement to insert the data
    $insertQuery = "INSERT INTO $table (time, temperature) VALUES ";

    foreach ($data as $item) {
        $temperature = $item['temperature'];
        $insertQuery .= "('$time', '$temperature'), ";
    }

    // Remove trailing comma and space
    $insertQuery = rtrim($insertQuery, ', ');

    $result = pg_query($dbconn, $insertQuery);

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
