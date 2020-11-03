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
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">0</span></h2>
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
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">0</span></h2>
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
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">0</span></h2>
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
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">0</span></h2>
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
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">0</span></h2>
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
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">0</span></h2>
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
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">0</span></h2>
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
                                                <h2 class="my-0 text-white"><span data-plugin="counterup">0</span></h2>
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
                                        <div class="card-widgets">
                                            <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                            <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h5 class="header-title mb-0">Weekly Sales Report</h5>
                                    </div>
                                    <div id="cardCollpase1" class="collapse show">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="morris-bar-example" class="morris-charts" dir="ltr" style="height: 320px;"></div>
                                                    <div class="row text-center mt-4 mb-4">
                                                        <div class="col-sm-3 col-6">
                                                            <h5>$ 126</h5>
                                                            <small class="text-muted"> Today's Sales</small>
                                                        </div>
                                                        <div class="col-sm-3 col-6">
                                                            <h5>$ 967</h5>
                                                            <small class="text-muted">This Week's Sales</small>
                                                        </div>
                                                        <div class="col-sm-3 col-6">
                                                            <h5>$ 4500</h5>
                                                            <small class="text-muted">This Month's Sales</small>
                                                        </div>
                                                        <div class="col-sm-3 col-6">
                                                            <h5>$ 87,000</h5>
                                                            <small class="text-muted">This Year's Sales</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- end card-->

                            </div>
                            <!-- end col -->

                            <div class="col-xl-4">
                                <div class="card">
                                    <div id="cardCollpase2" class="collapse show">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="morris-line-example" class="morris-charts" dir="ltr" style="height: 200px;"></div>
                                                    <div class="row text-center mt-4">
                                                        <div class="col-sm-4">
                                                            <h5>$ 86,956</h5>
                                                            <small class="text-muted"> This Year's Report</small>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <h5>$ 86,69</h5>
                                                            <small class="text-muted">Weekly Sales Report</small>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <h5>$ 948,16</h5>
                                                            <small class="text-muted">Yearly Sales Report</small>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- end card-->

                            </div>

                        </div>
                        <!-- End row -->
@endsection
