<?php
          // Set connection parameters
          $host       = "localhost:5432";
          $dbname     = "postgres";
          $user       = "postgres";
          $password   = "postgres";
          $table      = "test";

          $dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$password")
              or die('Could not connect: ' . pg_last_error());

          $query = "SELECT * FROM test";
          $result = pg_query($query) or die('Query failed: ' . pg_last_error());

          $data = pg_fetch_all($result);

          echo "<table>";
          echo "<tr><th>number</th><th>bool</th></tr>";
          foreach ($data as $row) {
              echo "<tr><td>".$row['number']."</td><td>".$row['bool']."</td></tr>";
          }
          echo "</table>";
?>