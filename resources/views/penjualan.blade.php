@extends('layouts.main')
@extends('layouts.menuatas')
@extends('layouts.menusamping')

@section('content')
<br>
<div class="card-box pb-2">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
            <h4>Menu<span class="small">Parewa Coffe</span></h4>
        </div>
        <div class="card-body">
            <form class="form form-horizontal form-produk" method="post">
            {{ csrf_field() }}
              <input type="hidden" name="nopembelian" value="{{ $data->id_penjualan }}">
              <div class="form-group">
                <!-- <label for="kode" class="col-md-2 control-label">Kode Produk</label> -->
                <div class="col-md-5">
                  <div class="input-group">
                    <input id="kode" type="hidden" class="form-control" name="kode" autofocus required>
                      <!-- <span class="input-group-btn">
                        <button onclick="showProduct()" type="button" class="btn btn-info">...</button>
                      </span> -->
                  </div>
                </div>
              </div>
            </form>
            <table class="table table-striped tabel-produk">
      <thead>
         <tr>
            <th>Kode Menu</th>
            <th>Nama Menu</th>
            <th>Harga Beli</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         @foreach($menu as $da)
         <tr>
            <th>{{ $da->id_menu }}</th>
            <th>{{ $da->nama_menu }}</th>
            <th>Rp. {{ format_uang($da->harga_jual) }}</th>
            <th><a onclick="selectItem({{ $da->id_menu }})" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></th>
          </tr>
         @endforeach
      </tbody>
   </table>
        </div>
      </div>
    </div> 
        <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Transaksi {{$data->id_penjualan}} <span class="small">Penjualan</span></h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                <label for="totalrp" class="col-md-4 control-label">No INV</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="id_penjualan" value="{{$data->id_penjualan}}" readonly>
                    </div>
                </div>
                <form class="form-keranjang">
                {{ csrf_field() }} {{ method_field('PATCH') }}
                <table class="table table-striped tabel-penjualan">
                <tr>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
                </table>
                </form>
                <div class="form-group">
                <div class="row">

  <div class="col-md-12">
    <form class="form form-horizontal form-pembelian" method="post" action="{{  route('penjualan.store') }} ">
      {{ csrf_field() }}
      <input type="hidden" name="nopembelian" value="{{ $data->id_penjualan }}">

      <div class="form-group">
        <center>
        <div class="col-md-10">
        <!-- <label for="totalrp" class="col-md-3 control-label">Total</label> -->
          <input type="hidden" class="form-control" id="totalrp" name="totalrp" value="" readonly>
        </div>
        <div id="tampil-bayar" style="background: #dd4b39; color: #fff; font-size: 80px; text-align: center; height: 100px"></div>
        </center>
      </div>

    </form>
  </div>
    </div>
                <br>
                <center>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right simpan"><i class="fa fa-floppy-o"></i> Simpan Transaksi</button>
      </div></center>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- @include('produk') -->
@endsection

@section('js')
<script src="/assets/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
var table;
$(function() {
  $('.tabel-produk').DataTable();

  $('.form-produk').on('submit', function(e){
      return false;
   });

   $('#kode').change(function(){
      addItem();
   });

   $('.form-keranjang').submit(function(){
     return false;
   });

   $('#diskon').change(function(){
      if($(this).val() == "") $(this).val(0).select();
      loadForm($(this).val());
   });

   $('.simpan').click(function(){
      $('.form-pembelian').submit();
   });


});

            function loadData() {
                table = $('.tabel-penjualan').dataTable({
                    "ajax": "{{ url('/penjualan/data') }}",
                    "columns": [
                        { "data": "nama_menu" },
                        { "data": "harga_jual" },
                        { data: 'id_detail_penjualan',
                          sClass: 'text-center',
                          render: function(data, type, row) {
                            return'<input style="width: 150px;" type="number" class="form-control" name="jumlah_$list->id_detail_penjualan" value="'+row.qty+'" onChange="changeCount($list->id_detail_penjualan)">';
                          }        
                        },
                        { "data": "total" },
                        {
                            data: 'id_menu',
                            sClass: 'text-center',
                            render: function(data) {
                                return'<a href="#" data-id="'+data+'" id="delete" class="btn btn-danger btn-rounded waves-effect waves-light btn-sm" title="hapus"><i class="anticon anticon-delete">hapus</i> </a>';
                            }
                        }
                    ],
                    columnDefs: [
                        {
                            width: "50px",
                            targets: [0]
                        },
                        {
                            width: "40px",
                            targets: [1]
                        },
                        {
                            width: "200px",
                            targets: [2]
                        },
                        {
                            width: "40px",
                            targets: [3]
                        },
                        {
                            width: "40px",
                            targets: [4]
                        },
                    ],
                    scrollX: true,
                    scrollY: '350px',
                    scrollCollapse: true,
                    paging: false,
                info: false,
                searching : false,
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // converting to interger to find total
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                    };

                    // computing column Total of the complete result
                    var hargaTotal = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    // Update footer by showing the total with the reference of the column index
	                $( api.column( 1 ).footer() ).html('Total');
                    $( api.column( 2 ).footer() ).html(hargaTotal);
                    $('#totalrp').val(hargaTotal).change();
                    $('#tampil-bayar').text("Rp. "+hargaTotal);
                },
                "processing": true,
                "serverSide": true,
                });
            } loadData();
function addItem(){
  $.ajax({
    url : "{{ route('penjualan_detail.store') }}",
    type : "POST",
    data : $('.form-produk').serialize(),
    success :function () { 
      $('#kode').val('').focus();
      $('.tabel-penjualan').DataTable().destroy();
      loadData();
                    },
    error : function(){
       alert("Tidak dapat menyimpan data!");
    }   
  });
}

function selectItem(kode){
  $('#kode').val(kode);
  addItem();
}

$(document).on('click', '#delete', function() {
                var id = $(this).data('id');
              
                    $.ajax({
                        url : "{{ url('penjualan/delete') }}/"+id,

                        success :function () {

                          $('.tabel-penjualan').DataTable().destroy();
                          loadData();

                        }
                    })
                
            });

function changeCount(id){
     $.ajax({
        url : "update/"+id,
        type : "GET",
        data : $('.form-keranjang').serialize(),
        success : function(data){
          $('#kode').focus();
          table.ajax.reload(function(){
            loadForm($('#diskon').val());
          });             
        },
        error : function(){
          alert("Tidak dapat menyimpan data!");
        }   
     });
}

function showProduct(){
  $('#modal-produk').modal('show');
}

function loadForm(diskon=0){
  $('#total').val($('.total').text());
  $('#totalitem').val($('.totalitem').text());

  $.ajax({
       url : "pembelian_detail/loadform/"+diskon+"/"+$('.total').text(),
       type : "GET",
       dataType : 'JSON',
       success : function(data){
         $('#totalrp').val("Rp. "+data.totalrp);
         $('#bayarrp').val("Rp. "+data.bayarrp);
         $('#totalbayar').val(data.total);
         $('#bayar').val(data.bayar);
         $('#tampil-bayar').text("Rp. "+data.bayarrp);
         $('#tampil-terbilang').text(data.terbilang);
       },
       error : function(){
         alert("Tidak dapat menampilkan data!");
       }
  });
}

</script>
@endsection
