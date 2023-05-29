var data_raw = dataFromPHP;
var data_formatted;
var filename = "data.txt"

// get data
console.log(data_raw);
// format data into variable

// give data preview

document.getElementById("preview").innerHTML = "Hello JavaScript!";

// write data to file

fs.writeFile(filename, data_formatted, function (err) {
  if (err) throw err;
  console.log('Succesfully written');
});

// allow file to be downloaded

// cleanup