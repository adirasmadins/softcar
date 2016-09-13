function Charts(){
    this.getChart = function(type, labels, data, backgrounds, ctx, label){

        switch (type) {
            case 'bar':
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            data: data,
                            backgroundColor: backgrounds,
                            borderWidth: 1,
                            options: {
                                responsive: true
                            }
                        }]

                    }
                });
                break;
            case 'polarArea':
                var myChart = new Chart(ctx, {
                    type: 'polarArea',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: backgrounds,
                            borderWidth: 1,
                            options: {
                                responsive: true
                            }
                        }]

                    }
                });
                break;
            case 'pie':
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: backgrounds,
                            borderWidth: 1,
                            options: {
                                responsive: true
                            }
                        }]

                    }
                });
                break;
            case 'doughnut':
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: backgrounds,
                            borderWidth: 1,
                            options: {
                                responsive: true
                            }
                        }]

                    }
                });
                break;
        }
    };
}