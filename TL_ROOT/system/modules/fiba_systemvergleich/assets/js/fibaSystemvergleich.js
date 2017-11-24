'use strict';

/**
 * FibaSystemvergleich
 * Created by Marko Cupic on 24.11.2017.
 */

// Constructor
function FibaSystemvergleich(filterForm, chartContainer, objChart) {

    var self = this;

    this.$filterForm = $(filterForm);
    this.$chartContainer = $(chartContainer);

    var defaults = {
        type: 'bar',
        data: {
            labels: ["Fondssparplan", "Fondspolice", "Rentenkapital"],
            datasets: [{
                label: 'Systemvergleich',
                data: null,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItems, data) {
                        // @see https://stackoverflow.com/questions/34720530/chart-js-v2-add-prefix-or-suffix-to-tooltip-label/37552782#37552782
                        var value = self.numberFormat(data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index], 2, ',', '.');
                        return  value + ' €';
                    }
                }

            }
        }
    };


    // Merge defaults with user settings
    this.objChart = $.extend({}, defaults, objChart);


    // Set options here:
    this.$objDataSystemvergleich = {
        'fondssparplan_laufzeit': null,
        'fondssparplan_kosten': null,

        'fondspolice_laufzeit': null,
        'fondspolice_kosten': null
    };


    this.$chartData = {
        'fondssparplan_ablaufleistung': null,
        'fondspolice_ablaufleistung': null,
        'rentenkapital_ablaufleistung': null
    };


    // Sync dropdowns
    var $selectsLaufzeit = $(filterForm + ' [data-input="select_1-1"], ' + filterForm + ' [data-input="select_1-2"]').change(function () {
        $selectsLaufzeit.not(this).val($(this).val());
    });

    // Update data on input change
    $(filterForm + ' [data-input^="select_"]').change(function (event) {
        self.checkForm();
    });


}

// Prototype FibaSystemvergleich
FibaSystemvergleich.prototype = {

    constructor: FibaSystemvergleich,


    // Properies
    chart: null,


    /**
     * Check form
     */
    checkForm: function () {
        var self = this;
        // Collect Data and store it in object
        $.each(self.$objDataSystemvergleich, function (key, value) {
            self.$objDataSystemvergleich[key] = $('select[name="' + key + '"]').val();
        });
        var formFilledIn = true;
        if (!self.$objDataSystemvergleich['fondssparplan_laufzeit'] || !self.$objDataSystemvergleich['fondssparplan_kosten'] || !self.$objDataSystemvergleich['fondspolice_laufzeit'] || !self.$objDataSystemvergleich['fondspolice_kosten']) {
            formFilledIn = false;
            self.destroyChart();
        }

        if (formFilledIn === true) {
            self.loadData();
        }
    },


    /**
     * Load data from xhr
     */
    loadData: function () {
        var self = this;

        // Set post data
        var objData = {};
        objData['REQUEST_TOKEN'] = self.$filterForm.find('input[name="REQUEST_TOKEN"]').val();
        objData['FORM_SUBMIT'] = self.$filterForm.find('input[name="FORM_SUBMIT"]').val();
        $.each(self.$objDataSystemvergleich, function (key, value) {
            objData[key] = value;
        });

        $.ajax({
            type: "POST",
            url: location.href,
            data: objData,
            success: function (data) {
                if (data['status']) {

                    // Set table values & use format_number
                    var val = self.numberFormat(data['fondssparplan_ablaufleistung'], 2, ',', '.');
                    self.$filterForm.find('[data-output="cell_3-1"]').text(val + ' EUR');

                    var val = self.numberFormat(data['fondspolice_ablaufleistung'], 2, ',', '.');
                    self.$filterForm.find('[data-output="cell_3-2"]').text(val + ' EUR');

                    // Build chart object
                    $.each(self.$chartData, function (key, value) {
                        self.$chartData[key] = data[key];
                    });

                    var arrData = [];
                    $.each(self.$chartData, function (key, value) {
                        arrData.push(self.$chartData[key]);
                    });

                    // Generate chart
                    self.generateChart(arrData);

                } else {
                    $.each(self.$objDataSystemvergleich, function (key, value) {
                        self.$objDataSystemvergleich[key] = null;
                    });

                    // Reset form
                    self.resetForm();

                    // Reset table
                    self.$filterForm.find('[data-output="cell_3-1"]').text('');
                    self.$filterForm.find('[data-output="cell_3-2"]').text('');

                    // Reset chart object
                    $.each(self.$chartData, function (key, value) {
                        self.$chartData[key] = null;
                    });
                }
            },
            dataType: 'json'
        });
    },


    /**
     * Generate chart
     */
    generateChart: function (arrData) {
        var self = this;
        self.setChartX(arrData);

        // Destroy old chart
        self.$chartContainer.html('');
        self.destroyChart();

        self.chart = new Chart(self.$chartContainer, self.objChart);
    },


    /**
     * Destroy chart
     */
    destroyChart: function () {
        if (this.chart !== null) {
            this.chart.destroy();
        }
    },


    /**
     * Reset form
     */
    resetForm: function () {
        if (this.$filterForm.length) {
            this.$filterForm[0].reset();
        }
    },


    /**
     * Set chartX
     * @param arrChartX
     */
    setChartX: function (arrChartX) {
        this.objChart.data.datasets[0].data = arrChartX;
    },


    /**
     * http://php.net/manual/de/function.number-format.php
     * https://gist.github.com/VassilisPallas/d73632e9de4794b7dd10b7408f7948e8
     * @param number
     * @param decimals
     * @param dec_point
     * @param thousands_point
     * @returns {string|*}
     */
    numberFormat: function (number, decimals, dec_point, thousands_point) {

        if (number == null || !isFinite(number)) {
            throw new TypeError("number is not valid");
        }

        if (!decimals) {
            var len = number.toString().split('.').length;
            decimals = len > 1 ? len : 0;
        }

        if (!dec_point) {
            dec_point = '.';
        }

        if (!thousands_point) {
            thousands_point = ',';
        }

        number = parseFloat(number).toFixed(decimals);

        number = number.replace(".", dec_point);

        var splitNum = number.split(dec_point);
        splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
        number = splitNum.join(dec_point);

        return number;
    }
};