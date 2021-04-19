@section('count-chart')
    <div class="w-full mr-2 flex flex-col bg-white  shadow rounded-lg " style="height:300px">
        <canvas class="w-full h-full" id="countMembers"></canvas>
    </div>

    <script>
        var ctx = document.getElementById("countMembers").getContext("2d");
        ctx.height = 300;

        var data = {
            labels: ["Registered", "Dayscholar", "Boarding", "Reported"],
            datasets: [
                {
                    label: "Boys",
                    backgroundColor: "blue",
                    data: [<?php echo $members_count['registered']['B'].','.$members_count['dayscholar']['B'].',' .$members_count['boarders']['B'].','.$members_count['reported']['B']?>]
                },
                {
                    label: "Girls",
                    backgroundColor: "pink",
                    data: [<?php echo $members_count['registered']['G'].','.$members_count['dayscholar']['G'].',' .$members_count['boarders']['G'].','.$members_count['reported']['G']?>]
                }
            ]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                barValueSpacing: 20,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Class Members Count'
                }
            }
        });

    </script>

@endsection
