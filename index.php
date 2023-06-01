<!DOCTYPE html>
<html>
<head>
    <title>Project Webtech 2023</title>
    <link id="css-theme" rel="stylesheet" href="design_light.css">
    <script>
    function changeContent(contentId) {
        var content = document.getElementById(contentId).innerHTML;
        document.getElementById('dynamicContent').innerHTML = content;
    }

    function toggleTheme() {
            var cssTheme = document.getElementById('css-theme');
            
            if (cssTheme.getAttribute('href') === 'design_light.css') {
                cssTheme.setAttribute('href', 'design_dark.css');
            } else {
                cssTheme.setAttribute('href', 'design_light.css');
            }
        }
</script>
</head>
<body>
    <header>
        <h1>Project Webtech 2023</h1>
        <button onclick="toggleTheme()">Toggle Theme</button>
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
        <div class="section">
            <h2 class="section-title">Introduction</h2>
            <p class="section-description">This website is created by Alexander Petry. It provides live temperature updates from a PynqZ2 board. The website is hosted on a server running Fedora.</p>
        </div>

        <div class="section">
            <h2 class="section-title">How It Works</h2>
            <p class="section-description">The live temperature display operates as follows:</p>
            <ol>
                <li><span class="highlight">Step 1:</span> The PynqZ2 board sends temperature data to a PHP script.</li>
                <li><span class="highlight">Step 2:</span> The PHP script stores the data in a PostgreSQL database.</li>
                <li><span class="highlight">Step 3:</span> The stored data can be retrieved and displayed or downloaded.</li>
                <li><span class="highlight">Step 4:</span> The database has a limit of 50 items. When it reaches its capacity, the oldest data is automatically deleted.</li>
            </ol>
        </div>

        <div class="section">
            <h2 class="section-title">Conclusion</h2>
            <p class="section-description">With this setup, you can monitor the live temperature readings from the PynqZ2 board conveniently. The website ensures up-to-date information and maintains a database with a manageable size.</p>
        </div>
    </div>

    <div id="content2" style="display: none;">
        <h2>Database</h2>
        <?php include 'Logic.php'; ?>

    </div>

    <div id="content3" style="display: none;">
        <h1>Download Button</h1>

        <select id="Dropdown" onchange="handleChange()">
          <option value=".csv">CSV</option>
          <option value=".json">JSON</option>
          <option value=".xml">XML</option>
          <option value=".txt">RAW/TXT</option>
        </select>


        <button onclick="downloadData()">Download Data</button>
        <p id="preview"> data preview </p>
        <script>
            function changeContent(contentId) {
                var content = document.getElementById(contentId).innerHTML;
                document.getElementById('dynamicContent').innerHTML = content;
            }

            function handleChange() {
                var dropdown = document.getElementById("Dropdown");

                // Update the filetype variable
                filetype = dropdown.value;
            }

            // Define your PHP encoded data
            var encodedData = <?php echo $encodedData; ?>;
            console.log(encodedData);

            // Set variables
            var data = " ";
            var filetype = document.getElementById("Dropdown").value;
            var filename = "DownloadFile";

            // Function for creating .xml file
            function jsonToXml(json) {
                var xml = '';
                for (var prop in json) {
                    if (json.hasOwnProperty(prop)) {
                        xml += "<" + prop + ">";
                        if (typeof json[prop] === 'object') {
                            xml += jsonToXml(json[prop]);
                        } else {
                            xml += json[prop];
                        }
                        xml += "</" + prop + ">";
                    }
                }
                return xml;
            }

            // Data conversions
            if (filetype == ".csv") {
                for (let i = 0; i < encodedData.length; i++) {
                    data = data + encodedData[i].time + ";";
                    data = data + encodedData[i].temperature + ";\n";
                }
            } else if (filetype == ".json") {
                data = JSON.stringify(encodedData);
            } else if (filetype == ".xml") {
                data = jsonToXml(encodedData);
            } else if (filetype == ".txt") {
                data = JSON.stringify(encodedData);
            } else {
                data = JSON.stringify(encodedData);
            }

            // Preview data
            document.getElementById("preview").textContent = data;

            // Download data
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
