@extends('layouts.main')
@extends('layouts.menuatas')
@extends('layouts.menusamping')

@section('content')
<br>
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="card">
        <div class="card-header">
                <h4 class="card-title">
                    Transaksi Penjualan
                </h4>
        </div>

        {{--        TABEL Transaksi--}}
        <div class="card-body">
            <table id="ttransaksi" class="table activate-select dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>No Invoice</th>
                        <th>Tgl Penjualan</th>
                        <th>Menu</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
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
            responsive: true,
            language: {
                search: '<span>Cari:</span> _INPUT_',
                searchPlaceholder: 'Cari...',
                lengthMenu: '<span>Tampil:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            }
        });
        function loadData() {
            $('#ttransaksi').dataTable({
                "ajax": "{{ url('/transaksi/data') }}",
                "order": [[ 1, "desc" ]],
                "columns": [
                    { "data": "id_penjualan",
                        sClass: 'text-center' },
                    { "data": "tgl_penjualan",
                        sClass: 'text-center'},
                    { "data": "menu",
                        sClass: 'text-center'},
                    { "data": "total_bayar",
                        sClass: 'text-center'},
                    {
                        data: 'id_penjualan',
                        sClass: 'text-center',
                        render: function(data) {
                            return'<a href="#" data-id="'+data+'" id="cetak" class="btn btn-warning waves-effect waves-light btn-xs" title="cetak">cetak </a> &nbsp;';
                        }
                    }
                ],
                columnDefs: [
                    {
                        width: "50px",
                        targets: [0]
                    },
                    {
                        width: "100px",
                        targets: [1]
                    },
                    {
                        width: "125px", targets: [2],
                        render: function (data, type, full, meta) {
                            var hasil = '';
                            data.forEach((item, id)=>{
                                hasil += '- '+item.nama_menu+'<br>';
                            });
                            return hasil;
                        }
                    },
                    {
                        width: "70px",
                        targets: [3] 
                    },
                    {
                        width: "70px",
                        targets: [4]
                    },
                ],
                scrollX: true,
                scrollY: '350px',
                scrollCollapse: true,
            });
        } loadData();


        $(document).on('click', '#tambah', function() {
            var data = $('#ttransaksilainnya').DataTable().row($(this).parents('tr')).data();
           
            $('#mtransaksilainnya').modal('show');
            document.getElementById('div_kodelainnya').style.display = 'none';
            //document.getElementById('div_kodepenyakit').style.display = 'block';
           
            $('#kode_transaksi').val(data.kode_transaksi).change();
            $('#formtransaksilainnya').attr('action', '{{ url('transaksilainnya/create') }}');
        });

        $('#formpenyakit').submit(function(e) {
            e.preventDefault();
            $('#namaError').addClass('d-none');
            $('#jenis_penyakit_idError').addClass('d-none');
            $.ajax({
                url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                type: 'post',
                data: {
                    'kode_penyakit': $('#kode_penyakit').val(),
                    'jenis_penyakit_id': $('#jenis_penyakit_id').val(),
                    'nama': $('#nama').val(),
                },


                success :function (response) {
                    $('#tpenyakit').DataTable().destroy();
                    loadData();
                    $('#mpenyakit').modal('hide');
                },

                error : function (data){
                    var errors = data.responseJSON;
                    if ($.isEmptyObject(errors) == false){
                        $.each(errors.errors, function (key, value){
                            var ErrorID = '#' + key + 'Error';
                            $(ErrorID).removeClass("d-none");
                            $(ErrorID).text(value);
                        })
                    }
                },

            });
        });

        $(document).on('click', '#cetak', function() {
            var data = $('#ttransaksilainnya').DataTable().row($(this).parents('tr')).data();
            window.location.href = '{{ url('transaksilainnya/cetak') }}/'+data.transaksi_pemeriksaan_id ;
        });

        $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            if (confirm("Yakin ingin menghapus data?")){
                $.ajax({
                    url : "{{ url('transaksilainnya/delete') }}/"+id,

                    success :function () {

                        $('#ttransaksilainnya').DataTable().destroy();
                        loadData();


                    }
                })
            }
        });

        $('#mpenyakit').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
            let hapusValidasi = document.getElementById('formpenyakit');
            hapusValidasi.querySelectorAll('.form-control').forEach(hapusValidasi => {
                hapusValidasi.classList.remove('label');
                hapusValidasi.classList.remove('is-valid');
                hapusValidasi.classList.remove('is-invalid');
                hapusValidasi.classList.remove('required');
            });
        });

    });

</script>
@endsection