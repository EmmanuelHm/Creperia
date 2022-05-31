<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Producto', 'Cantidad Comprado'],
        <?php while( $prod = $productos->fetch_object()): ?>
        ['<?=$prod->producto?>',     <?=$prod->cantidad?>],
        <?php endwhile; ?>
    ]);

    var options = {
        title: 'Los 10 productos más comprados',
        is3D: true,
        vAxis: {minValue: 0}
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
    }

    window.addEventListener('resize', function(event){
        drawChart();
    }, true);
</script>



<?php if( isset($_SESSION['admin'])): ?>
    <a href="<?=$_SERVER["HTTP_REFERER"]?>" class="btn red mt-4">Regresar</a>
<?php endif; ?>

<!-- <div id="piechart_3d" class="chart"></div> -->

<div class="row">
  <div class="col-md-12 text-center">
    <h1 class="mb-4 text-center text-white">Gráfica de Productos</h1>
  </div>
  <div class="col-md-4 col-md-offset-4">
    <hr />
  </div>
  <div class="clearfix"></div>
  <div class="col-md-12">
    <div id="piechart_3d" class="chart"></div>
  </div>
</div>