@extends('layouts.main')
@extends('layouts.menuatas')
@extends('layouts.menusamping')

@section('content')
<br>
<div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <button class="btn btn-primary m-r-5" id="adduser">
                    <i class="anticon anticon-plus"></i>
                    Add User
                </button>
            </h4>
        </div>

        {{--        TABEL USER--}}
        <div class="card-body">
            <table id="tuser" class="table">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>No HP</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    {{--    MODAL DAN FORM DATA USER--}}
    <div class="modal fade" id="muser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form User</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ion ion-md-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formuser">
                        {{ csrf_field() }}

                        <div class="form-group" id="div_username">
                            <label for="username">Username</label>
                            <input type="text"  class="form-control" id="username" name="username" placeholder="username">
                        </div>

                        <div class="form-group">
                            <label for="nohp">No HP</label>
                            <input type="text"  class="form-control" id="nohp" name="nohp" placeholder="no hp">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="textarea"  class="form-control" id="alamat" name="alamat" placeholder="alamat">
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text"  class="form-control" id="email" name="email" placeholder="email">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6" id="div_role_id">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role">
                                    <option value=""> Pilih Role </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="div_password">
                            <div class="form-group col-md-12">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
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


    {{--    MODAL DAN FORM DETAIL USER--}}
    <div class="modal fade" id="mduser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail User</h5>
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
                                            <a class="text-gray">Username</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="dusername"></a>
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
                                    <tr>
                                        <td>
                                            <a class="text-gray">E-mail</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="demail"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="text-gray">Role</a>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <a class="text-gray" id="drole"></a>
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
                $('#tuser').dataTable({
                    "ajax": "{{ url('/user/data') }}",
                    "columns": [
                        { "data": "username" },
                        { "data": "no_hp" },
                        { "data": "role.nama_role"},
                        {
                            data: 'id_user',
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
                            width: "250px",
                            targets: [3]
                        },
                    ],
                    scrollX: true,
                    scrollY: '350px',
                    scrollCollapse: true,
                });
            } loadData();


            $(document).on('click', '#adduser', function() {
                $('#muser').modal('show');
                document.getElementById('div_password').style.display = 'block';
                $('#formuser').attr('action', '{{ url('user/create') }}');
            });

            $('#formuser').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                    type: 'post',
                    data: {
                        'username': $('#username').val(),
                        'no_hp': $('#nohp').val(),
                        'id_role': $('#role').val(),
                        'email': $('#email').val(),
                        'alamat': $('#alamat').val(),
                        'password': $('#password').val(),
                    },
                    success :function (response) {
                        notify(response);
                        $('#tuser').DataTable().destroy();
                        loadData();
                        $('#muser').modal('hide');
                    },

                });
            });

            $(document).on('click', '#edit', function() {
                var data = $('#tuser').DataTable().row($(this).parents('tr')).data();
                $('#muser').modal('show');
                document.getElementById('div_password').style.display = 'none';
                document.getElementById('div_role_id').style.display = 'none';
                document.getElementById('div_username').style.display = 'none';
                $('#email').val(data.email).change();
                $('#nohp').val(data.no_hp).change();
                $('#alamat').val(data.alamat).change();
                $('#formuser').attr('action', '{{ url('user/edit') }}/'+data.id_user);
            });

            $(document).on('click', '#detail', function() {
                var data = $('#tuser').DataTable().row($(this).parents('tr')).data();
                $('#mduser').modal('show');
                $('#dusername').text(data.username);
                $('#dnohp').text(data.no_hp);
                $('#dalamat').text(data.alamat);
                $('#demail').text(data.email);
                $('#drole').text(data.role.nama_role);
            });

            $(document).on('click', '#delete', function() {
                var id = $(this).data('id');
                if (confirm("Yakin ingin menghapus data?")){
                    $.ajax({
                        url : "{{ url('user/delete') }}/"+id,

                        success :function () {

                            $('#tuser').DataTable().destroy();
                            loadData();


                        }
                    })
                }
            });



            $.ajax({
                url: '{{ url('user/listrole') }}',
                dataType: "json",
                success: function(data) {
                    var role = jQuery.parseJSON(JSON.stringify(data));
                    $.each(role, function(k, v) {
                        $('#role').append($('<option>', {value:v.id_role}).text(v.nama_role))
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


            $( "#formuser" ).validate({
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