@extends('layouts.main')
@extends('layouts.menuatas')
@extends('layouts.menusamping')

@section('content')
<br>
<div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <button class="btn btn-primary m-r-5" id="addmenu">
                    <i class="anticon anticon-plus"></i>
                    Add Menu
                </button>
            </h4>
        </div>

        {{--        TABEL menu--}}
        <div class="card-body">
            <table id="tmenu" class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    {{--    MODAL DAN FORM DATA menu--}}
    <div class="modal fade" id="mmenu">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Menu</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ion ion-md-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formmenu">
                        {{ csrf_field() }}

                        <div class="form-group" id="div_nama">
                            <label for="nama">Nama Kategori</label>
                            <input type="text"  class="form-control" id="nama" name="nama" placeholder="nama menu">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6" id="div_kategori">
                                <label for="kategori">Role</label>
                                <select class="form-control" id="kategori" name="kategori">
                                    <option value=""> Pilih Kategori </option>
                                </select>
                            </div>

                            <div class="form-group col-md-6" id="div_harga">
                                <label for="harga">Harga Jual</label>
                                <input type="text"  class="form-control" id="harga" name="harga" placeholder="harga jual">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    MODAL DAN FORM DETAIL menu--}}
    <div class="modal fade" id="mdmenu">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Menu</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ion ion-md-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>

                        <div class="card">
                            <div class="card-body">
                                <table width="400">
                                    <tr>
                                        <td>
                                            <a class="text-gray">Nama Menu</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dnama"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="text-gray">Kategori</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dkategori"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="text-gray">Harga Jual</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dharga"></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark btn-rounded waves-effect width-md waves-light" data-dismiss="modal">Keluar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

<script src="/assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/datatables/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.extend( $.fn.dataTable.defaults, {
                autoWidth: false,
                language: {
                    search: '<span>Cari:</span> _INPUT_',
                    searchPlaceholder: 'Cari...',
                    lengthMenu: '<span>Tampil:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                }
            });
            function loadData() {
                $('#tmenu').dataTable({
                    "ajax": "{{ url('/menu/data') }}",
                    "columns": [
                        {
                                data: 'id_menu',
                                sClass: 'text-right',
                                render: function(data) {
                                    return'<a href="#" data-id="'+data+'" id="addresep" class="text-danger" title="tambah resep"><i class="ion ion-md-add-circle"></i> </a>';
                                }
                        },
                        { "data": "nama_menu" },
                        { "data": "kategori.nama_kategori" },
                        { "data": "harga_jual" },
                        {
                            data: 'id_menu',
                            sClass: 'text-center',
                            render: function(data) {
                                return'<a href="#" data-id="'+data+'" id="detail" class="btn btn-primary btn-rounded waves-effect waves-light btn-sm" title="detail"><i class="anticon anticon-eye"></i>detail </a> &nbsp;'+
                                    '<a href="#" data-id="'+data+'" id="edit" class="btn btn-purple btn-rounded waves-effect waves-light btn-sm" title="edit"><i class="anticon anticon-edit"></i>edit </a> &nbsp;'+
                                    '<a href="#" data-id="'+data+'" id="delete" class="btn btn-danger btn-rounded waves-effect waves-light btn-sm" title="hapus"><i class="anticon anticon-delete">hapus</i> </a>';
                            }
                        }
                    ],
                    columnDefs: [
                        {
                            width: "50px",
                            targets: [0]
                        },
                        {
                            width: "250px",
                            targets: [1]
                        },
                        {
                            width: "250px",
                            targets: [2]
                        },
                        {
                            width: "200px",
                            targets: [3]
                        },
                        {
                            width: "200px",
                            targets: [4]
                        },
                    ],
                    scrollX: true,
                    scrollY: '350px',
                    scrollCollapse: true,
                });
            } loadData();

            $(document).on('click', '#addmenu', function() {
                $('#mmenu').modal('show');
                $('#formmenu').attr('action', '{{ url('menu/create') }}');
            });

            $(document).on('click', '#addresep', function() {
                    var data = $('#tmenu').DataTable().row($(this).parents('tr')).data();
                    window.location.href = '{{ url('menu/addresep') }}/'+data.id_menu ;
            });

            $('#formmenu').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                    type: 'post',
                    data: {
                        'nama_menu': $('#nama').val(),
                        'id_kategori': $('#kategori').val(),
                        'harga_jual': $('#harga').val(),
                    },
                    success :function (response) {
                        notify(response);
                        $('#tmenu').DataTable().destroy();
                        loadData();
                        $('#mmenu').modal('hide');
                    },

                });
            });

            $.ajax({
                url: '{{ url('menu/listkategori') }}',
                dataType: "json",
                success: function(data) {
                    var kategori = jQuery.parseJSON(JSON.stringify(data));
                    $.each(kategori, function(k, v) {
                        $('#kategori').append($('<option>', {value:v.id_kategori}).text(v.nama_kategori))
                    })
                }
            });

            $(document).on('click', '#edit', function() {
                var data = $('#tmenu').DataTable().row($(this).parents('tr')).data();
                document.getElementById('div_kategori').style.display = 'none';
                $('#mmenu').modal('show');
                $('#nama').val(data.nama_menu).change();
                $('#harga').val(data.harga_jual).change()
                $('#formmenu').attr('action', '{{ url('menu/edit') }}/'+data.id_menu);
            });

            $(document).on('click', '#detail', function() {
                var data = $('#tmenu').DataTable().row($(this).parents('tr')).data();
                $('#mdmenu').modal('show');
                $('#dnama').text(data.nama_menu);
                $('#dkategori').text(data.kategori.nama_kategori);
                $('#dharga').text(data.harga_jual);
            });

            $(document).on('click', '#delete', function() {
                var id = $(this).data('id');
                if (confirm("Yakin ingin menghapus data?")){
                    $.ajax({
                        url : "{{ url('menu/delete') }}/"+id,

                        success :function () {

                            $('#tmenu').DataTable().destroy();
                            loadData();
                        }
                    })
                }
            });

            $('#mmenu').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                let hapusValidasi = document.getElementById('formmenu');
                hapusValidasi.querySelectorAll('.form-control').forEach(hapusValidasi => {
                    hapusValidasi.classList.remove('label');
                    hapusValidasi.classList.remove('is-valid');
                    hapusValidasi.classList.remove('is-invalid');
                    hapusValidasi.classList.remove('required');
                });
            });


            function notify(response){
                $.each(response, function(key, val) {
                    new swal({
                        title: 'Oops!',
                        text: val,
                        type: 'info'
                    });
                });

            }


            $( "#formmenu" ).validate({
                errorElement: 'label',
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                rules: {
                    nrp: {
                        required: true
                    },
                    nama: {
                        required: true
                    },
                    role: {
                        required : true
                    },
                    pangkat: {
                        required: true
                    },
                    password: {
                        required: true
                    }

                },
                messages : {
                    nrp: {
                        required : false
                    },
                    nama: {
                        required : false
                    },
                    role: {
                        required : false
                    },
                    pangkat: {
                        required : false
                    },
                    password: {
                        required : false
                    }
                }

            });


});
</script>

@endsection