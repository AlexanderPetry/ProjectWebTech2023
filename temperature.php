<?php
$body = file_get_contents("php://input");
$data = json_decode($body, true);

if ($data) {
    // Database connection settings
    $host = 'your_host';
    $dbname = 'your_database';
    $user = 'your_username';
    $password = 'your_password';

    // Connect to the PostgreSQL database
    $connection = pg_connect("host=$host dbname=$dbname user=$user password=$password");

    if (!$connection) {
        echo "Database connection failed.";
        exit;
    }

    // Prepare and execute the SQL statement to insert the data
    $insertQuery = "INSERT INTO your_table (time, temperature) VALUES ";
    $values = [];

    foreach ($data as $item) {
        $time = $item['time'];
        $temperature = $item['temperature'];
        $values[] = "('$time', '$temperature')";
    }

    $insertQuery .= implode(", ", $values);

    $result = pg_query($connection, $insertQuery);

    if ($result) {
        echo "Data inserted into the PostgreSQL database.";
    } else {
        echo "Failed to insert data into the PostgreSQL database.";
    }

    // Close the database connection
    pg_close($connection);
} else {
    echo "No data received.";
}
?>
