@extends('layouts.main')
@extends('layouts.menuatas')
@extends('layouts.menusamping')

@section('content')
<br>
<div class="card">
        <div class="card-header">
            <h4 class="card-title">
                Form Resep {{$menu->nama_menu}}
            </h4>
        </div>

            <div class="card-body">
                <form method="POST" id="formlaporan" action="{{ url('/menu/resep/create') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="text" class="form-control" id="id_menu" name="id_menu" value="{{ $menu->id_menu }}" hidden>
<div id="back">
    <div  class="form row">

        <div class="form-group col-md-5">
            <label for="kode_barang">Nama Barang :</label>
            <select class="form-control barang" id="kode_barang" name="kode_barang[]" required>
                <option value="">Pilih Barang</option>
            </select>
        </div>

        <div class="form-group col-md-5">
            <label for="jumlah">Jumlah :</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah[]" placeholder="jumlah" required>
        </div>
    </div>
</div>

<div class="modal-footer">
    <a type="button" class="btn btn-default" data-dismiss="modal" href="{{ url('menu/index') }}">Kembali</a>
    <a id="btnadd" type="button" class="btn btn-outline-dark btn-rounded waves-effect width-md waves-light"><i class="anticon anticon-plus"></i> Add Barang</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>

</form>
<div style="display: none">
                <div id="clone" class="form row">

                    <div class="form-group col-md-5">
                        <label for="kode_barang">Nama Barang :</label>
                        <select class="form-control barang" id="kode_barang" name="kode_barang[]" required>
                            <option value="">Pilih Barang</option>
                        </select>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="jumlah">Jumlah :</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah[]" placeholder="jumlah" required>
                    </div>
                    <div class="form-group col-md-2">
                        <br>
                        <a id="btndelete" type="button" onclick="$(this).parents('#clone').remove();" class="btn btn-outline-dark btn-rounded waves-effect width-md waves-light" ><i class="anticon anticon-minus-circle"></i> Hapus</a>
                    </div>
                </div>

            </div>
        </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#btnadd').click(function () {
        $('#clone').clone().appendTo('#back');
    });

    $.ajax({
                url: '{{ url('menu/listbarang') }}',
                dataType: "json",
                success: function(data) {
                    var barang = jQuery.parseJSON(JSON.stringify(data));
                    $.each(barang, function(k, v) {
                        $('.barang').append($('<option>', {value:v.kode_barang}).text(v.nama_barang))
                    })
                }
            });
</script>
@endsection