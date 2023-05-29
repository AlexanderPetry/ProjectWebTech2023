var data_raw = dataFromPHP;
var data_formatted;
var filename = "data.txt"

// get data

console.log(data_raw);

// format data into variable

data_formatted = "";
data_formatted = data_formatted + data_raw[0].number 	+ ";";
data_formatted = data_formatted + data_raw[0].bool 		+ ";";
data_formatted = data_formatted + data_raw[1].number 	+ ";";
data_formatted = data_formatted + data_raw[1].bool 		+ ";";

// give data preview

var previewElement = document.getElementById("preview");
previewElement.innerHTML = data_formatted;

// Create a function to handle the button click event

function handleDownloadButtonClick() {
	console.log("button test");

	// Create a Blob object with the server-side data
	var blob = new Blob([data_formatted], { type: 'text/plain' });

	// Create a URL for the blob object
	var url = URL.createObjectURL(blob);

	// Create a link element
	var downloadButton = document.getElementById('downloadButton');

	// Set the href attribute to the URL
	downloadButton.href = url;

	// Set the download attribute with the desired file name
	downloadButton.download = 'data.txt';

	// Clean up the URL object
	URL.revokeObjectURL(url);
}

// Get the button element
var downloadButton = document.getElementById('downloadButton');

// Add an event listener to the button
downloadButton.addEventListener('click', handleDownloadButtonClick);