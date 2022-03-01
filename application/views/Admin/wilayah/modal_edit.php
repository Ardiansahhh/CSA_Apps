<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ubah-<?php echo $dw->id_urut; ?>">
  <i class="fa fa-edit"></i> Edit
</button>
<div class="modal modal-default fade" id="ubah-<?php echo $dw->id_urut; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Edit Data Wilayah</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('Area/edit_wilayah/'.$dw->id_urut); ?>" method="POST">
		  <div class="callout callout-default">
			<div class="form-group">
				<label>Kode Ruang Lingkup</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-id-card"></i>
					</div>
						<input name="kode_ruang" type="text" value="<?php echo $dw->kode_ruang; ?>" class="form-control" readonly required/>
				</div>
			</div>
            <div class="form-group">
				<label>Nama Wilayah</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-id-card"></i>
					</div>
						<input name="nama_wilayah" type="text" value="<?php echo $dw->nama_wilayah; ?>" class="form-control" required/>
				</div>
			</div>
			<button type="submit" name="editdata" class="btn btn-success pull-right"><i class="fa fa-send"></i> Ubah</button>
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
