<!-- <script>
    /**
Template Name: Adminto Dashboard
Author: CoderThemes
Email: coderthemes@gmail.com
File: Chartjs
*/


    ! function($) {
        "use strict";

        var ChartJs = function() {};

        ChartJs.prototype.respChart = function(selector, type, data, options) {
                // get selector by context
                var ctx = selector.get(0).getContext("2d");
                // pointing parent container to make chart js inherit its width
                var container = $(selector).parent();

                // enable resizing matter
                $(window).resize(generateChart);

                // this function produce the responsive Chart JS
                function generateChart() {
                    // make chart width fit with its container
                    var ww = selector.attr('width', $(container).width());
                    switch (type) {
                        case 'Line':
                            new Chart(ctx, {
                                type: 'line',
                                data: data,
                                options: options
                            });
                            break;
                        case 'Bar':
                            new Chart(ctx, {
                                type: 'bar',
                                data: data,
                                options: options
                            });
                            break;
                    }
                    // Initiate new chart or Redraw

                };
                // run function - render chart at first load
                generateChart();
            },
            //init
            ChartJs.prototype.init = function() {

                //barchart
                var barChart = {
                    labels: ["Minggu 1", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                        label: "Sales Analytics",
                        backgroundColor: "rgba(24, 138, 226, 0.3)",
                        borderColor: "#188ae2",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(24, 138, 226,0.6)",
                        hoverBorderColor: "#188ae2",
                        data: [65, 59, 80, 81, 56, 55, 40, 20]
                    }]
                };
                this.respChart($("#bar"), 'Bar', barChart);

            },
            $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

    }(window.jQuery),

    //initializing
    function($) {
        "use strict";
        $.ChartJs.init()
    }(window.jQuery);
</script> -->

<script>
    var ctx = document.getElementById('bar_lucky').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {

            responsive: true,
        }
    });
</script>