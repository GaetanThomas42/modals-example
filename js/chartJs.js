var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: <?=json_encode($userLabel) ?>,
        datasets: [{
            label: <?=json_encode($userLabels) ?>,
            backgroundColor: '#dadada',
            borderColor: '#666',
            data: <?=json_encode($userDatas) ?> 
        }]
    },

    // Configuration options go here
    options: {}
});

