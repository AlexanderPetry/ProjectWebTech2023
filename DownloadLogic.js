var data_raw = dataFromPHP;
var data_formatted;
var filename = "data.txt"

// get data

console.log(data_raw[0]);

// format data into variable

for (let i = 0; i < 1 ;i++) {
  data_formatted = data_raw[i].number + ";";
  data_formatted = data_raw[i].bool + ";\n";
}
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
	var link = document.createElement('a');

	// Set the href attribute to the URL
	link.href = url;

	// Set the download attribute with the desired file name
	link.download = 'data.txt';

	// Simulate a click on the link to initiate the download
	link.click();

	// Clean up the URL object
	URL.revokeObjectURL(url);
}

// Get the button element
var downloadButton = document.getElementById('downloadButton');

// Add an event listener to the button
downloadButton.addEventListener('click', handleDownloadButtonClick);