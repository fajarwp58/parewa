@extends('layouts.main')
@extends('layouts.menuatas')
@extends('layouts.menusamping')

@section('content')


<div class="row mt-5">

    <!-- @foreach($menu as $item)
    <div class="col-xl-2">
        <div class="card bg-pink">
            <div class="card-body widget-style-2">
                <div class="text-white media">
                    <div class="media-body align-self-center text-center">
                        <button class="btn"> {{ $item->nama_menu }} </button>
                        <h6 class="my-0 text-white"> Rp {{ number_format($item->harga_jual) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach -->
    <div class="col-sm-6">

        <div class="row">
            <div class="col-sm-4">
                <div class="card bg-pink">
                    <div class="card-body widget-style-2">
                        <div class="text-white media">
                            <div class="media-body align-self-center text-center">
                                <button class="btn"> Nama </button>
                                <h6 class="my-0 text-white"> Rp 30.000</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-pink">
                    <div class="card-body widget-style-2">
                        <div class="text-white media">
                            <div class="media-body align-self-center text-center">
                                <button class="btn"> Nama </button>
                                <h6 class="my-0 text-white"> Rp 30.000</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-pink">
                    <div class="card-body widget-style-2">
                        <div class="text-white media">
                            <div class="media-body align-self-center text-center">
                                <button class="btn"> Nama </button>
                                <h6 class="my-0 text-white"> Rp 30.000</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-pink">
                    <div class="card-body widget-style-2">
                        <div class="text-white media">
                            <div class="media-body align-self-center text-center">
                                <button class="btn"> Nama </button>
                                <h6 class="my-0 text-white"> Rp 30.000</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-success" id="addbarang">
                        <i class="fa fa-plus"></i>
                        Add Barang
                </button>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
@endsection
