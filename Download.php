<?php
// Set connection parameters
$host       = "localhost";
$port       = "5432"; 
$dbname     = "postgres";
$user       = "postgres";
$password   = "postgres";
$table      = "test";

$filetype  = "csv";

$dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password")
    or die('Could not connect: ' . pg_last_error());

$query = "SELECT * FROM test";
$result = pg_query_params($dbconn, $query, array()) or die('Query failed: ' . pg_last_error());

// Generate a CSV file
if($filetype == "csv"){
    $filename = "database.csv";
    $file = fopen($filename, "w");
}
// Write column headers
$columnHeaders = array("Number", "Bool");
fputcsv($file, $columnHeaders);

// Write data rows
while ($row = pg_fetch_assoc($result)) {
    $rowData = array($row["column1"], $row["column2"], $row["column3"]);
    fputcsv($file, $rowData);
}

// Close the file
fclose($file);

// Set the appropriate headers for file download
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=" . $filename);
header("Content-Length: " . filesize($filename));

// Send the file to the browser for download
readfile($filename);

// Clean up - delete the file
unlink($filename);

// Close the database connection
pg_close($connection);
?>
