const data = {
    labels: [
        'Present',
        'Absent'
    ],
    datasets: [{
        label: 'Attendance Detail',
        data: [300, 50],
        // backgroundColor: ['#2579bd', '#585858', '#2579bdad'],
        hoverOffset: 4
    }]
};

const config = {
    type: 'doughnut',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Attendance'
            }
        }
    },
};

const myChart_2 = new Chart(
    document.getElementById('myChart_2'),
    config
);

const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Branches'],
        datasets: [{
            label: 'Tiruvannamalai',
            data: [43],
            borderWidth: 1
        },
        {
            label: 'Chennai',
            data: [19],
            borderWidth: 1
        },
        {
            label: 'Madurai',
            data: [30],
            borderWidth: 1
        },
        {
            label: 'Vellor',
            data: [10],
            borderWidth: 1
        },
        {
            label: 'Kovai',
            data: [50],
            borderWidth: 1
        },
        {
            label: 'Erode',
            data: [70],
            borderWidth: 1
        },
        ]
    },
});