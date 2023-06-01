<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Set connection parameters
    $host       = "localhost";
    $port       = "5432"; 
    $dbname     = "postgres";
    $user       = "postgres";
    $password   = "postgres";
    $table      = "temperature";

    $dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password")
        or die('Could not connect: ' . pg_last_error());

    $query = "SELECT * FROM $table";
    $result = pg_query_params($dbconn, $query, array()) or die('Query failed: ' . pg_last_error());

    $data = pg_fetch_all($result);

    echo "<div class='table-container'>";
    echo "<table id='temperature-table' style='margin: 0 auto; border-collapse: collapse;'>";
    echo "<thead>";
    echo "<tr><th style='border: 1px solid #FFFFFF; padding: 5px;'>Time</th><th style='border: 1px solid #FFFFFF; padding: 5px;'>Temperature</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($data as $row) {
        echo "<tr><td style='border: 1px solid #FFFFFF; padding: 5px; text-align: center;'>".$row['time']."</td><td style='border: 1px solid #FFFFFF; padding: 5px; text-align: center;'>".$row['temperature']."</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    $encodedData = json_encode($data);
?>
<script>
    setInterval(function() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("temperature-table").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "Logic.php", true);
        xmlhttp.send();
    }, 60000); // Refresh the table content every 1 minute (60,000 milliseconds)
</script>