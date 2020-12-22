@extends('layouts.main')
@extends('layouts.menuatas')
@extends('layouts.menusamping')

@section('content')
                        <br/>
                  
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-pink">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">{{format_uang($pemasukanhariini)}}</span></h2>
                                                <p class="mb-0">Pemasukan Hari Ini</p>
                                            </div>
                                            <i class="ion-md-trending-up"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-purple">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">{{format_uang($pemasukanbulanini)}}</span></h2>
                                                <p class="mb-0">Pemasukan Bulan Ini</p>
                                            </div>
                                            <i class="ion-md-trending-up"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-info">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">{{format_uang($pemasukantahunini)}}</span></h2>
                                                <p class="mb-0">Pemasukan Tahun Ini</p>
                                            </div>
                                            <i class="ion-md-trending-up"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-primary">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">{{format_uang($pemasukanseluruh)}}</span></h2>
                                                <p class="mb-0">Seluruh Pemasukan</p>
                                            </div>
                                            <i class="ion-md-journal"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
               
                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-pink">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">{{format_uang($pengeluaranhariini)}}</span></h2>
                                                <p class="mb-0">Pengeluaran Hari Ini</p>
                                            </div>
                                            <i class="ion-md-trending-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-purple">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">{{format_uang($pengeluaranbulanini)}}</span></h2>
                                                <p class="mb-0">Pengeluaran Bulan Ini</p>
                                            </div>
                                            <i class="ion-md-trending-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-info">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">{{format_uang($pengeluarantahunini)}}</span></h2>
                                                <p class="mb-0">Pengeluaran Tahun Ini</p>
                                            </div>
                                            <i class="ion-md-trending-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-primary">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">{{format_uang($pengeluaranseluruh)}}</span></h2>
                                                <p class="mb-0">Seluruh Pengeluaran</p>
                                            </div>
                                            <i class="ion-md-journal"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header py-3 bg-transparent">
            	<h3 class="box-title">Grafik Pendapatan {{ tanggal_indonesia($awal) }} s/d {{ tanggal_indonesia($akhir) }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="salesChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(function () {
  var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
  var salesChart = new Chart(salesChartCanvas);
  

  var salesChartData = {
    labels: {{ json_encode($data_tanggal) }},
    datasets: [
      {
        label: "Parewa",
        fillColor: "rgba(60,141,188,0.9)",
        strokeColor: "rgb(210, 214, 222)",
        pointColor: "rgb(210, 214, 222)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: {{ json_encode($data_pendapatan) }}
      }
    ]
  };

  var salesChartOptions = {
    pointDot: false,
    responsive: true
  };

  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);
});
</script>
@endsection