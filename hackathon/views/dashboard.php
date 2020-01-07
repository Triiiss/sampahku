<div class="row">
  <div class="col-lg-12">
    <h1> Dashboard </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-dashboard"></i> Dashboard </li>
    </ol>
  </div>
</div><!-- /.row -->

<div class="row">
  <div class="col-lg-12">
    <div id="data_nm_sampah"></div>
  </div>
</div>

<?php
include "models/transaksi/m_penjualan.php";
$connection = new Database($host, $user, $pass, $database);
$jual = new Penjualan($connection);
 ?>

<script src="assets/highcharts/highcharts.js"></script>
<script src="assets/highcharts/series-label.js"></script>
<script src="assets/highcharts/exporting.js"></script>
<script src="assets/highcharts/export-data.js"></script>

<script type="text/javascript">
Highcharts.chart('data_nm_sampah', {

    title: {
        text: 'Data Penjualan Sampah'
    },

    // subtitle: {
    //     text: 'Source: thesolarfoundation.com'
    // },

    yAxis: {
        title: {
            text: 'Number of Employees'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 2010
        }
    },

    series: [{
        name: 'Plastik',
        data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
    }, {
        name: 'Kertas',
        data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
    }, {
        name: 'Logam',
        data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
    }, {
        name: 'Kaca',
        data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
    }, {
        name: 'Karet',
        data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>
