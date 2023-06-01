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
    <style>
        #dynamicContent {
            overflow-y: scroll;
            max-height: 80vh;
        }
    </style>
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
            <p class="section-description">Welcome to this website created by Alexander Petry. Here, you can explore a fascinating feature: real-time temperature updates from a PynqZ2 board. Powered by cutting-edge technology, this website provides you with an immersive experience to stay informed about the latest temperature readings. Hosted on a Fedora server, you can trust in the reliability and stability of the platform.</p>
        </div>
        <div class="section">
            <h2 class="section-title">How It Works</h2>
            <p class="section-description">The live temperature display operates seamlessly, employing a streamlined process to ensure accurate and up-to-date information. By leveraging advanced technologies, this website brings you the following benefits:</p>
            <ul>
                <li>Temperature data is collected in real-time from the PynqZ2 board, providing instant access to the most current readings.</li>
                <li>The collected data is securely transmitted to a robust backend powered by PHP, which facilitates efficient data management.</li>
                <li>A powerful PostgreSQL database stores the temperature data, enabling easy retrieval and analysis.</li>
                <li>The website's user-friendly interface presents the temperature readings in a visually appealing format, allowing you to effortlessly interpret the information.</li>
            </ul>
        </div>
        <div class="section">
            <h2 class="section-title">Conclusion</h2>
            <p class="section-description">With this website, you have the opportunity to stay connected to the dynamic temperature changes captured by the PynqZ2 board. Experience the convenience of real-time updates and gain valuable insights into temperature patterns. Explore the fascinating world of live temperature monitoring, brought to you by the expertise of Alexander Petry and the advanced technologies powering this website.</p>
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
        <div id="preview" class="scrollable-box">
            <pre><code>data preview</code></pre>
        </div>
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
