<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ubah-<?php echo $brg->id_urut_barang; ?>">
  <i class="fa fa-edit"></i> Edit
</button>
<div class="modal modal-default fade" id="ubah-<?php echo $brg->id_urut_barang; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Edit Data Barang</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('Barang/edit_barang/'.$brg->id_urut_barang); ?>" method="POST">
		  <div class="callout callout-default">
			<div class="form-group">
				<label>Kode Toko</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-id-card"></i>
					</div>
						<input name="kode_barang" type="text" value="<?php echo $brg->kode_barang; ?>" class="form-control" required readonly/>
				</div>
			</div>
            <div class="form-group">
				<label>Nama Toko</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-id-card"></i>
					</div>
						<input name="nama_barang" type="text" value="<?php echo $brg->nama_barang; ?>" class="form-control" required/>
				</div>
			</div>
			<button type="submit" name="editbarang" class="btn btn-success pull-right"><i class="fa fa-send"></i> Ubah</button>
	      </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
