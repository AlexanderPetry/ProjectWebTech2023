var data_raw = dataFromPHP;
var data_formatted;
var filename = "data.txt"

// get data
console.log(data_raw);
// format data into variable

// give data preview

var previewElement = document.getElementById("preview");
previewElement.innerHTML = data_raw;

// write data to file

fs.writeFile(filename, data_formatted, function (err) {
  if (err) throw err;
  console.log('Succesfully written');
});

// allow file to be downloaded

// cleanup