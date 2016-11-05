<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"></script>
<!-- TODO correct source integration -->

<canvas id="scoreChart"></canvas>

<script type="text/javascript">

    var ctx = document.getElementById("scoreChart");
    var config = {
        type: 'line',
        data: {

            // TODO insert php variable with timestamp (array[string])
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "Score",
                backgroundColor: 'rgba(221, 75, 57, 1)',
                borderColor: 'rgba(221, 75, 57, 0.4)',

                // TODO insert php variable with score values (array[object})
                data: [
                    2,
                    5,
                    7,
                    15,
                    21,
                    25,
                    27,
                ],
                fill: false,
            }]
        },
        options: {
            legend: {
                display: false,
            },
            responsive: true,
            title: {
                display: true,
                text: 'Score Board',
                fontSize: 16,
            },
            tooltips: {
                mode: 'x-axis',
                intersect: false,
                xPadding: 10,
                yPadding: 10,
            },
            hover: {
                mode: 'single',
                intersect: false,
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Score'
                    },
                    stacked: true,
                }]
            }
        }
    };

    var scoreChart = new Chart(ctx, config);

    // Define a plugin to provide data labels
    Chart.plugins.register({
        afterDatasetsDraw: function (chartInstance, easing) {
            // To only draw at the end of animation, check for easing === 1
            var ctx = chartInstance.chart.ctx;

            chartInstance.data.datasets.forEach(function (dataset, i) {
                var meta = chartInstance.getDatasetMeta(i);
                if (!meta.hidden) {
                    meta.data.forEach(function (element, index) {
                        // Draw the text in black, with the specified font
                        ctx.fillStyle = 'rgb(0, 0, 0)';

                        var fontSize = 16;
                        var fontStyle = 'normal';
                        var fontFamily = 'Helvetica Neue';
                        ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                        // Just naively convert to string for now
                        var dataString = dataset.data[index].toString();

                        // Make sure alignment settings are correct
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';

                        var padding = 5;
                        var position = element.tooltipPosition();
                        ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                    });
                }
            });
        }
    });

</script>