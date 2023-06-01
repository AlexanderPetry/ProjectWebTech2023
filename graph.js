document.addEventListener("DOMContentLoaded", function () {
    var toggleButton = document.getElementById('toggle-button');
    var tableView = document.getElementById('temperature-table');
    var graphView = document.getElementById('graph');

    toggleButton.addEventListener("click", toggleView);

    function toggleView() {
        if (tableView.style.display === 'none') {
            tableView.style.display = 'table';
            graphView.style.display = 'none';
            toggleButton.textContent = 'Show Graph';
        } else {
            tableView.style.display = 'none';
            graphView.style.display = 'block';
            toggleButton.textContent = 'Show Table';
            drawGraph();
        }
    }

    function drawGraph() {
        // Code for drawing the graph using a library like Chart.js
        // Replace with your own implementation
        // Example code for drawing a simple line graph

        var data = [
            { time: '09:00', temperature: 22 },
            { time: '10:00', temperature: 23 },
            { time: '11:00', temperature: 24 },
            { time: '12:00', temperature: 25 },
            { time: '13:00', temperature: 26 },
            { time: '14:00', temperature: 27 },
            { time: '15:00', temperature: 28 },
            { time: '16:00', temperature: 29 },
            { time: '17:00', temperature: 28 },
            { time: '18:00', temperature: 27 }
        ];

        var labels = data.map(function (item) {
            return item.time;
        });

        var temperatures = data.map(function (item) {
            return item.temperature;
        });

        var ctx = document.getElementById('graph').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Temperature',
                    data: temperatures,
                    backgroundColor: 'rgba(0, 0, 0, 0.2)', // Gray background color
                    borderColor: 'rgba(0, 0, 0, 1)', // Black border color
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Time'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Temperature'
                        }
                    }
                }
            }
        });
    }
});
