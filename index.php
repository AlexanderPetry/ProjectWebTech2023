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
        <?php
        echo "PHP test";
        ?>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</p>
        <p>Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.</p>
    </div>

    <div id="content2" style="display: none;">
        <h2>Database</h2>
        <?php include 'Logic.php'; ?>

    </div>

    <div id="content3" style="display: none;">
        <h1>Download Button</h1>
        <button onclick="downloadData()">Download Data</button>

        <script >
                    // get data
          var encodedData = <?php echo $encodedData; ?>;
          console.log(encodedData);

          // set variables
          var data = "";
          var filetype = ".csv"
          var filename = "DownloadFile"

          //
          data = encodedData[0].number + ";";
          data = data + encodedData[0].bool + ";\n";
          data = data + encodedData[1].number + ";";
          data = data + encodedData[1].bool + ";\n";



          //download data
          function downloadData() {
              // Create a Blob object from the data
              var blob = new Blob([data], { type: "text/plain" });

              // Create a temporary URL for the Blob object
              var url = URL.createObjectURL(blob);

              // Create a temporary <a> element to initiate the download
              var link = document.createElement("a");
              link.href = url;
              link.download = filename + filetype; // Set the desired file name

              // Append the <a> element to the document body
              document.body.appendChild(link);

              // Trigger the download
              link.click();

              // Clean up - remove the temporary <a> element
              document.body.removeChild(link);

              // Release the object URL
              URL.revokeObjectURL(url);
          }

        </script>

    </div>
</body>
</html>
