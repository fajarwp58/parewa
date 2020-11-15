<div class="modal" id="modal-produk" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
     
   <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">Pilih Produk</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ion ion-md-close"></i>
                    </button>
   </div>
            
<div class="modal-body">
   <table class="table table-striped tabel-produk">
      <thead>
         <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Harga Beli</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         @foreach($produk as $data)
         <tr>
            <th>{{ $data->kode_barang }}</th>
            <th>{{ $data->nama_barang }}</th>
            <th>Rp. {{ format_uang($data->harga_modal) }}</th>
            <th><a onclick="selectItem({{ $data->kode_barang }})" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></th>
          </tr>
         @endforeach
      </tbody>
   </table>

</div>
      
         </div>
      </div>
   </div>
