// get data
var encodedData = <?php echo $encodedData; ?>;
console.log(encodedData);

// set variables
var data = "";
var filetype = ".txt"
var filename = "DownloadFile"

//
data = encodedData;


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