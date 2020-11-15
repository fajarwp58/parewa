@extends('layouts.main')
@extends('layouts.menuatas')
@extends('layouts.menusamping')

@section('content')
<br>
<div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <button class="btn btn-primary m-r-5" id="addbarang">
                    <i class="anticon anticon-plus"></i>
                    Add Barang
                </button>
            </h4>
        </div>

        {{--        TABEL Barang--}}
        <div class="card-body">
            <table id="tbarang" class="table">
                <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>stock</th>
                    <th>tgl expired</th>
                    <th>harga modal</th>
                    <th>Aksi</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    {{--    MODAL DAN FORM DATA Barang--}}
    <div class="modal fade" id="mbarang">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Barang</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ion ion-md-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formbarang">
                        {{ csrf_field() }}

                        <div class="form-group" id="div_nama">
                            <label for="namabarang">Nama Barang</label>
                            <input type="text"  class="form-control" id="namabarang" name="namabarang" placeholder="nama barang">
                        </div>

                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input type="text"  class="form-control" id="satuan" name="satuan" placeholder="satuan">
                        </div>

                        <div class="form-group">
                            <label for="tglexpired">Tanggal Expired</label>
                            <input type="text" class="form-control" id="datepicker" name="tglexpired" />
                        </div>

                        <div class="form-group">
                            <label for="hargamodal">Harga Modal</label>
                            <input type="text"  class="form-control" id="hargamodal" name="hargamodal" placeholder="harga modal">
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
    <div class="modal fade" id="mdbarang">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
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
                                            <a class="text-gray">Nama Barang</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dnamabarang"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="text-gray">Satuan</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dsatuan"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="text-gray">Qty</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dqty"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="text-gray">Tanggal Expired</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dtglexpired"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="text-gray">Harga Modal</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dhargamodal"></a>
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
                $('#tbarang').dataTable({
                    "ajax": "{{ url('/stock/data') }}",
                    "columns": [
                        { "data": "nama_barang" },
                        { "data": "qty" },
                        { "data": "tgl_expired" },
                        { "data": "harga_modal" },
                        {
                            data: 'kode_barang',
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


            $(document).on('click', '#addbarang', function() {
                $('#mbarang').modal('show');
                $('#formbarang').attr('action', '{{ url('stock/create') }}');
            });

            $('#formbarang').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                    type: 'post',
                    data: {
                        'nama_barang': $('#namabarang').val(),
                        'satuan': $('#satuan').val(),
                        'qty': $('#qty').val(),
                        'tgl_expired': $('#datepicker').val(),
                        'harga_modal': $('#hargamodal').val(),
                    },
                    success :function (response) {
                        notify(response);
                        $('#tbarang').DataTable().destroy();
                        loadData();
                        $('#mbarang').modal('hide');
                    },

                });
            });

            $(document).on('click', '#edit', function() {
                var data = $('#tbarang').DataTable().row($(this).parents('tr')).data();
                $('#mbarang').modal('show');
                $('#namabarang').val(data.nama_barang).change();
                $('#satuan').val(data.satuan).change();
                $('#qty').val(data.qty).change();
                $('#tglexpired').val(data.tgl_expired).change();
                $('#hargamodal').val(data.harga_modal).change();
                $('#formbarang').attr('action', '{{ url('stock/edit') }}/'+data.kode_barang);
            });

            $(document).on('click', '#detail', function() {
                var data = $('#tbarang').DataTable().row($(this).parents('tr')).data();
                $('#mdbarang').modal('show');
                $('#dnamabarang').text(data.nama_barang);
                $('#dsatuan').text(data.satuan);
                $('#dqty').text(data.qty);
                $('#dtglexpired').text(data.tgl_expired);
                $('#dhargamodal').text(data.harga_modal);
            });

            $(document).on('click', '#delete', function() {
                var id = $(this).data('id');
                if (confirm("Yakin ingin menghapus data?")){
                    $.ajax({
                        url : "{{ url('stock/delete') }}/"+id,

                        success :function () {

                            $('#tbarang').DataTable().destroy();
                            loadData();
                        }
                    })
                }
            });

            $( "#datepicker" ).datepicker({  
                dateFormat: 'yy-mm-dd',                
                minDate: moment().add('d', 0).toDate(),
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