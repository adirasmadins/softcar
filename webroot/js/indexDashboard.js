$(document).ready(function(){
    var ctx = document.getElementById("myChart").getContext("2d");;
    ctx.canvas.width = 300;
    ctx.canvas.height = 300;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Red", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderWidth: 1,
                options: {
                    responsive: true
                }
            }]

        }
    });
});