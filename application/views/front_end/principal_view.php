<section clase="contenedor">
    <script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {role: "style"}],
                ["Copper", 8.94, "#b87333"],
                ["Silver", 10.49, "silver"],
                ["Gold", 19.30, "gold"],
                ["Platinum", 21.45, "color: #e5e4e2"]
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                2]);

            var options = {
                title: "Density of Precious Metals, in g/cm^3",
                width: 600,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
            chart.draw(view, options);
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            function load_page_data() {
                $.ajax({
                    url: 'get_data.php',
                    data: {'startdate': startdate,
                        'enddate': enddate
                    },
                    async: false,
                    success: function (data) {
                        if (data) {
                            chart_data = $.parseJSON(data);
                            google.load("visualization", "1", {packages: ["corechart"]});
                            google.setOnLoadCallback(function () {
                                drawChart(chart_data, "My Chart", "Data")
                            })
                        }
                    },
                });
            }

            load_page_data();
        });

    </script>
    <div class="row"> 
        <div class="col-md-12">
            <div class="list-group">
                <a href="#" class="list-group-item info">
                    <h4 class="list-group-item-heading">Bien venido!</h4>                    
                    <blockquote>
                        <p class="list-group-item-text"> podras gestionar el consumo de sus neumaticos <span class="label label-danger"><strong>Maximizando la duracion</strong></span>, con una gestion automatizado de cotrol de desgastes, renovaciones, cambios y desecho.</p>
                    </blockquote>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <div id="barchart_values" style="width: 900px; height: 300px;"></div>
                </div>
                <div class="panel-footer">

                </div>

            </div>
        </div>

    </div>
</div>



</section>
