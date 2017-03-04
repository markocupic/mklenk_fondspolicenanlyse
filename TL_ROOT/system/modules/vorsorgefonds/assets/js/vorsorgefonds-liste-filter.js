/**
 * Rentenversicherungen filtered list
 * Created by Marko Cupic on 03.03.2017.
 */

// jQuery is loaded
if (window.jQuery) {

    if ($(window).innerWidth() >= 480) {
        (function ($) {
            VorsorgefondsJS = {
                generateChart: function () {
                    if ($('#chart').length) {
                        var ctx = $('#chart');
                        ctx.html('');
                        if (typeof VorsorgefondsJS.chart != 'undefined') {
                            VorsorgefondsJS.chart.destroy();
                        }
                        if (VorsorgefondsJS.chartX.length) {
                            // Set height
                            ctx.prop('height', 20 * VorsorgefondsJS.chartX.length);

                            VorsorgefondsJS.chart = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    labels: VorsorgefondsJS.chartX,
                                    datasets: [{
                                        label: 'EFFEKTIVKOSTENQUOTE',
                                        data: VorsorgefondsJS.chartY,
                                        backgroundColor: VorsorgefondsJS.chartBg,
                                        borderColor: VorsorgefondsJS.chartBorder,
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }],
                                        xAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            },
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'Effektivkosten in %'
                                            }
                                        }]
                                    },
                                    tooltips: {
                                        enabled: true,
                                        mode: 'single',
                                        callbacks: {
                                            label: function(tooltipItems, data) {
                                                return ' ' + tooltipItems.xLabel + ' %';
                                            }
                                        }
                                    },
                                    maintainAspectRatio: true
                                }
                            });
                        }

                    }
                }
            };


            $(document).ready(function () {
                if ($('#vorsorgefondsFilteredList').length && $('#vorsorgefondsFilteredListForm').length) {
                    window.setTimeout(function () {
                        VorsorgefondsJS.generateChart();
                    }, 1500);


                    var host = window.location;
                    $('#vorsorgefondsFilteredListForm').change(function () {
                        // Destroy chart, if there is one
                        if (typeof VorsorgefondsJS.chart != 'undefined') {
                            VorsorgefondsJS.chart.destroy();
                        }

                        $('#vorsorgefondsFilteredList').html('<div class="loadingHtml">Lade...</div>');
                        var params = $("#vorsorgefondsFilteredListForm").serialize();
                        $.get(host + '?' + params, function (data) {
                            window.setTimeout(function () {
                                $('#vorsorgefondsFilteredList').html(data);
                            }, 1000);
                            window.setTimeout(function () {
                                VorsorgefondsJS.generateChart();
                            }, 1200);

                        });
                    });
                }
            });
        })(jQuery);
    }


}