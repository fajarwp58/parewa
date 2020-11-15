@extends('layouts.main')
@extends('layouts.menuatas')
@extends('layouts.menusamping')

@section('content')
<br>
<div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <button class="btn btn-primary m-r-5" id="addsupplier">
                    <i class="anticon anticon-plus"></i>
                    Add Supplier
                </button>
            </h4>
        </div>

        {{--        TABEL Supplier--}}
        <div class="card-body">
            <table id="tsupplier" class="table">
                <thead>
                <tr>
                    <th>Nama Supplier</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    {{--    MODAL DAN FORM DATA Supplier--}}
    <div class="modal fade" id="msupplier">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ion ion-md-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formsupplier">
                        {{ csrf_field() }}

                        <div class="form-group" id="div_nama">
                            <label for="nama">Nama Supplier</label>
                            <input type="text"  class="form-control" id="nama" name="nama" placeholder="nama supplier">
                        </div>

                        <div class="form-group">
                            <label for="nohp">No HP</label>
                            <input type="text"  class="form-control" id="nohp" name="nohp" placeholder="no hp">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="textarea"  class="form-control" id="alamat" name="alamat" placeholder="alamat">
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


    {{--    MODAL DAN FORM DETAIL USER--}}
    <div class="modal fade" id="mdsupplier">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Supplier</h5>
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
                                            <a class="text-gray">Nama Supplier</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dnama"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="text-gray">No HP</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dnohp"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="text-gray">Alamat</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dalamat"></a>
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
                $('#tsupplier').dataTable({
                    "ajax": "{{ url('/supplier/data') }}",
                    "columns": [
                        { "data": "nama_supplier" },
                        { "data": "no_hp" },
                        {
                            data: 'kode_supplier',
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
                            width: "250px",
                            targets: [0]
                        },
                        {
                            width: "200px",
                            targets: [1]
                        },
                        {
                            width: "200px",
                            targets: [2]
                        },
                    ],
                    scrollX: true,
                    scrollY: '350px',
                    scrollCollapse: true,
                });
            } loadData();


            $(document).on('click', '#addsupplier', function() {
                $('#msupplier').modal('show');
                $('#formsupplier').attr('action', '{{ url('supplier/create') }}');
            });

            $('#formsupplier').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                    type: 'post',
                    data: {
                        'nama_supplier': $('#nama').val(),
                        'no_hp': $('#nohp').val(),
                        'alamat': $('#alamat').val(),
                    },
                    success :function (response) {
                        notify(response);
                        $('#tsupplier').DataTable().destroy();
                        loadData();
                        $('#msupplier').modal('hide');
                    },

                });
            });

            $(document).on('click', '#edit', function() {
                var data = $('#tsupplier').DataTable().row($(this).parents('tr')).data();
                $('#msupplier').modal('show');
                $('#nama').val(data.nama_supplier).change();
                $('#nohp').val(data.no_hp).change();
                $('#alamat').val(data.alamat).change();
                $('#formsupplier').attr('action', '{{ url('supplier/edit') }}/'+data.kode_supplier);
            });

            $(document).on('click', '#detail', function() {
                var data = $('#tsupplier').DataTable().row($(this).parents('tr')).data();
                $('#mdsupplier').modal('show');
                $('#dnama').text(data.nama_supplier);
                $('#dnohp').text(data.no_hp);
                $('#dalamat').text(data.alamat);
            });

            $(document).on('click', '#delete', function() {
                var id = $(this).data('id');
                if (confirm("Yakin ingin menghapus data?")){
                    $.ajax({
                        url : "{{ url('supplier/delete') }}/"+id,

                        success :function () {

                            $('#tsupplier').DataTable().destroy();
                            loadData();
                        }
                    })
                }
            });

            $('#muser').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                let hapusValidasi = document.getElementById('formuser');
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


            $( "#formsupplier" ).validate({
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