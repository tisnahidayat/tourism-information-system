"use strict";

document.addEventListener('DOMContentLoaded', function () {
    var labels = window.labels;
    var data = window.data;
    var regionLabels = window.regionLabels;
    var regionData = window.regionData;

    // Predefined color set to ensure consistency
    var predefinedColors = [
        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
        '#FFCD56', '#4BC0C0', '#36A2EB', '#FF6384', '#4BC0C0', '#9966FF',
        '#FF6384', '#FFCE56', '#36A2EB', '#FF9F40', '#4BC0C0', '#9966FF',
        '#FFCD56', '#4BC0C0', '#36A2EB', '#FF6384', '#FFCE56', '#FF9F40',
        '#9966FF', '#4BC0C0', '#FFCD56', '#36A2EB', '#FF6384', '#FFCE56',
        '#B39DDB', '#81C784', '#FF8A65', '#9575CD', '#F06292', '#64B5F6',
        '#BA68C8', '#4DB6AC', '#FFD54F', '#DCE775', '#FFB74D', '#A1887F',
        '#90A4AE', '#AED581', '#FF7043', '#7986CB', '#E57373', '#64B5F6'
    ];

    var backgroundColors = predefinedColors.slice(0, labels.length);
    var regionBackgroundColors = predefinedColors.slice(0, regionLabels.length);

    var ctx = document.getElementById("myChart4").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: data,
                backgroundColor: backgroundColors,
                label: 'Dataset 1'
            }],
            labels: labels,
        },
        options: {
            responsive: true,
            legend: {
                position: 'right',
            },
        }
    });

    var ctxRegion = document.getElementById("myChart5").getContext('2d');
    var regionChart = new Chart(ctxRegion, {
        type: 'bar',
        data: {
            datasets: [{
                data: regionData,
                backgroundColor: regionBackgroundColors,
                borderWidth: 2,
                borderColor: '#6777ef',
                borderWidth: 1,
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            }],
            labels: regionLabels,
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1,
                        callback: function (value) {
                            return value; // Display numbers from 1 to n
                        }
                    }
                }],
                xAxes: [{
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        display: false
                    }
                }]
            },
        }
    });
});
