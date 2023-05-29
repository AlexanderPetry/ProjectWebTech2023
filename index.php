<!DOCTYPE html>
<html>
<head>
    <title>Project Webtech 2023</title>
    <script>
        function changeContent(contentId) {
            var content = document.getElementById(contentId).innerHTML;
            document.getElementById('dynamicContent').innerHTML = content;
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
        }

        nav a {
            margin: 0 10px;
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }

        #dynamicContent {
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Dynamic Header Example</h1>
    </header>
    <nav>
        <a onclick="changeContent('content1')">About</a>
        <a onclick="changeContent('content2')">Data</a>
        <a onclick="changeContent('content3')">Download</a>
    </nav>
    <div id="dynamicContent">
        <p>Select an option from the navigation menu.</p>
    </div>

    <div id="content1" style="display: none;">
        <h2>About</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</p>
        <p>Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.</p>
    </div>

    <div id="content2" style="display: none;">
        <h2>Content 2</h2>
        <p>This is the content of section 2.</p>
        <?php
          // Set connection parameters
          $host       = "localhost:5432";
          $dbname     = "postgres";
          $user       = "postgres";
          $password   = "postgres";
          $table      = "test";

          $dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$password")
              or die('Could not connect: ' . pg_last_error());

          $query = 'SELECT * FROM $table';
          $result = pg_query($query) or die('Query failed: ' . pg_last_error());

          $data = pg_fetch_all($result);

          echo "<table>";
          echo "<tr><th>Name</th><th>Email</th></tr>";
          foreach ($data as $row) {
              echo "<tr><td>".$row['name']."</td><td>".$row['email']."</td></tr>";
          }
          echo "</table>";
        ?>
    </div>

    <div id="content3" style="display: none;">
        <h2>Content 3</h2>
        <p>This is the content of section 3.</p>
    </div>
</body>
</html>
