<?php
$body = file_get_contents("php://input");

$data = json_decode($body, true);
$temperature = isset($data['temperature']) ? $data['temperature'] : null;

function runPythonScript() {
    $pythonScript = "/path/to/your/python_script.py";
    $command = "python3 " . $pythonScript;

    // Execute the Python script
    exec($command, $output, $returnCode);

    // Check the return code to determine if the Python script executed successfully
    if ($returnCode === 0) {
        echo "Python script executed successfully.";
    } else {
        echo "Failed to execute Python script.";
    }
}

if ($temperature) {
    runPythonScript();

    // Set connection parameters
    $host       = "localhost";
    $port       = "5432"; 
    $dbname     = "postgres";
    $user       = "postgres";
    $password   = "sergtsop";
    $table      = "Temperature";

    $dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password")
        or die('Could not connect: ' . pg_last_error());

    // Get current timestamp
    $time = date('Y-m-d H:i:s');

    // Validate temperature value (example: numeric between -100 and 100)
    if (!is_numeric($temperature) || $temperature < -100 || $temperature > 100) {
        echo "Invalid temperature value.";
        exit;
    }

    // Sanitize temperature value
    $temperature = pg_escape_string($dbconn, $temperature);

    $insertQuery = "INSERT INTO $table (time, temperature) VALUES ($1, $2)";

    // Prepare the statement
    $stmt = pg_prepare($dbconn, "insert_query", $insertQuery);

    // Execute the statement with the data as parameters
    $result = pg_execute($dbconn, "insert_query", array($time, $temperature));

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
