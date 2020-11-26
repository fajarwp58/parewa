@extends('layouts.main')
@extends('layouts.menuatas')
@extends('layouts.menusamping')

@section('content')
<br>
<div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <button class="btn btn-primary m-r-5" id="addkategori">
                    <i class="anticon anticon-plus"></i>
                    Add Kategori
                </button>
            </h4>
        </div>

        {{--        TABEL kategori--}}
        <div class="card-body">
            <table id="tkategori" class="table">
                <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    {{--    MODAL DAN FORM DATA kategori--}}
    <div class="modal fade" id="mkategori">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ion ion-md-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formkategori">
                        {{ csrf_field() }}

                        <div class="form-group" id="div_nama">
                            <label for="nama">Nama Kategori</label>
                            <input type="text"  class="form-control" id="nama" name="nama" placeholder="nama kategori">
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
                $('#tkategori').dataTable({
                    "ajax": "{{ url('/kategori/data') }}",
                    "columns": [
                        { "data": "nama_kategori" },
                        {
                            data: 'id_kategori',
                            sClass: 'text-center',
                            render: function(data) {
                                return'<a href="#" data-id="'+data+'" id="edit" class="btn btn-purple btn-rounded waves-effect waves-light btn-sm" title="edit"><i class="anticon anticon-edit"></i>edit </a> &nbsp;'+
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
                    ],
                    scrollX: true,
                    scrollY: '350px',
                    scrollCollapse: true,
                });
            } loadData();


            $(document).on('click', '#addkategori', function() {
                $('#mkategori').modal('show');
                $('#formkategori').attr('action', '{{ url('kategori/create') }}');
            });

            $('#formkategori').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                    type: 'post',
                    data: {
                        'nama_kategori': $('#nama').val(),
                    },
                    success :function (response) {
                        notify(response);
                        $('#tkategori').DataTable().destroy();
                        loadData();
                        $('#mkategori').modal('hide');
                    },

                });
            });

            $(document).on('click', '#edit', function() {
                var data = $('#tkategori').DataTable().row($(this).parents('tr')).data();
                $('#mkategori').modal('show');
                $('#nama').val(data.nama_kategori).change();
                $('#formkategori').attr('action', '{{ url('kategori/edit') }}/'+data.id_kategori);
            });

            $(document).on('click', '#delete', function() {
                var id = $(this).data('id');
                if (confirm("Yakin ingin menghapus data?")){
                    $.ajax({
                        url : "{{ url('kategori/delete') }}/"+id,

                        success :function () {

                            $('#tkategori').DataTable().destroy();
                            loadData();
                        }
                    })
                }
            });

            $('#mkategori').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                let hapusValidasi = document.getElementById('formkategori');
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


            $( "#formkategori" ).validate({
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