/**
 * vorsorgefonds
 * Created by Marko Cupic on 03.03.2017.
 */


// Constructor
function VorsorgefondsJS(tableContainer, filterForm, chartContainer, options) {
    this.$tableContainer = $(tableContainer);
    this.$filterForm = $(filterForm);
    this.$chartContainer = $(chartContainer);
    var defaults = {
        loadingHtml: '<div class="loadingHtml">Lade...</div>',
        chart: {
            data: {
                datasets: {
                    label: 'EFFEKTIVKOSTENQUOTE'
                }
            },
            options: {
                scales: {
                    xAxes: {
                        scaleLabel: {
                            labelString: 'Effektivkostenquote in %'
                        }
                    }
                }

            }

        }
    };


    // Merge defaults with user settings
    this.options = $.extend({}, defaults, options);
}

// Prototype VorsorgefondsJS
VorsorgefondsJS.prototype = {

    constructor: VorsorgefondsJS,

    // Properties
    chart: null,
    chartX: null,
    chartY: null,
    chartBorder: null,
    chartBg: null,

    /**
     * setChartX
     * @param arrChartX
     */
    setChartX: function (arrChartX) {
        this.chartX = arrChartX;
    },
    /**
     * setChartY
     * @param arrChartY
     */
    setChartY: function (arrChartY) {
        this.chartY = arrChartY;
    },
    /**
     * setChartBorder
     * @param arrChartBorder
     */
    setChartBorder: function (arrChartBorder) {
        this.chartBorder = arrChartBorder;
    },

    /**
     * setChartBg
     * @param arrChartBg
     */
    setChartBg: function (arrChartBg) {
        this.chartBg = arrChartBg;
    },

    /**
     * generate chart
     */
    generateChart: function () {
        var self = this;
        if (self.$chartContainer.length) {
            self.$chartContainer.html('');
            self.destroyChart();
            if (self.chartX.length) {
                // Set height
                self.$chartContainer.prop('height', 20 * self.chartX.length);

                self.chart = new Chart(self.$chartContainer, {
                    type: 'horizontalBar',
                    data: {
                        labels: self.chartX,
                        datasets: [{
                            label: self.options.chart.data.datasets.label,
                            data: self.chartY,
                            backgroundColor: self.chartBg,
                            borderColor: self.chartBorder,
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
                                    labelString: self.options.chart.options.scales.xAxes.scaleLabel.labelString
                                }
                            }]
                        },
                        tooltips: {
                            enabled: true,
                            mode: 'single',
                            callbacks: {
                                label: function (tooltipItems, data) {
                                    return ' ' + tooltipItems.xLabel + ' %';
                                }
                            }
                        },
                        maintainAspectRatio: true
                    }
                });
            }
        }
    },

    /**
     * destroyChart
     */
    destroyChart: function () {
        if (this.chart !== null) {
            this.chart.destroy();
        }
    },

    /**
     * loadData from server
     */
    loadData: function () {
        var self = this;
        self.$tableContainer.html(this.options.loadingHtml);
        var params = self.$filterForm.serialize();
        var host = window.location;
        $.get(host + '?' + params, function (data) {
            window.setTimeout(function () {
                self.$tableContainer.html(data);
            }, 1000);
            window.setTimeout(function () {
                self.generateChart();
            }, 1200);

        });
    }
};

